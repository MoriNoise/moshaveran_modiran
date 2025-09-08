<?php

namespace App\Http\Controllers\MessageGroup;

use App\Http\Controllers\Controller;
use App\Models\MessageGroup;
use App\Models\MessageTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageGroupController extends Controller
{
    /**
     * Display a listing of the message groups.
     */
    public function index(Request $request)
    {
        $groups = MessageGroup::withCount('users')
            ->when($request->search, fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->sort, function ($q) use ($request) {
                switch ($request->sort) {
                    case 'name_asc':
                        $q->orderBy('name', 'asc');
                        break;
                    case 'name_desc':
                        $q->orderBy('name', 'desc');
                        break;
                    case 'Oldest':
                        $q->orderBy('created_at', 'asc');
                        break;
                    case 'Newest':
                    default:
                        $q->orderBy('created_at', 'desc');
                        break;
                }
            }, fn($q) => $q->orderBy('created_at', 'desc'))
            ->paginate(10);

        return view('admin.message_groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group.
     */
    public function create(Request $request)
    {
        $usersQuery = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $usersQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $usersQuery->where('gender', $request->gender);
        }

        if ($request->filled('status')) {
            $usersQuery->where('is_active', $request->status);
        }

        // Sorting (optional, like edit)
        switch ($request->sort) {
            case 'name_asc':  $usersQuery->orderBy('first_name', 'asc'); break;
            case 'name_desc': $usersQuery->orderBy('first_name', 'desc'); break;
            case 'Newest':    $usersQuery->orderBy('created_at', 'desc'); break;
            case 'Oldest':    $usersQuery->orderBy('created_at', 'asc'); break;
            default:          $usersQuery->orderBy('first_name', 'asc'); break;
        }

        $users = $usersQuery->paginate(50)->withQueryString(); // 🔑 keep filters on pagination
        $templates = MessageTemplate::orderBy('name')->get();

        return view('admin.message_groups.create', compact('users', 'templates'));
    }


    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'template_id'    => 'nullable|exists:message_templates,id',
            'selected_users' => 'nullable|string',
            'send_to_all'    => 'nullable|boolean',
        ]);

        $group = MessageGroup::create([
            'name'        => $request->name,
            'description' => $request->description,
            'created_by'  => auth()->id(),
            'is_active'   => $request->is_active ?? true,
        ]);

        // Handle users
        $sendToAll = $request->boolean('send_to_all');

        if ($sendToAll) {
            $allUserIds = User::pluck('id')->toArray();
            $group->users()->sync($allUserIds);
        } else {
            $users = $request->filled('selected_users')
                ? array_filter(explode(',', $request->selected_users))
                : [];
            $group->users()->sync($users);
        }

        // Handle template
        if ($request->filled('template_id')) {
            DB::table('group_messages')->insert([
                'group_id'    => $group->id,
                'template_id' => $request->template_id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('admin.message-groups.index')
            ->with('success', 'گروه با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified group.
     */
    public function show(int $id)
    {
        $messageGroup = MessageGroup::with('users', 'admin', 'groupMessage.template')->findOrFail($id);

        return view('admin.message_groups.show', [
            'title' => 'جزییات گروه پیام',
            'messageGroup' => $messageGroup,
        ]);
    }

    /**
     * Show the form for editing the specified group.
     */
    public function edit(int $id, Request $request)
    {
        $messageGroup = MessageGroup::with('users', 'template.template')->findOrFail($id);
        $selectedUserIds = $messageGroup->users->pluck('id')->toArray();

        $usersQuery = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $usersQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $usersQuery->where('gender', $request->gender);
        }

        if ($request->filled('status')) {
            $usersQuery->where('is_active', $request->status);
        }

        // Move selected users to top
        if (!empty($selectedUserIds)) {
            $idsString = implode(',', $selectedUserIds);
            $usersQuery->orderByRaw("FIELD(id, {$idsString}) DESC");
        }

        // Sorting
        switch ($request->sort) {
            case 'name_asc':  $usersQuery->orderBy('first_name', 'asc'); break;
            case 'name_desc': $usersQuery->orderBy('first_name', 'desc'); break;
            case 'Newest':    $usersQuery->orderBy('created_at', 'desc'); break;
            case 'Oldest':    $usersQuery->orderBy('created_at', 'asc'); break;
            default:          $usersQuery->orderBy('first_name', 'asc'); break;
        }

        $users = $usersQuery->paginate(50)->withQueryString(); // keep filters in pagination
        $templates = MessageTemplate::orderBy('name')->get();

        return view('admin.message_groups.edit', compact('messageGroup', 'users', 'templates'));
    }

    /**
     * Update the specified group in storage.
     */
    public function update(Request $request, int $id)
    {
        $messageGroup = MessageGroup::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'template_id'    => 'nullable|exists:message_templates,id',
            'selected_users' => 'nullable|string',
            'is_active'      => 'nullable|boolean',
            'send_to_all'    => 'nullable|boolean',
        ]);

        $messageGroup->update([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active ?? false,
        ]);

        $sendToAll = $request->boolean('send_to_all');

        if ($sendToAll) {
            $allUserIds = User::pluck('id')->toArray();
            $messageGroup->users()->sync($allUserIds);
        } else {
            $users = $request->filled('selected_users')
                ? array_filter(explode(',', $request->selected_users))
                : [];
            $messageGroup->users()->sync($users);
        }

        if ($request->filled('template_id')) {
            DB::table('group_messages')->updateOrInsert(
                ['group_id' => $messageGroup->id],
                [
                    'template_id' => $request->template_id,
                    'updated_at'  => now(),
                ]
            );
        } else {
            DB::table('group_messages')->where('group_id', $messageGroup->id)->delete();
        }

        return redirect()->route('admin.message-groups.index')
            ->with('success', 'گروه با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified group from storage.
     */
    public function destroy(int $id)
    {
        $messageGroup = MessageGroup::findOrFail($id);

        DB::table('group_messages')->where('group_id', $messageGroup->id)->delete();
        $messageGroup->users()->detach();
        $messageGroup->delete();

        return redirect()->route('admin.message-groups.index')
            ->with('success', 'گروه حذف شد.');
    }
}
