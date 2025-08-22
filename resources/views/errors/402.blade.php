@extends('layout.error')

@section('title', '۴۰۲ - پرداخت مورد نیاز')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۴۰۲</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">پرداخت برای دسترسی به این صفحه مورد نیاز است!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        لطفا پرداخت لازم را انجام دهید تا به این صفحه دسترسی پیدا کنید.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
