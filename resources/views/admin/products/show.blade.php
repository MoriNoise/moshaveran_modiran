@extends('admin.layouts.base')



@section('content')

    <div class="main-content app-content">
        <div class="container-fluid pt-4">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">جزئیات محصول</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">محصولات</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">جزئیات محصول</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">

                            <!-- Product Images -->
                            <div class="image-upload-wrapper d-flex flex-wrap gap-2 mb-4"
                                 style="border-radius: 8px; padding: 10px;">
                                @if($product->files && count($product->files))
                                    @foreach($product->files as $img)
                                        <div style="width:150px;height:150px;">
                                            <img src="{{ asset('storage/'.$img->filename) }}" class="img-fluid rounded"
                                                 style="width:100%;height:100%;object-fit:cover;" alt="تصویر محصول">
                                        </div>
                                    @endforeach
                                @else
                                    <div style="width:150px;height:150px;display:flex;align-items:center;justify-content:center;background:#f0f0f0;border-radius:8px;color:#999;">
                                        تصویری موجود نیست
                                    </div>
                                @endif
                            </div>

                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <strong>نام محصول:</strong>
                                    <p>{{ $product->name }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>اسلاگ:</strong>
                                    <p>{{ $product->slug }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>دسته‌بندی:</strong>
                                    <p>{{ $product->category ? $product->category->name : 'ندارد' }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>قیمت:</strong>
                                    <p>{{ number_format($product->price) }} تومان</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>قیمت تخفیفی:</strong>
                                    <p>
                                        @if($product->discount_price)
                                            {{ number_format($product->discount_price) }} تومان
                                        @else
                                            —
                                        @endif
                                    </p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>موجودی:</strong>
                                    <p>{{ $product->stock }}</p>
                                </div>

                                <div class="col-xl-6">
                                    <strong>وضعیت:</strong>
                                    <p>
                                        @if($product->is_active)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیرفعال</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-xl-12">
                                    <strong>توضیحات:</strong>
                                    <p>{!! nl2br(e($product->description)) !!}</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                بازگشت به لیست محصولات
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning ms-2">ویرایش محصول</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
