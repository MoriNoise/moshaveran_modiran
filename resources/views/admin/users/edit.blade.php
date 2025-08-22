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

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">ویرایش کاربر</div>
                            </div>

                            <div class="card-body">

                                <!-- User Fields -->
                                <div class="row gy-3">
                                    <div class="col-xl-6">
                                        <label class="form-label">نام</label>
                                        <input type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name', $user->first_name) }}"
                                               placeholder="نام را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">نام خانوادگی</label>
                                        <input type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name', $user->last_name) }}"
                                               placeholder="نام خانوادگی را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">نام کاربری</label>
                                        <input type="text" class="form-control" name="username"
                                               value="{{ old('username', $user->username) }}" placeholder="نام کاربری">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">ایمیل</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{ old('email', $user->email) }}"
                                               placeholder="ایمیل را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">رمز عبور (در صورت تغییر)</label>
                                        <input type="password" class="form-control" name="password"
                                               placeholder="رمز عبور را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">شماره تماس</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ old('phone', $user->phone) }}"
                                               placeholder="شماره تماس را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">تاریخ تولد</label>
                                        <input type="text" id="birth_date" class="form-control" name="birth_date"
                                               value="{{ old('birth_date', $user->birth_date) }}">
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label">جنسیت</label>
                                        <select class="form-control" name="gender">
                                            <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>
                                                مرد
                                            </option>
                                            <option value="2" {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>
                                                زن
                                            </option>
                                            <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>
                                                سایر
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">بیوگرافی</label>
                                        <textarea class="form-control" name="bio" rows="3"
                                                  placeholder="بیوگرافی را وارد کنید">{{ old('bio', $user->bio) }}</textarea>
                                    </div>

                                    <div class="card-avatar">
                                        <!-- Avatar Picker -->
                                        <div class="text-center">
                                            <label class="form-label d-block mb-2 fw-semibold">تصویر پروفایل</label>

                                            <label class="avatar-picker" id="avatarPreview"
                                                   style="background-image: url('{{ $user->files->last()?->filename ? storage_asset($user->files->last()->filename) : asset('assets/admin/images/faces/DefaultAvatar.jpg') }}')">
                                                <input type="file" name="images[]" accept="image/*" multiple
                                                       onchange="previewAvatar(this)">
                                            </label>

                                        </div>
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


