@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">نمایش گروه پیام</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.message-groups.index') }}">گروه‌ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">نمایش گروه</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('admin.message-groups.index') }}" class="btn btn-outline-primary">
                        <i class="ri-arrow-left-line me-1"></i> بازگشت به لیست گروه‌ها
                    </a>
                </div>
            </div>

            @include('admin.layouts.alerts')

            <!-- Group Info (Full Width) -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">اطلاعات گروه پیام</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap justify-content-between">
                            <div class="mb-3 w-50">
                                <strong>نام گروه:</strong>
                                <span class="ms-2">{{ $messageGroup->name }}</span>
                            </div>
                            <div class="mb-3 w-50">
                                <strong>توضیحات:</strong>
                                <span class="ms-2">{{ $messageGroup->description ?? '-' }}</span>
                            </div>
                            <div class="mb-3 w-50">
                                <strong>قالب پیام اختصاص داده شده:</strong>
                                <span class="badge bg-info">{{ $messageGroup->groupMessage?->template?->name ?? '-' }}</span>
                            </div>
                            <div class="mb-3 w-50">
                                <strong>ایجاد شده توسط:</strong>
                                <span class="badge bg-secondary">{{ get_admin_full_name($messageGroup->admin?->id) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">لیست کاربران گروه</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered mb-0 text-nowrap">
                                    <thead class="table-light">
                                    <tr>
                                        <th>نام و نام خانوادگی</th>
                                        <th>ایمیل</th>
                                        <th>شماره تماس</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($messageGroup->users as $user)
                                        <tr>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->email ?? '-' }}</td>
                                            <td>{{ $user->phone ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->is_active ? 'فعال' : 'غیرفعال' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">هیچ کاربری در این گروه وجود ندارد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
