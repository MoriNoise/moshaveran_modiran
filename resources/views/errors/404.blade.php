@extends('layout.error')

@section('title', '۴۰۴ - صفحه یافت نشد')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۴۰۴</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">اوه، به نظر می‌رسد که این صفحه گم شده است!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        صفحه‌ای که تلاش می‌کنید به آن دسترسی پیدا کنید ممکن است حذف شده، جابجا شده یا وجود نداشته باشد.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
