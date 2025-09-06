@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ایجاد گروه پیام</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.message-groups.index') }}">گروه‌ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد گروه</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header End -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form action="{{ route('admin.message-groups.store') }}" method="POST">
                            @csrf

                            <!-- Group Info -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">نام گروه</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">وضعیت گروه</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                    </select>
                                    @error('is_active') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">قالب پیام</label>
                                    <select name="template_id" class="form-control">
                                        <option value="">انتخاب قالب پیام</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                                {{ $template->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('template_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Group Description -->
                            <div class="mb-3">
                                <label class="form-label">توضیحات</label>
                                <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- Users Table -->
                            <div class="mb-3">
                                <label class="form-label">انتخاب کاربران</label>

                                <!-- Send to All -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="send-to-all">
                                    <label class="form-check-label" for="send-to-all">ارسال به همه کاربران</label>
                                </div>
                                <input type="hidden" name="send_to_all" id="send-to-all-input" value="0">

                                <!-- Filters -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input type="text" id="filter-search" value="{{ request('search') }}" class="form-control" placeholder="جستجو در کاربران (نام، ایمیل، شماره)">
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-gender" class="form-control">
                                            <option value="">همه جنسیت‌ها</option>
                                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>مرد</option>
                                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>زن</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="filter-status" class="form-control">
                                            <option value="">همه وضعیت‌ها</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>فعال</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>غیرفعال</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="apply-filters" class="btn btn-primary w-100">فیلتر</button>
                                    </div>
                                </div>

                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-hover text-nowrap table-bordered mb-0" id="users-table">
                                        <thead>
                                        <tr>
                                            <th style="width:50px;"><input type="checkbox" id="select-all"></th>
                                            <th>نام و نام خانوادگی</th>
                                            <th>ایمیل</th>
                                            <th>شماره تماس</th>
                                            <th>جنسیت</th>
                                            <th>وضعیت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="users-checkbox" value="{{ $user->id }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-rounded p-1 bg-primary-transparent me-2">
                                                        <img src="{{ getUserAvatarUrl($user) }}" alt="آواتار کاربر">
                                                    </span>
                                                        <div class="flex-fill">
                                                        <span class="fw-medium fs-14 d-block text-truncate">
                                                            {{ $user->first_name }} {{ $user->last_name ?? '' }}
                                                        </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email ?? '-' }}</td>
                                                <td>{{ $user->phone ?? '-' }}</td>
                                                <td>
                                                    @if($user->gender === 'male') مرد
                                                    @elseif($user->gender === 'female') زن
                                                    @else نامشخص
                                                    @endif
                                                </td>
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

                                <!-- Hidden input for selected users -->
                                <input type="hidden" name="selected_users" id="selected-users" value="{{ implode(',', old('users', [])) }}">

                                <!-- Pagination -->
                                <div class="mt-3">
                                    {{ $users->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">ایجاد گروه</button>
                            <a href="{{ route('admin.message-groups.index') }}" class="btn btn-light">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let selectedUsers = new Set(
            (localStorage.getItem('selected_users') || document.getElementById('selected-users').value).split(',').filter(Boolean)
        );

        function applySelections() {
            const sendAll = document.getElementById('send-to-all').checked;

            document.querySelectorAll('input[name="users-checkbox"]').forEach(cb => {
                cb.checked = sendAll ? true : selectedUsers.has(cb.value);
                cb.disabled = sendAll;
            });

            const allCheckboxes = document.querySelectorAll('input[name="users-checkbox"]');
            document.getElementById('select-all').checked = allCheckboxes.length && Array.from(allCheckboxes).every(cb => cb.checked);
            document.getElementById('send-to-all-input').value = sendAll ? 1 : 0;
        }

        applySelections();

        document.querySelectorAll('input[name="users-checkbox"]').forEach(cb => {
            cb.addEventListener('change', function() {
                if(this.checked) selectedUsers.add(this.value);
                else selectedUsers.delete(this.value);

                localStorage.setItem('selected_users', Array.from(selectedUsers).join(','));
                document.getElementById('selected-users').value = Array.from(selectedUsers).join(',');
                applySelections();
            });
        });

        document.getElementById('select-all').addEventListener('click', function() {
            document.querySelectorAll('input[name="users-checkbox"]').forEach(cb => {
                cb.checked = this.checked;
                if(this.checked) selectedUsers.add(cb.value);
                else selectedUsers.delete(cb.value);
            });
            localStorage.setItem('selected_users', Array.from(selectedUsers).join(','));
            document.getElementById('selected-users').value = Array.from(selectedUsers).join(',');
        });

        document.getElementById('send-to-all').addEventListener('change', function() {
            if(this.checked) selectedUsers = new Set(); // clear individual selections
            applySelections();
            document.getElementById('selected-users').value = Array.from(selectedUsers).join(',');
        });

        document.getElementById('apply-filters').addEventListener('click', function() {
            const params = new URLSearchParams(window.location.search);
            params.set('search', document.getElementById('filter-search').value);
            params.set('gender', document.getElementById('filter-gender').value);
            params.set('status', document.getElementById('filter-status').value);
            window.location.search = params.toString();
        });

        document.getElementById('filter-search').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') document.getElementById('apply-filters').click();
        });

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('selected-users').value = Array.from(selectedUsers).join(',');
            localStorage.removeItem('selected_users');
        });
    </script>
@endsection
