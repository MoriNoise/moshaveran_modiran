@extends('admin.layouts.base')


@section('content')
    <div class="main-content app-content">

        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ویرایش سفارش #{{ $order->tracking_code }}</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">سفارشات</a></li>
                            <li class="breadcrumb-item active">ویرایش سفارش</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')

            <!-- Edit Form -->
            <div class="card custom-card">
                <div class="card-body">

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">وضعیت سفارش</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                @php
                                    $statuses = [
                                        'pending' => 'در انتظار',
                                        'processing' => 'در حال پردازش',
                                        'shipped' => 'ارسال شده',
                                        'cancelled' => 'لغو شده',
                                    ];
                                @endphp
                                @foreach($statuses as $key => $label)
                                    <option
                                            value="{{ $key }}" {{ old('status', $order->status) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tracking Code -->
                        <div class="mb-3">
                            <label for="tracking_code" class="form-label fw-semibold">کد پیگیری</label>
                            <input type="text" name="tracking_code" id="tracking_code"
                                   class="form-control @error('tracking_code') is-invalid @enderror"
                                   value="{{ old('tracking_code', $order->tracking_code) }}">
                            @error('tracking_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-semibold">یادداشت‌ها</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $order->notes) }}</textarea>
                            @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Order Items -->
                        <!-- جدول محصولات سفارش -->
                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <h5 class="card-title">محصولات سفارش</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table text-nowrap table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th>حذف</th>
                                        <th>محصول</th>
                                        <th>دسته‌بندی</th>
                                        <th>قیمت واحد</th>
                                        <th>تعداد</th>
                                        <th>قیمت کل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        @php $product = $item->product; @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="remove_items[]" value="{{ $item->id }}">
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($product)

                                                        <span class="avatar avatar-md avatar-square bg-light me-2">
                                                            <img
                                                                    src="{{ getProductImageUrl($product) }}"
                                                                    alt="{{ $product->name }}"
                                                                    class="w-100 h-100"/>
                                                        </span>
                                                    @else
                                                        <span class="avatar avatar-md avatar-square bg-light me-2">
                                                            <img src="{{ asset('assets/admin/images/product-default-image.png') }}"
                                                                 alt="تصویر پیش‌فرض"
                                                                 class="w-100 h-100"/>
                                                        </span>
                                                    @endif

                                                    <div>
                                                        <div
                                                                class="fw-semibold">{{ $product->name ?? 'بدون نام' }}</div>
                                                        <small
                                                                class="text-muted">{{ $product->category->name ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $product->category->name ?? '-' }}</td>
                                            <td>{{ number_format($item->unit_price) }} تومان</td>
                                            <td>
                                                <input type="number" name="items[{{ $item->id }}][quantity]"
                                                       value="{{ $item->quantity }}" min="1"
                                                       class="form-control form-control-sm" style="max-width: 80px;">
                                            </td>
                                            <td>{{ number_format($item->unit_price * $item->quantity) }} تومان</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-wave">
                            ذخیره تغییرات
                        </button>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-wave ms-2">لغو</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
