@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">اعلان جدید</h1>
                    <div class="">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.notifications.index') }}">اعلان‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ایجاد اعلان</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ route('admin.notifications.store') }}" method="POST">
                                @csrf

                                <!-- name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام اعلان</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">محتوا</label>
                                    <textarea name="content" id="content" rows="4"
                                              class="form-control">{{ old('content') }}</textarea>
                                    @error('content')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- category -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">دسته‌بندی</label>
                                    <input type="text" name="category" id="category" class="form-control"
                                           value="{{ old('category') }}">
                                    @error('category')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                                    ایجاد اعلان
                                </button>
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">بازگشت</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
