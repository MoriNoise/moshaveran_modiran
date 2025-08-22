@extends('admin.layouts.base')


@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست سفارشات</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">سفارشات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست سفارشات</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')


            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.orders.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
{{--                                    <a href="#" class="btn btn-primary me-2 disabled" style="pointer-events: none;">--}}
{{--                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>ایجاد سفارش--}}
{{--                                    </a>--}}
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
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو سفارش" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Orders Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover">
                                <thead>
                                <tr>
                                    <th>مشتری</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>توضیحات</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="lh-1">
                            <span class="avatar avatar-md bg-primary-transparent">
                                {{ strtoupper(substr(get_user_full_name($order->user_id), 0, 2)) }}
                            </span>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold d-block">{{ get_user_full_name($order->user_id) }}</span>
                                                    <span class="text-muted fs-12">#{{ $order->tracking_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($order->total_price) }} تومان</td>
                                        <td>
                    <span class="badge
                        @if($order->status == 'pending') bg-warning
                        @elseif($order->status == 'processing') bg-info
                        @elseif($order->status == 'shipped') bg-success
                        @elseif($order->status == 'cancelled') bg-danger
                        @else bg-secondary
                        @endif
                    ">
                        @if($order->status == 'pending')
                            در انتظار
                        @elseif($order->status == 'processing')
                            در حال پردازش
                        @elseif($order->status == 'shipped')
                            ارسال شده
                        @elseif($order->status == 'cancelled')
                            لغو شده
                        @else
                            نامشخص
                        @endif
                    </span>
                                        </td>
                                        <td>{{ verta($order->created_at)->format('j F Y') }}</td>
                                        <td>{{ $order->notes ?? 'ندارد' }}</td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این سفارش مطمئن هستید؟')) { document.getElementById('delete-form-{{ $order->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $order->id }}"
                                                      action="{{ route('admin.orders.destroy', $order->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">هیچ سفارشی یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $orders->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $orders->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>


        </div>
    </div>

@endsection
