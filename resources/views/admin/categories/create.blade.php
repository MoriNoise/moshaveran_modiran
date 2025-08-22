@extends('admin.layouts.base')



@section('content')

    <div class="main-content app-content">
        <div class="container-fluid pt-4">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ایجاد دسته‌بندی جدید</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.categories.index') }}">دسته‌بندی‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ایجاد دسته‌بندی</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">

                    <!-- Create Category Form -->
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom-card mb-4">
                            <div class="card-header">
                                <div class="card-title">ایجاد دسته‌بندی</div>
                            </div>

                            <div class="card-body">

                                <div class="row gy-3">
                                    <div class="col-xl-6">
                                        <label class="form-label">نام دسته‌بندی</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                               placeholder="نام دسته‌بندی را وارد کنید">
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label">نامک (Slug)</label>
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"
                                               placeholder="نامک را وارد کنید">
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">توضیحات</label>
                                        <textarea class="form-control" name="description" rows="3"
                                                  placeholder="توضیحات دسته‌بندی را وارد کنید">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="card-avatar mt-3" style="min-height: unset">
                                    <div class="text-center">
                                        <label class="form-label d-block mb-2 fw-semibold">تصویر دسته بندی</label>
                                        <label class="avatar-picker" id="avatarPreview"
                                               style="background-image: url('{{ asset('assets/admin/images/faces/DefaultAvatar.jpg') }}')">
                                            <input type="file" name="images[]" accept="image/*" multiple
                                                   onchange="previewAvatar(this)">
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">ایجاد دسته‌بندی</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
