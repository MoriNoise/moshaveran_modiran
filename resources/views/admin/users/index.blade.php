@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست کاربران</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">مدیریت کاربران</a></li>
                            <li class="breadcrumb-item active" aria-current="page">لیست کاربران</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- Page Header End -->

            @include('admin.layouts.alerts')

            <!-- Search & Sort -->
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.users.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>کاربر جدید
                                    </a>
                                    <a href="{{ route('admin.users.import.vcf') }}" class="btn btn-success me-2">
                                        <i class="ri-file-add-line me-1 fw-medium align-middle"></i>افزودن از VCF
                                    </a>
                                    <select id="choices-single-default" class="form-control" name="sort">
                                        <option value="">مرتب‌سازی بر اساس</option>
                                        <option
                                            value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            الفبا (الف - ی)
                                        </option>
                                        <option
                                            value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            الفبا (ی - الف)
                                        </option>
                                        <option
                                            value="Date Added" {{ request('sort') == 'Date Added' ? 'selected' : '' }}>
                                            تاریخ اضافه شدن
                                        </option>
                                        <option value="Newest" {{ request('sort') == 'Newest' ? 'selected' : '' }}>
                                            جدیدترین
                                        </option>
                                        <option value="Type" {{ request('sort') == 'Type' ? 'selected' : '' }}>نوع
                                        </option>
                                    </select>

                                </div>

                                <div class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" name="search"
                                           placeholder="جستجوی کاربر" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Search & Sort -->

            <!-- Users Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th>شماره تماس</th>
                                    <th>جنسیت</th>
                                
                                    <th>وضعیت</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-rounded p-1 bg-primary-transparent me-2">
                                                    <img src="{{ getUserAvatarUrl($user) }}" alt="آواتار کاربر">
                                                </span>
                                                <div class="flex-fill">
                                                    <a href="javascript:void(0);"
                                                       class="fw-medium fs-14 d-block text-truncate">
                                                        {{ get_user_full_name($user->id) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>
                                            @if($user->gender === 'male')
                                                مرد
                                            @elseif($user->gender === 'female')
                                                زن
                                            @else
                                                نامشخص
                                            @endif
                                        </td>
                                       
                                        <td>
                                            <span
                                                class="badge {{ $user->is_active ? 'bg-success-transparent' : 'bg-danger-transparent' }}">
                                                {{ $user->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" title="ویرایش">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این کاربر مطمئن هستید؟')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm" data-bs-toggle="tooltip"
                                                   title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $user->id }}"
                                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $users->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Users Table -->

        </div>
    </div>
@endsection
