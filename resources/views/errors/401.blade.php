@extends('layout.error')

@section('title', '۴۰۱ - دسترسی غیرمجاز')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۴۰۱</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">دسترسی به این صفحه غیرمجاز است!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        لطفا ابتدا وارد سیستم شوید یا مجوزهای لازم را دریافت کنید.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
