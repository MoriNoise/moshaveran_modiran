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
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- last_name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام خانوادگی</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- phone -->
                                    <div class="col-xl-6">
                                        <label class="form-label">تلفن</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- email -->
                                    <div class="col-xl-6">
                                        <label class="form-label">ایمیل</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- gender -->
                                    <div class="col-xl-6">
                                        <label class="form-label">جنسیت</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>مرد</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>زن</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>سایر</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- birthday -->
                                    <div class="col-xl-6">
                                        <label class="form-label">تاریخ تولد</label>
                                        <input type="text" id="birthday_view" class="form-control @error('birthday') is-invalid @enderror" autocomplete="off"
                                               value="{{ old('birthday') }}">
                                        <input type="hidden" id="birthday" name="birthday" value="{{ old('birthday') }}">
                                        @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- organization -->
                                    <div class="col-xl-6">
                                        <label class="form-label">سازمان</label>
                                        <input type="text" class="form-control @error('organization') is-invalid @enderror" name="organization" value="{{ old('organization') }}">
                                        @error('organization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- is_active -->
                                    <div class="col-xl-6">
                                        <label class="form-label">وضعیت فعال</label>
                                        <select class="form-control @error('is_active') is-invalid @enderror" name="is_active">
                                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>فعال</option>
                                            <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>غیرفعال</option>
                                        </select>
                                        @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- extra -->
                                    <div class="col-xl-12">
                                        <label class="form-label">اطلاعات اضافه (JSON)</label>
                                        <textarea class="form-control @error('extra') is-invalid @enderror" name="extra" rows="3">{{ old('extra') }}</textarea>
                                        @error('extra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
