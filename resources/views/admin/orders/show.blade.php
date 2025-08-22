@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">جزئیات سفارش</h1>
                    <div class="">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">سفارشات</a></li>
                                <li class="breadcrumb-item active">سفارش #{{ $order->tracking_code }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')

            <!-- Main Row -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Summary -->
                            <div class="card custom-card overflow-hidden" style="padding-bottom: 6px !important;">
                                <div class="card-header justify-content-between">
                                    <div class="card-title">خلاصه سفارش</div>
                                    <div>کد: <span class="text-primary fw-semibold">#{{ $order->id }}</span></div>
                                </div>
                                <div class="card-body p-0 table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">تعداد کالا:</div>
                                            </td>
                                            <td>{{ $order->item_count }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">هزینه ارسال:</div>
                                            </td>
                                            <td> {{ number_format($order->shipping_cost ?? 0) }} تومان</td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 0;">
                                                <div class="fw-semibold">مبلغ کل:</div>
                                            </td>
                                            <td style="border-bottom: 0;">
                                                <span class="fw-medium">
                                                    {{ number_format($order->total_price) }}
                                                    تومان
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Address Info -->
                        @if($order->address)
                            <div class="col-md-6">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">آدرس تحویل</div>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $order->address->address ?? '-' }}</p>
                                        <p><strong>گیرنده:</strong> {{ get_user_full_name($order->user->id) }}</p>
                                        <p><strong>شماره تماس:</strong> {{ $order->address->phone ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Order Card -->
                    <div class="card custom-card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">
                                شماره سفارش - <span class="text-primary">#{{ $order->tracking_code }}</span>
                            </div>
                            <div>
                            <span class="badge bg-primary-transparent">
                                تاریخ سفارش: {{ verta($order->created_at)->format('j F Y') }}
                            </span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th scope="col">مورد</th>
                                        <th scope="col">کد پیگیری</th>
                                        <th scope="col">قیمت</th>
                                        <th scope="col">تعداد</th>
                                        <th scope="col">قیمت کل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <span class="avatar avatar-xl bg-primary-transparent">
                                                            <img src="{{ getProductImageUrl($item->product) }}" alt="Product Image">
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <div class="mb-1 fs-14 fw-medium">
                                                            <a href="javascript:void(0);">
                                                                {{ $item->product->name ?? 'بدون نام' }}
                                                            </a>
                                                        </div>
                                                        @if($item->variant)
                                                            <div class="mb-1">
                                                                <span class="me-1">اندازه:</span><span
                                                                    class="text-muted">{{ $item->variant->size ?? '-' }}</span>
                                                            </div>
                                                            <div class="mb-1">
                                                                <span class="me-1">رنگ:</span><span
                                                                    class="text-muted">{{ $item->variant->color ?? '-' }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-primary">{{ $order->tracking_code ?? '---' }}</td>
                                            <td>{{ number_format($item->unit_price) }} تومان</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price * $item->quantity) }} تومان</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-xl-4">

                    <!-- User Info -->
                    @if($order->user)
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">مشخصات کاربر</div>
                            </div>
                            <div class="card-body">
                                <p><strong>نام:</strong> {{ get_user_full_name($order->user->id) }}</p>
                                <p><strong>ایمیل:</strong> {{ $order->user->email }}</p>
                                <p><strong>موبایل:</strong> {{ $order->user->phone ?? '-' }}</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
