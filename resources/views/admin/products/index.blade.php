@extends('admin.layouts.base')


@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست محصولات</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">محصولات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست محصولات</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')

            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.products.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>ایجاد محصول
                                    </a>
                                    <select id="choices-single-default" class="form-control" name="sort">
                                        <option value="">مرتب‌سازی بر اساس</option>
                                        <option
                                            value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            الفبا (الف - ی)
                                        </option>
                                        <option
                                            value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            الفبا (ی - الف)
                                        </option>
                                        <option
                                            value="Date Added" {{ request('sort') == 'Date Added' ? 'selected' : '' }}>
                                            تاریخ اضافه شدن
                                        </option>
                                        <option value="Newest" {{ request('sort') == 'Newest' ? 'selected' : '' }}>
                                            جدیدترین
                                        </option>
                                        <option value="Type" {{ request('sort') == 'Type' ? 'selected' : '' }}>نوع
                                        </option>
                                    </select>

                                </div>
                                <div class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو محصول" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Start::row-2 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th>محصول</th>
                                    <th>دسته‌بندی</th>
                                    <th>قیمت</th>
                                    <th>قیمت تخفیف‌خورده</th>
                                    <th>موجودی</th>
                                    <th>وضعیت</th>
                                    <th>منتشر شده</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="product-list">
                                        <td>
                                            <div class="d-flex">
                            <span class="avatar avatar-md avatar-square bg-light">
                                <img
                                        src="{{ getProductImageUrl($product) }}"
                                        class="w-100 h-100" alt="{{ $product->name }}">
                            </span>
                                                <div class="ms-2">
                                                    <p class="fw-semibold mb-0 name-limit">
                                                        <a href="javascript:void(0);">{{ $product->name }}</a>
                                                    </p>
                                                    <p class="fs-12 text-muted mb-0 description-limit">{{ $product->description ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td>{{ number_format($product->price) }} تومان</td>
                                        <td>
                                            @if($product->discount_price)
                                                <span class="text-success">{{ number_format($product->discount_price) }} تومان</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                        <span
                                class="badge {{ $product->is_active ? 'bg-primary-transparent' : 'bg-danger-transparent' }}">
                            {{ $product->is_active ? 'منتشر شد' : 'پیش‌نویس' }}
                        </span>
                                        </td>
                                        <td>{{ verta($product->created_at)->format('j F Y - H:i') }}</td>

                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.products.show', $product->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger-light">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End::row-2 -->


            <ul class="pagination justify-content-end">
                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $products->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>
        </div>
    </div>

@endsection


