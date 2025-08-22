@extends('layout.error')

@section('title', '۵۰۰ - خطای سرور داخلی')

@section('content')
    <p class="error-text mb-4 text-fixed-white">۵۰۰</p>
    <p class="fs-23 fw-medium mb-2 text-fixed-white">متأسفانه مشکلی در سرور به وجود آمده است!</p>
    <p class="fs-16 text-fixed-white mb-5 op-6">
        لطفا بعدا تلاش کنید یا با پشتیبانی تماس بگیرید.
    </p>
    <a href="{{ route('admin.index') }}" class="btn btn-warning">
        <i class="ri-arrow-left-line align-middle me-1 d-inline-block lh-1"></i>بازگشت به صفحه اصلی
    </a>
@endsection
