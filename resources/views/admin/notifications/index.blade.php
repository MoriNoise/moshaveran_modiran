@extends('admin.layouts.base')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست اعلان‌ها</h1>
                    <div class="">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">اعلان‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست اعلان‌ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.notifications.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>اعلان‌ جدید
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
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو اعلان" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Start::row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card ">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>کاربر</th>
                                    <th>عنوان</th>
                                    <th>پیام</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <span class="avatar avatar-rounded p-1 bg-primary-transparent">
                                                        <img src="{{ $notification->user->files->last()?->filename ? asset('storage/'.$notification->user->files->last()->filename) : asset('assets/admin/images/faces/DefaultAvatar.jpg') }}"
                                                             alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <a href="javascript:void(0);"
                                                       class="fw-medium fs-14 d-block text-truncate">{{ get_user_full_name($notification->user->id) }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ Str::limit($notification->message, 50) }}</td>
                                        <td>
                                            <span class="badge {{ $notification->is_read ? 'bg-success-transparent' : 'bg-warning-transparent' }}">
                                                {{ $notification->is_read ? 'خوانده شده' : 'خوانده نشده' }}
                                            </span>
                                        </td>
                                        <td>{{ verta($notification->created_at)->format('j F Y - H:i') }}</td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.notifications.show', $notification->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.notifications.edit', $notification->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این اعلان مطمئن هستید؟')) { document.getElementById('delete-form-{{ $notification->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm" title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $notification->id }}"
                                                      action="{{ route('admin.notifications.destroy', $notification->id) }}"
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
                    </div>
                </div>
            </div>
            <!-- End::row-2 -->

            <ul class="pagination justify-content-end">
                <li class="page-item {{ $notifications->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                       href="{{ $notifications->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $notifications->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $notifications->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $notifications->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>

        </div>
    </div>

@endsection
