@extends('admin.layouts.base')

@section('breadcrumbs')
    <div>
        <p class="fw-medium fs-18 mb-0">
            سلام،
            {{auth('admin')->user()->first_name}}
            عزیز
        </p>
        <p class="fs-13 text-muted mb-0">
            به داشبورد مدیریت مشاوران مدیران خوش آمدید.
        </p>
    </div>
@endsection

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Start:: row-1 -->
            <div class="row">
                <div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="avatar avatar-md bg-primary svg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <path d="M33.6,145.5A96,96,0,0,1,96,37.5v72Z" opacity="0.2"></path>
                                                <path d="M33.6,145.5A96,96,0,0,1,96,37.5v72Z" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                                <path d="M128,128.42V32A96,96,0,1,1,45.22,176.64Z" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="flex-fill fw-medium fs-13 mb-1 text-dark">تعداد فروش</div>
                                            <div
                                                class="fs-22 fw-semibold mb-1 text-primary ">{{number_format($totalSalesCount)}}</div>
                                            <div class="d-flex align-items-center fs-11">
                                                <span class="text-default op-6">این ماه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="avatar avatar-md bg-secondary svg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <path
                                                    d="M128,144a191.14,191.14,0,0,1-96-25.68h0V200a8,8,0,0,0,8,8H216a8,8,0,0,0,8-8V118.31A191.08,191.08,0,0,1,128,144Z"
                                                    opacity="0.2"></path>
                                                <line x1="112" y1="112" x2="144" y2="112" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></line>
                                                <rect x="32" y="64" width="192" height="144" rx="8" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></rect>
                                                <path d="M168,64V48a16,16,0,0,0-16-16H104A16,16,0,0,0,88,48V64"
                                                      fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                                <path
                                                    d="M224,118.31A191.09,191.09,0,0,1,128,144a191.14,191.14,0,0,1-96-25.68"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex-fill fw-medium fs-13 mb-1 text-dark">مجموع قالب پیام</div>
                                            <div
                                                class="fs-22 fw-semibold mb-1 text-secondary">{{number_format($totalTemplates)}}
                                                تومان
                                            </div>
                                            <div class="d-flex align-items-center fs-11">
                                                <span class="text-default op-6">این ماه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body  ">
                                    <div class="d-flex gap-3">
                                        <div class="avatar avatar-md bg-success svg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <path d="M48,208H16a8,8,0,0,1-8-8V160a8,8,0,0,1,8-8H48Z"
                                                      opacity="0.2"></path>
                                                <path
                                                    d="M204,56a28,28,0,0,0-12,2.71h0A28,28,0,1,0,176,85.29h0A28,28,0,1,0,204,56Z"
                                                    opacity="0.2"></path>
                                                <circle cx="204" cy="84" r="28" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16"></circle>
                                                <path d="M48,208H16a8,8,0,0,1-8-8V160a8,8,0,0,1,8-8H48" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                                <path
                                                    d="M112,160h32l67-15.41a16.61,16.61,0,0,1,21,16h0a16.59,16.59,0,0,1-9.18,14.85L184,192l-64,16H48V152l25-25a24,24,0,0,1,17-7H140a20,20,0,0,1,20,20h0a20,20,0,0,1-20,20Z"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16"></path>
                                                <path d="M176,85.29A28,28,0,1,1,192,58.71" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex-fill fw-medium fs-13 mb-1 text-dark">کل درآمد</div>
                                            <div
                                                class="fs-22 fw-semibold mb-1 text-success">{{number_format($totalRevenue)}}
                                                تومان
                                            </div>
                                            <div class="d-flex align-items-center  fs-11">
                                                <span class="text-default op-6">این ماه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body ">
                                    <div class="d-flex gap-3">
                                        <div class="avatar avatar-md bg-pink svg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <circle cx="84" cy="108" r="52" opacity="0.2"></circle>
                                                <path d="M10.23,200a88,88,0,0,1,147.54,0" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                                <path d="M172,160a87.93,87.93,0,0,1,73.77,40" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                                <circle cx="84" cy="108" r="52" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="16"></circle>
                                                <path d="M152.69,59.7A52,52,0,1,1,172,160" fill="none"
                                                      stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="16"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex-fill fw-medium fs-13 mb-1 text-dark">مجموع مشتریان</div>
                                            <div
                                                class="fs-22 fw-semibold mb-1 text-pink">{{number_format($totalCustomers)}}</div>
                                            <div class="d-flex align-items-center fs-11">
                                                <span class="text-default op-6">این ماه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


