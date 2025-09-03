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
    public function create()
    {
        $users = User::orderBy('first_name')->paginate(10);
        $templates = MessageTemplate::orderBy('name')->get();

        return view('admin.message_groups.create', compact('users', 'templates'));
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'nullable|exists:message_templates,id',
            'users'       => 'nullable|array',
            'users.*'     => 'exists:users,id',
        ]);

        // Create group
        $group = MessageGroup::create([
            'name'        => $request->name,
            'description' => $request->description,
            'created_by'  => auth()->id(),
        ]);

        // Sync users
        if ($request->filled('users')) {
            $group->users()->sync($request->users);
        }

        // Assign template in group_messages
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
    public function edit(int $id)
    {
        $messageGroup = MessageGroup::with('users', 'template.template')->findOrFail($id);

        $selectedUserIds = $messageGroup->users->pluck('id')->toArray();

        $usersQuery = User::query();

        // Search
        if ($search = request('search')) {
            $usersQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($gender = request('gender')) {
            $usersQuery->where('gender', $gender);
        }

        if (request()->has('status')) {
            $usersQuery->where('is_active', request('status'));
        }

        // Move selected users to top
        if (!empty($selectedUserIds)) {
            $idsString = implode(',', $selectedUserIds);
            $usersQuery->orderByRaw("FIELD(id, {$idsString}) DESC");
        }

        // Sorting
        if ($sort = request('sort')) {
            switch ($sort) {
                case 'name_asc': $usersQuery->orderBy('first_name', 'asc'); break;
                case 'name_desc': $usersQuery->orderBy('first_name', 'desc'); break;
                case 'Newest': $usersQuery->orderBy('created_at', 'desc'); break;
                case 'Oldest': $usersQuery->orderBy('created_at', 'asc'); break;
            }
        } else {
            $usersQuery->orderBy('first_name', 'asc');
        }

        $users = $usersQuery->paginate(10)->withQueryString(); // keep filters in pagination links
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
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'nullable|exists:message_templates,id',
            'selected_users' => 'nullable|string', // new hidden input
            'is_active' => 'nullable|boolean:', // new hidden input
        ]);

        // Update group info
        $messageGroup->update([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        // Convert selected_users (comma-separated string) to array
        $users = $request->filled('selected_users')
            ? array_filter(explode(',', $request->selected_users))
            : [];

        // Sync users
        if (!empty($users)) {
            $messageGroup->users()->sync($users);
        } else {
            $messageGroup->users()->detach();
        }

        // Update or insert template assignment in group_messages
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

        // Remove associated group_messages
        DB::table('group_messages')->where('group_id', $messageGroup->id)->delete();

        // Detach users
        $messageGroup->users()->detach();

        // Delete group
        $messageGroup->delete();

        return redirect()->route('admin.message-groups.index')
            ->with('success', 'گروه حذف شد.');
    }
}
