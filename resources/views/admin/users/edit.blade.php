@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ویرایش کاربر</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">کاربران</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش کاربر</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">ویرایش کاربر</div>
                            </div>

                            <div class="card-body">
                                <div class="row gy-3">

                                    <!-- First Name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                               name="first_name" value="{{ old('first_name', $user->first_name) }}">
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام خانوادگی</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-xl-6">
                                        <label class="form-label">شماره تماس</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-xl-6">
                                        <label class="form-label">ایمیل</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email', $user->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-xl-6">
                                        <label class="form-label">جنسیت</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>مرد</option>
                                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>زن</option>
                                            <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>نامشخص</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Birthday (Persian date picker) -->
                                    <div class="col-xl-6">
                                        <label class="form-label">تاریخ تولد</label>
                                        <input type="text" id="birthday_view" class="form-control @error('birthday') is-invalid @enderror"
                                               name="birthday" value="{{ old('birthday', $user->birthday) }}">
                                        <input type="hidden" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}">
                                        @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Organization -->
                                    <div class="col-xl-6">
                                        <label class="form-label">سازمان</label>
                                        <input type="text" class="form-control @error('organization') is-invalid @enderror"
                                               name="organization" value="{{ old('organization', $user->organization) }}">
                                        @error('organization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Active -->
                                    <div class="col-xl-6">
                                        <label class="form-label">فعال / غیر فعال</label>
                                        <select class="form-control @error('is_active') is-invalid @enderror" name="is_active">
                                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>فعال</option>
                                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>غیر فعال</option>
                                        </select>
                                        @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Extra JSON -->
                                    <div class="col-xl-12">
                                        <label class="form-label">اطلاعات اضافی (JSON)</label>
                                        <textarea class="form-control @error('extra') is-invalid @enderror"
                                                  name="extra" rows="3">{{ old('extra', $user->extra) }}</textarea>
                                        @error('extra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
