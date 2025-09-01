@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">{{ $user->first_name . ' ' . $user->last_name }}</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
                                <li class="breadcrumb-item active" aria-current="page">جزئیات کاربر</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">ویرایش کاربر</a>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <!-- User Info Card -->
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">اطلاعات کاربر</div>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">

                        <dt class="col-sm-3 my-2 fw-semibold">نام:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->first_name }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">نام خانوادگی:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->last_name }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">ایمیل:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->email }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">شماره تماس:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->phone ?? '-' }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">جنسیت:</dt>
                        <dd class="col-sm-9 my-2">{{ ucfirst($user->gender) ?? '-' }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">تاریخ تولد:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->birthday ?? '-' }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">سازمان:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->organization ?? '-' }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">فعال / غیر فعال:</dt>
                        <dd class="col-sm-9 my-2">{{ $user->is_active ? 'فعال' : 'غیر فعال' }}</dd>

                        <dt class="col-sm-3 my-2 fw-semibold">اطلاعات اضافی (JSON):</dt>
                        <dd class="col-sm-9 my-2"><pre>{{ $user->extra ?? '-' }}</pre></dd>

                        <dt class="col-sm-3 my-2 fw-semibold">تصویر پروفایل:</dt>
                        <dd class="col-sm-9 my-2">
                            <img src="{{ getUserAvatarUrl($user) }}" alt="تصویر پروفایل" class="rounded" style="max-width: 150px;">
                        </dd>

                    </dl>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">بازگشت</a>
                </div>
            </div>

        </div>
    </div>
@endsection
