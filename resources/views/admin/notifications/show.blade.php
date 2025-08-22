@extends('admin.layouts.base')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">جزئیات اعلان</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a
                                            href="{{ route('admin.notifications.index') }}">اعلان‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">جزئیات اعلان</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.notifications.edit', $notification->id) }}" class="btn btn-warning">ویرایش
                        اعلان</a>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <!-- User Info -->
                            <div class="d-flex align-items-center mb-4" style="gap:15px;">

                                <img src="{{ $notification->user->files->last()?->filename ? asset('storage/'.$notification->user->files->last()->filename) : asset('assets/admin/images/faces/DefaultAvatar.jpg') }}"
                                     alt="آواتار کاربر"
                                     class="rounded-circle"
                                     style="width:60px;height:60px;object-fit:cover;">

                                <div>

                                    <strong>{{ get_user_full_name($notification->user->id)}}</strong><br>
                                    <small class="text-muted">{{ $notification->user->email ?? '' }}</small>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <strong>عنوان:</strong>
                                    <p>{{ $notification->title }}</p>
                                </div>

                                <div class="col-xl-12">
                                    <strong>پیام:</strong>
                                    <p>{!! nl2br(e($notification->message)) !!}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>وضعیت:</strong>
                                    <p>
                                        @if($notification->is_read)
                                            <span class="badge bg-success">خوانده شده</span>
                                        @else
                                            <span class="badge bg-warning">خوانده نشده</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>تاریخ ایجاد:</strong>
                                    <p>{{ $notification->created_at?->format('Y/m/d H:i') }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">بازگشت به لیست
                                اعلان‌ها</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
