<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MessageGroup;
use Illuminate\Http\Request;

class GroupMessageController extends Controller
{
    public function index(Request $request)
    {
        $groups = MessageGroup::with(['users:id,first_name,last_name,email,phone,gender', 'templateApi'])
            ->withCount('users')
            ->where('is_active', 1)
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
            ->get();

        // Add full URL for template file
        $groups->transform(function ($group) {
            if ($group->templateApi && $group->templateApi->template) {
                $filePath = $group->templateApi->template->file;
                $group->templateApi->template->file = $filePath
                    ? url('storage/' . ltrim($filePath, '/'))
                    : null;
            }
            return $group;
        });


        return response()->json($groups);
    }
}
