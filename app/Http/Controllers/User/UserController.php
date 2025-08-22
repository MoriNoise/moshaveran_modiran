<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateUserPostRequest;
use App\Http\Requests\Admin\User\RegisterUserPostRequest;
use App\Http\Requests\Admin\User\UpdateUserPutRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');

        $users = User::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%");
            });
        })
            ->when($sort, function ($query, $sort) {
                switch ($sort) {
                    case 'name_asc':
                        $query->orderBy('first_name');
                        break;
                    case 'name_desc':
                        $query->orderBy('first_name', 'desc');
                        break;
                    case 'newest':
                        $query->orderBy('created_at', 'desc');
                        break;
                    case 'oldest':
                        $query->orderBy('created_at', 'asc');
                        break;
                    default:
                        $query->latest();
                }
            }, function ($query) {
                $query->latest();
            })
            ->paginate(10)
            ->appends(['search' => $search, 'sort' => $sort]);



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

    public function store(CreateUserPostRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);


        $user = User::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('users', 'public');

                $user->files()->create([
                    'filename' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getClientMimeType(),
                    'size' => $image->getSize(),
                    'type' => 'image',
                ]);
            }
        }


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
        $orders = $user->orders()->with('items.product.category', 'items.product.files')->get();
        $purchasedProducts = $orders->flatMap(function($order){
            return $order->items->map(function($item){
                return $item->product;
            });
        })->unique('id');  //
        return view('admin.users.show', [
            'title' => 'جزییات کاربر',
            'user' => $user,
            'purchasedProducts' => $purchasedProducts,
        ]);
    }

    public function update(int $id, UpdateUserPutRequest $request)
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {
                $path = $image->store('users', 'public');

                $user->files()->create([
                    'filename' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getClientMimeType(),
                    'size' => $image->getSize(),
                    'type' => 'image',
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت ویرایش شد');
    }

    public function deleteImage(User $user, File $file)
    {
        $user->files()->detach($file->id);

        if ($file->fileables()->count() === 0) {
            \Storage::disk('public')->delete($file->filename); // یا file_path اگر داری
            $file->delete();
        }

        return back()->with('success', 'عکس با موفقیت حذف شد');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'کاربر با موفقیت حذف شد');
    }


}
