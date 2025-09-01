@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ایجاد کاربر</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">کاربران</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ایجاد کاربر</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">ایجاد کاربر</div>
                            </div>

                            <div class="card-body">
                                <div class="row gy-3">

                                    <!-- first_name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                    </div>

                                    <!-- last_name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام خانوادگی</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                    </div>

                                    <!-- gender -->
                                    <div class="col-xl-6">
                                        <label class="form-label">جنسیت</label>
                                        <select class="form-control" name="gender">
                                            <option value="male">مرد</option>
                                            <option value="female">زن</option>
                                            <option value="other">سایر</option>
                                        </select>
                                    </div>

                                    <!-- birthday with Persian DatePicker -->
                                    <div class="col-xl-6">
                                        <label class="form-label">تاریخ تولد</label>
                                        <input type="text" id="birthday_view" class="form-control" autocomplete="off"
                                               value="{{ old('birthday') }}">
                                        <input type="hidden" id="birthday" name="birthday" value="{{ old('birthday') }}">
                                    </div>

                                    <!-- organization -->
                                    <div class="col-xl-6">
                                        <label class="form-label">سازمان</label>
                                        <input type="text" class="form-control" name="organization" value="{{ old('organization') }}">
                                    </div>

                                    <!-- is_active -->
                                    <div class="col-xl-6">
                                        <label class="form-label">وضعیت فعال</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1">فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                    </div>

                                    <!-- extra -->
                                    <div class="col-xl-12">
                                        <label class="form-label">اطلاعات اضافه (JSON)</label>
                                        <textarea class="form-control" name="extra" rows="3">{{ old('extra') }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">ایجاد کاربر</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


