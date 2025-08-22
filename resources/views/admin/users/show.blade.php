@extends('admin.layouts.base')



@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">{{ $user->first_name . ' ' . $user->first_name }}</h1>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
                            <li class="breadcrumb-item active" aria-current="page">جزئیات کاربر</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <!-- User Info Card -->
            <div class="card custom-card mb-4">
                <div class="card-header">
                    <div class="card-title">اطلاعات کاربر</div>
                </div>

                <div class="d-flex align-items-center p-3 pt-0">
                    <div class="card-body flex-grow-1">
                        <dl class="row mb-0">
                            <dt class="col-sm-3 my-2 fw-semibold">نام کامل:</dt>
                            <dd class="col-sm-9 my-2">{{ $user->first_name . ' ' . $user->first_name }}</dd>

                            <dt class="col-sm-3 my-2 fw-semibold">ایمیل:</dt>
                            <dd class="col-sm-9 my-2">{{ $user->email }}</dd>

                            <dt class="col-sm-3 my-2 fw-semibold">شماره تلفن:</dt>
                            <dd class="col-sm-9 my-2">{{ $user->phone ?? '-' }}</dd>

                            <dt class="col-sm-3 my-2 fw-semibold">تاریخ ثبت‌نام:</dt>
                            <dd class="col-sm-9 my-2">{{ verta($user->created_at)->format('j F Y - H:i') }}</dd>
                        </dl>
                    </div>

                    <div class="me-2">
                        <img
                                src="{{ getUserAvatarUrl($user) }}"
                                alt="تصویر پروفایل"
                                class="rounded-circle border border-3"
                                style="width: 120px; height: 120px; object-fit: cover;"
                        >
                    </div>
                </div>
            </div>

            <!-- User Addresses Card -->
            <div class="card custom-card mb-4">
                <div class="card-header">
                    <div class="card-title">آدرس‌های کاربر</div>
                </div>
                <div class="card-body">
                    @if($user->addresses && $user->addresses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap align-middle">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>آدرس</th>
                                    <th>تلفن</th>
                                    <th>کد پستی</th>
                                    <th>آدرس پیش‌فرض</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->addresses as $address)
                                    <tr>
                                        <td>{{ $address->title ?? '-' }}</td>
                                        <td style="max-width: 300px; word-wrap: break-word;">{{ $address->address ?? '-' }}</td>
                                        <td>{{ $address->phone ?? '-' }}</td>
                                        <td>{{ $address->postal_code ?? '-' }}</td>
                                        <td>
                                            @if($address->is_default)
                                                <span class="badge bg-success">پیش‌فرض</span>
                                            @else
                                                <span class="badge bg-secondary">عادی</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="#{{--{{ route('admin.addresses.edit', $address->id) }}--}}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form
                                                        action="#{{--{{ route('admin.addresses.destroy', $address->id) }}--}}"
                                                        method="POST"
                                                        onsubmit="return confirm('آیا از حذف این آدرس مطمئن هستید؟')"
                                                        style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-pink-light btn-icon btn-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="حذف">
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
                    @else
                        <p class="text-center mb-0">آدرسی برای این کاربر ثبت نشده است.</p>
                    @endif
                </div>
            </div>


            <!-- Orders Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card mb-4">
                        <div class="card-header">
                            <div class="card-title">سفارشات کاربر</div>
                        </div>
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
                                @forelse($user->orders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="lh-1">
                                                <span class="avatar avatar-md bg-primary-transparent">
                                                    {{ strtoupper(substr(get_user_full_name($order->user_id), 0, 2)) }}
                                                </span>
                                                </div>
                                                <div>
                                                    <span
                                                            class="fw-semibold d-block">{{ get_user_full_name($order->user_id) }}</span>
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

            <!-- Purchased Products Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">محصولات خریداری شده</div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        <input class="form-check-input check-all" type="checkbox" id="all-products">
                                    </th>
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
                                @forelse($purchasedProducts as $product)
                                    <tr class="product-list">
                                        <td class="product-checkbox">
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{ $product->id ??"-"}}">
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if($product)
                                                    <span class="avatar avatar-md avatar-square bg-light">
                                                        <img
                                                                src="{{ getProductImageUrl($product) }}"
                                                                class="w-100 h-100" alt="{{ $product->name }}"
                                                        />
                                                    </span>
                                                @else
                                                    <span class="avatar avatar-md avatar-square bg-light">
                                                        <img
                                                                src="{{ asset('assets/admin/images/product-default-image.png') }}"
                                                                class="w-100 h-100" alt="Default Image"
                                                        />
                                                    </span>
                                                @endif

                                                <div class="ms-2 d-flex align-items-center">
                                                    <p class="fw-semibold mb-0 name-limit">
                                                        <a href="{{ route('admin.products.show', $product->id??"-") }}">{{ $product->name??'-' }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td>{{ number_format($product->price ?? 0) }} تومان</td>
                                        <td>
                                            @if($product->discount_price ?? 0)
                                                <span class="text-success">{{ number_format($product->discount_price) }} تومان</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->stock ?? "0" }}</td>
                                        <td>
                                        <span
                                                class="badge {{ ($product->is_active ??false) ? 'bg-primary-transparent' : 'bg-danger-transparent' }}">
                                            {{ ($product->is_active ??false)? 'منتشر شد' : 'پیش‌نویس' }}
                                        </span>
                                        </td>
                                        <td>
                                            @if($product && $product->created_at)
                                                {{ verta($product->created_at)->format('j F Y - H:i') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

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
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">هیچ محصولی یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
