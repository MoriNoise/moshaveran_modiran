@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">افزودن کاربران از VCF</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
                                <li class="breadcrumb-item active" aria-current="page">افزودن از VCF</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">

                    <form action="{{ route('admin.users.import.vcf.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">افزودن کاربران از فایل VCF</div>
                            </div>

                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label class="form-label">انتخاب فایل VCF</label>
                                        <input type="file" class="form-control" name="vcf_file"
                                               accept=".vcf,.txt" required>
                                        <small class="text-muted">فقط فایل‌های VCF یا TXT مجاز هستند.</small>
                                    </div>
                                    @error('vcf_file')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="ri-upload-line me-1"></i> بارگذاری و افزودن
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
