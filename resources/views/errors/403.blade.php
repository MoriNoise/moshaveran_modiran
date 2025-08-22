@extends('layout.error')

@section('title', '۴۰۳ - دسترسی ممنوع')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۴۰۳</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">شما اجازه دسترسی به این صفحه را ندارید!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        ممکن است مجوزهای لازم برای مشاهده این صفحه را نداشته باشید.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
