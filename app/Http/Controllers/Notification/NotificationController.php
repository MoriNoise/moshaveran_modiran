<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\CreateNotificationPostRequest;
use App\Http\Requests\Admin\Notification\UpdateNotificationPostRequest;
use App\Models\MessageTemplate;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $query = MessageTemplate::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%");
            })->orWhere('title', 'like', "%$search%");
        }

        $notifications = $query->paginate(12);

        return view('admin.notifications.index', compact('notifications'));
    }


    public function create()
    {
        $users = User::orderBy('first_name')->get();
        return view('admin.notifications.create', compact('users'));
    }

    public function store(CreateNotificationPostRequest $request)
    {
        $request->validated();

        MessageTemplate::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => $request->is_read ?? false,
        ]);

        return redirect()->route('admin.notifications.index')->with('success', 'اعلان با موفقیت اضافه شد.');
    }


    public function edit(MessageTemplate $notification)
    {
        $users = User::orderBy('first_name')->get();
        return view('admin.notifications.edit', compact('notification', 'users'));
    }


    public function update(UpdateNotificationPostRequest $request, MessageTemplate $notification)
    {
        $request->validated();

        $notification->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => $request->is_read ?? $notification->is_read,
        ]);

        return redirect()->route('admin.notifications.index')->with('success', 'اعلان با موفقیت بروزرسانی شد.');
    }


    public function destroy(MessageTemplate $notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications.index')->with('success', 'اعلان حذف شد.');
    }

    public function show(MessageTemplate $notification)
    {
        $notification->load('user');
        return view('admin.notifications.show', compact('notification'));
    }

}
