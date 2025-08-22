@extends('layout.error')

@section('title', '۴۲۹ - درخواست‌های بیش از حد')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۴۲۹</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">شما درخواست‌های زیادی ارسال کرده‌اید!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        لطفا کمی صبر کنید و بعد دوباره تلاش کنید.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
