@extends('admin.layouts.base')


@section('content')



    <div class="main-content app-content">
        <div class="container-fluid">


            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست ادمین‌ها</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">ادمین‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست ادمین‌ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <!-- Filter + Search -->
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.admins.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>ایجاد مدیر
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
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو ادمین" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th><input class="form-check-input check-all" type="checkbox" id="all-admins"></th>
                                    <th>تصویر</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>نام کاربری</th>
                                    <th>ایمیل</th>
                                    <th>وضعیت</th>
                                    <th>ادمین ارشد</th>
                                    <th>آخرین ورود</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="{{ $admin->id }}">
                                        </td>
                                        <td>
                                            <span class="avatar avatar-md avatar-square bg-light">
                                                <img src="{{ getAdminAvatarUrl($admin) }}"
                                                     class="w-100 h-100" alt="{{ $admin->first_name }}">
                                            </span>
                                        </td>
                                        <td>{{ $admin->first_name ?? '-' }}</td>
                                        <td>{{ $admin->last_name ?? '-' }}</td>
                                        <td>{{ $admin->username ?? '-' }}</td>
                                        <td>{{ $admin->email ?? '-' }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $admin->is_active ? 'bg-primary-transparent' : 'bg-danger-transparent' }}">
                                                {{ $admin->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $admin->is_super ? 'bg-success-transparent' : 'bg-secondary-transparent' }}">
                                                {{ $admin->is_super ? 'بله' : 'خیر' }}
                                            </span>
                                        </td>
                                        <td>{{ $admin->last_login_at ? verta($admin->last_login_at)->format('j F Y - H:i') : '-' }}</td>
                                        <td>{{ $admin->created_at ? verta($admin->created_at)->format('j F Y - H:i') : '-' }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.admins.destroy', $admin->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('آیا از حذف این ادمین مطمئن هستید؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger-light">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">هیچ ادمینی یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div>
                <ul class="pagination justify-content-end mt-3">
                    <li class="page-item {{ $admins->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $admins->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                    </li>
                    @foreach ($admins->getUrlRange(1, $admins->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $admins->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $admins->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $admins->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

@endsection
