<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateUserPostRequest;
use App\Http\Requests\Admin\User\RegisterUserPostRequest;
use App\Http\Requests\Admin\User\UpdateUserPutRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $usersQuery = User::query();

        // 🔍 Search
        if ($request->filled('search')) {
            $search = $request->search;
            $usersQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // 🚻 Gender filter
        if ($request->filled('gender')) {
            $usersQuery->where('gender', $request->gender);
        }

        // ✅ Status filter
        if ($request->filled('status')) {
            $usersQuery->where('is_active', $request->status);
        }

        // ↕ Sorting
        switch ($request->sort) {
            case 'name_asc':  $usersQuery->orderBy('first_name', 'asc'); break;
            case 'name_desc': $usersQuery->orderBy('first_name', 'desc'); break;
            case 'newest':    $usersQuery->orderBy('created_at', 'desc'); break;
            case 'oldest':    $usersQuery->orderBy('created_at', 'asc'); break;
            default:          $usersQuery->latest(); break;
        }

        $users = $usersQuery->paginate(10)->withQueryString();

        return view('admin.users.index', [
            'title' => 'لیست کاربران',
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'title' => 'ساخت کاربر',
        ]);

    }

    public function importForm()
    {
        return view('admin.users.import-vcf', [
            'title' => 'افزودن کاربران از VCF',
        ]);
    }


    public function importVcf(Request $request)
    {
        $request->validate([
            'vcf_file' => 'required|file|mimes:vcf,vcard,txt'
        ]);

        $fileContent = file_get_contents($request->file('vcf_file')->getRealPath());

        // 1. Fix folded lines first (lines ending with '=')
        $fileContent = preg_replace("/=\r?\n/", '', $fileContent);

        $users = [];
        $lines = preg_split('/\r\n|\r|\n/', $fileContent);
        $current = [];
        $propertyBuffer = []; // To collect folded lines for FN, TEL, EMAIL

        foreach ($lines as $line) {
            $line = trim($line);

            if (stripos($line, 'BEGIN:VCARD') !== false) {
                $current = [];
            } elseif (stripos($line, 'END:VCARD') !== false) {
                // Decode any buffered property
                if (!empty($propertyBuffer)) {
                    $this->flushPropertyBuffer($current, $propertyBuffer);
                    $propertyBuffer = [];
                }

                if (!empty($current)) {
                    $users[] = $current;
                }
            } elseif (preg_match('/^(FN|TEL|EMAIL)/i', $line)) {
                // Flush previous buffer
                if (!empty($propertyBuffer)) {
                    $this->flushPropertyBuffer($current, $propertyBuffer);
                }
                $propertyBuffer = [$line];
            } elseif (!empty($propertyBuffer)) {
                // Continuation line (folded)
                $propertyBuffer[] = $line;
            }
        }

        $errors = [];
        $createdCount = 0;
        $skippedCount = 0;

        foreach ($users as $u) {
            try {
                if (!isset($u['phone'])) {
                    // Skip entries without a phone
                    $skippedCount++;
                    continue;
                }

                $user = User::updateOrCreate(
                    ['phone' => $u['phone']], // search by phone
                    [
                        'first_name' => $u['name'] ?? 'بدون نام',
                        'last_name' => '',
                        'gender' => $this->detectGender($u['name'] ?? ''),
                        'birthday' => null,
                        'phone' => $u['phone'],
                        'organization' => null,
                        'is_active' => true,
                    ]
                );

                if ($user->wasRecentlyCreated) {
                    $createdCount++;
                } else {
                    $skippedCount++;
                }
            } catch (\Throwable $e) {
                $errors[] = [
                    'data' => $u,
                    'error' => $e->getMessage(),
                ];
            }
        }


        // Return unified success-like response
        return redirect()
            ->route('admin.users.index')
            ->with('success', "کاربران با موفقیت پردازش شدند.
تعداد جدید: $createdCount,
تکراری: $skippedCount" . (!empty($errors) ? ", خطاها: " . count($errors) : ""));
    }


    private function flushPropertyBuffer(array &$current, array $lines)
    {
        if (empty($lines)) return;

        $propertyLine = implode('', $lines); // join folded lines

        if (stripos($propertyLine, 'FN') === 0) {
            $current['name'] = $this->decodeVcardValue($propertyLine);
        } elseif (stripos($propertyLine, 'TEL') === 0) {
            $current['phone'] = $this->decodeVcardValue($propertyLine);
        } elseif (stripos($propertyLine, 'EMAIL') === 0) {
            $current['email'] = $this->decodeVcardValue($propertyLine);
        }
    }

    private function detectGender(string $name): ?string
    {
        $name = trim($name);

        // Men prefixes
        $malePrefixes = ['آقای', 'اقای', 'اقا', 'آقا'];

        // Women prefixes
        $femalePrefixes = ['خانم', 'خانوم', 'خانومه'];

        foreach ($malePrefixes as $prefix) {
            if (str_contains($name, $prefix)) {
                return 'male';
            }
        }

        foreach ($femalePrefixes as $prefix) {
            if (str_contains($name, $prefix)) {
                return 'female';
            }
        }

        return "other"; // Unknown
    }

    private function decodeVcardValue(string $line): string
    {
        // Extract value after the last colon
        $pos = strrpos($line, ':');
        if ($pos === false) return '';

        $value = substr($line, $pos + 1);

        // Decode Quoted-Printable
        $value = quoted_printable_decode($value);

        // Ensure UTF-8
        if (!mb_check_encoding($value, 'UTF-8')) {
            $value = mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
        }

        return trim($value);
    }

    public function store(CreateUserPostRequest $request)
    {
        $data = $request->validated();

//        $data['password'] = Hash::make($data['password']);


        $user = User::create($data);



        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت ساخته شد');
    }


    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', [
            'title' => 'ویرایش کاربر',
            'user' => $user,
        ]);
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', [
            'title' => 'جزییات کاربر',
            'user' => $user,]);
    }

    public function update(int $id, UpdateUserPutRequest $request)
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

//        if (!empty($data['password'])) {
//            $data['password'] = Hash::make($data['password']);
//        } else {
//            unset($data['password']);
//        }

        $user->update($data);


        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت ویرایش شد');
    }


    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت حذف شد');
    }


}
