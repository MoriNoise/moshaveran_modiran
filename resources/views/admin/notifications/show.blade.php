@extends('admin.layouts.base')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">جزئیات قالب پیام</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.notifications.index') }}">قالب پیام‌ها</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">جزئیات قالب</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.notifications.edit', $notification->id) }}" class="btn btn-warning">
                        ویرایش قالب
                    </a>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <strong>نام قالب:</strong>
                                    <p>{{ $notification->name }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>دسته‌بندی:</strong>
                                    <p>{{ $notification->category ?? '-' }}</p>
                                </div>

                                <div class="col-xl-12">
                                    <strong>محتوا:</strong>
                                    <p>{!! nl2br(e($notification->content)) !!}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>تاریخ ایجاد:</strong>
                                    <p>{{ $notification->created_at?->format('Y/m/d H:i') }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>آخرین بروزرسانی:</strong>
                                    <p>{{ $notification->updated_at?->format('Y/m/d H:i') }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                                بازگشت به لیست قالب‌ها
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
