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

        return view('admin.notifications.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(CreateMessageTemplatePostRequest $request)
    {
        $data = $request->validated();

        MessageTemplate::create($data);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Template created successfully.');
    }

    public function edit(int $id)
    {
        $notification = MessageTemplate::findOrFail($id);

        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(UpdateMessageTemplatePostRequest $request, int $id)
    {
       $data =  $request->validated();
        $notification = MessageTemplate::findOrFail($id);
        $notification->update($data);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Template updated successfully.');
    }

    public function destroy(MessageTemplate $template)
    {
        $template->delete();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Template deleted successfully.');
    }


    public function show(int $id)
    {
        $notification = MessageTemplate::findOrFail($id);
     //
        return view('admin.notifications.show', [
            'title' => 'جزییات قالب پیام‌',
            'notification' => $notification,
        ]);
    }

}
