<?php

namespace App\Http\Controllers\MessageTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MessageTemplate\CreateMessageTemplatePostRequest;
use App\Http\Requests\Admin\MessageTemplate\UpdateMessageTemplatePostRequest;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = MessageTemplate::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%");
        }

        $templates = $query->paginate(12);

        return view('admin.notifications.index', [
            'title' => 'مدیریت قالب‌های پیام',
            'templates' => $templates,
        ]);
    }

    public function create()
    {
        return view('admin.notifications.create', [
            'title' => 'ایجاد قالب پیام جدید',
        ]);
    }

    public function store(CreateMessageTemplatePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('message_templates', 'public');
        }

        MessageTemplate::create($data);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'قالب پیام با موفقیت ایجاد شد.');
    }

    public function edit(int $id)
    {
        $notification = MessageTemplate::findOrFail($id);

        return view('admin.notifications.edit', [
            'title' => 'ویرایش قالب پیام',
            'notification' => $notification,
        ]);
    }

    public function update(UpdateMessageTemplatePostRequest $request, int $id)
    {
        $notification = MessageTemplate::findOrFail($id);
        $data = $request->validated();

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($notification->file && \Storage::disk('public')->exists($notification->file)) {
                \Storage::disk('public')->delete($notification->file);
            }

            $data['file'] = $request->file('file')->store('message_templates', 'public');
        }

        $notification->update($data);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'قالب پیام با موفقیت ویرایش شد.');
    }

    public function destroy(MessageTemplate $template)
    {
        $template->delete();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'قالب پیام با موفقیت حذف شد.');
    }

    public function show(int $id)
    {
        $notification = MessageTemplate::findOrFail($id);

        return view('admin.notifications.show', [
            'title' => 'جزئیات قالب پیام',
            'notification' => $notification,
        ]);
    }
}