{{--                        <div class="col-xl-12">--}}
{{--                            <div class="card custom-card overflow-hidden">--}}
{{--                                <div class="card-header justify-content-between">--}}
{{--                                    <div class="card-title">--}}
{{--                                        سفارشات اخیر--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <div class="table-responsive ">--}}
{{--                                        <table class="table text-nowrap table-hover">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th>مشتری</th>--}}
{{--                                                <th>محصولات</th> <!-- اگر محصولات دارید -->--}}
{{--                                                <th>تاریخ سفارش</th>--}}
{{--                                                <th>وضعیت</th>--}}
{{--                                                <th>مبلغ کل</th>--}}
{{--                                                <th>توضیحات</th> <!-- جایگزین روش پرداخت -->--}}
{{--                                                <th>اقدامات</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @forelse($orders as $order)--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="d-flex align-items-center gap-2">--}}
{{--                                                            <div class="lh-1">--}}
{{--                        <span class="avatar avatar-md bg-primary-transparent">--}}
{{--                            {{ strtoupper(substr(get_user_full_name($order->user_id), 0, 2)) }}--}}
{{--                        </span>--}}
{{--                                                            </div>--}}
{{--                                                            <div>--}}
{{--                                                                <span--}}
{{--                                                                    class="fw-semibold d-block">{{ get_user_full_name($order->user_id) }}</span>--}}
{{--                                                                <span--}}
{{--                                                                    class="text-muted fs-12">#{{ $order->tracking_code }}</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}

{{--                                                    <td>--}}
{{--                                                        @if($order->items && $order->items->count() > 0)--}}
{{--                                                            @php--}}
{{--                                                                $firstItem = $order->items->first();--}}
{{--                                                                $firstProduct = $firstItem->product ?? null;--}}

{{--                                                                $remainingCount = $order->items->count() - 1;--}}
{{--                                                            @endphp--}}

{{--                                                            <div class="d-flex align-items-center">--}}
{{--                                                                <div class="me-3">--}}
{{--                                                                    <img src="{{ getProductImageUrl($firstProduct) }}"--}}
{{--                                                                         alt="{{ $firstProduct->name ?? '' }}"--}}
{{--                                                                         class="rounded-circle"--}}
{{--                                                                         style="width: 38px; height: 38px; object-fit: cover;">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="flex-grow-1">--}}
{{--                                                                    <div--}}
{{--                                                                        class="fw-bold  ">    {{ Str::limit($firstProduct->name ?? 'محصول نامشخص', 15) }}</div>--}}
{{--                                                                    @if($remainingCount > 0)--}}
{{--                                                                        <small--}}
{{--                                                                            class="text-muted">و {{ $remainingCount }}--}}
{{--                                                                            محصول دیگر</small>--}}
{{--                                                                    @endif--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        @else--}}
{{--                                                            <span class="text-muted">ندارد</span>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}


{{--                                                    <td>--}}
{{--                                                        <span--}}
{{--                                                            class="fw-semibold d-block">{{ verta($order->created_at)->format('Y-m-d') }}</span>--}}
{{--                                                        <span--}}
{{--                                                            class="fs-12 text-muted">{{ verta($order->created_at)->format('H:i a') }}</span>--}}
{{--                                                    </td>--}}

{{--                                                    <td>--}}
{{--                                                        <span class="badge--}}
{{--                                                            @if($order->status == 'pending') bg-warning--}}
{{--                                                            @elseif($order->status == 'processing') bg-info--}}
{{--                                                            @elseif($order->status == 'shipped') bg-success--}}
{{--                                                            @elseif($order->status == 'cancelled') bg-danger--}}
{{--                                                            @else bg-secondary--}}
{{--                                                            @endif">--}}
{{--                                                            @if($order->status == 'pending')--}}
{{--                                                                در انتظار--}}
{{--                                                            @elseif($order->status == 'processing')--}}
{{--                                                                در حال پردازش--}}
{{--                                                            @elseif($order->status == 'shipped')--}}
{{--                                                                ارسال شده--}}
{{--                                                            @elseif($order->status == 'cancelled')--}}
{{--                                                                لغو شده--}}
{{--                                                            @else--}}
{{--                                                                نامشخص--}}
{{--                                                            @endif--}}
{{--                                                        </span>--}}
{{--                                                    </td>--}}

{{--                                                    <td>{{ number_format($order->total_price) }} تومان</td>--}}

{{--                                                    <td>{{ $order->notes ?? 'ندارد' }}</td>--}}

{{--                                                    <td>--}}
{{--                                                        <div class="btn-list">--}}
{{--                                                            <a href="{{ route('admin.orders.show', $order->id) }}"--}}
{{--                                                               class="btn btn-primary-light btn-icon btn-sm"--}}
{{--                                                               title="مشاهده"><i class="ri-eye-line"></i></a>--}}
{{--                                                            <a href="{{ route('admin.orders.edit', $order->id) }}"--}}
{{--                                                               class="btn btn-secondary-light btn-icon btn-sm"--}}
{{--                                                               title="ویرایش"><i class="ti ti-pencil"></i></a>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @empty--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="7" class="text-center">هیچ سفارشی یافت نشد.</td>--}}
{{--                                                </tr>--}}
{{--                                            @endforelse--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- End:: row-1 -->

        </div>
    </div>
@endsection
