@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ویرایش گروه پیام</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.message-groups.index') }}">گروه‌ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش گروه</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header End -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ route('admin.message-groups.update', $messageGroup->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Group Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام گروه</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $messageGroup->name) }}">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Group Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">توضیحات</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $messageGroup->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message Template -->
                                <div class="mb-3">
                                    <label for="template_id" class="form-label">قالب پیام</label>
                                    <select name="template_id" id="template_id" class="form-control">
                                        <option value="">انتخاب قالب پیام</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}"
                                                {{ old('template_id', optional($messageGroup->template)->template?->id) == $template->id ? 'selected' : '' }}>
                                                {{ $template->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('template_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Users Table -->
                                <div class="mb-3">
                                    <label class="form-label">انتخاب کاربران</label>
                                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-hover text-nowrap table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:50px;"><input type="checkbox" id="select-all"></th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>ایمیل</th>
                                                <th>شماره تماس</th>
                                                <th>وضعیت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                                            {{ in_array($user->id, old('users', $messageGroup->users->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                    </td>
                                                    <td>{{ $user->first_name }} {{ $user->last_name ?? '' }}</td>
                                                    <td>{{ $user->email ?? '-' }}</td>
                                                    <td>{{ $user->phone ?? '-' }}</td>
                                                    <td>
                                                        <span class="badge {{ $user->is_active ? 'bg-success-transparent' : 'bg-danger-transparent' }}">
                                                            {{ $user->is_active ? 'فعال' : 'غیرفعال' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @error('users')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">ذخیره تغییرات</button>
                                <a href="{{ route('admin.message-groups.index') }}" class="btn btn-light">بازگشت</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Select/Deselect all checkboxes
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="users[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endsection
