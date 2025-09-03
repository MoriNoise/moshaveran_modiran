<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Http\Requests\Admin\Admin\CreateAdminPostRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminPutRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');

        $admins = Admin::when($search, function ($query, $search) {
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

        return view('admin.admins.index', [
            'title' => 'لیست مدیران',
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return view('admin.admins.create', [
            'title' => 'ساخت مدیر',
        ]);
    }

    public function store(CreateAdminPostRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('admins', 'public');
            $data['avatar'] = $path;
        }
        $admin = Admin::create($data);

        return redirect()->route('admin.admins.index')->with('success', 'مدیر با موفقیت ساخته شد');
    }

    public function edit(int $id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admins.edit', [
            'title' => 'ویرایش مدیر',
            'admin' => $admin,
        ]);
    }

    public function update(int $id, UpdateAdminPutRequest $request)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Handle avatar
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('admins', 'public');
            $data['avatar'] = $path;
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'مدیر با موفقیت ویرایش شد');
    }

//    public function deleteImage(Admin $admin, File $file)
//    {
//        $admin->files()->detach($file->id);
//
//        if ($file->fileables()->count() === 0) {
//            \Storage::disk('public')->delete($file->filename);
//            $file->delete();
//        }
//
//        return back()->with('success', 'عکس با موفقیت حذف شد');
//    }

    public function destroy(int $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'مدیر با موفقیت حذف شد');
    }
}
