@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ویرایش اعلان</h1>
                    <div class="">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a
                                            href="{{ route('admin.notifications.index') }}">اعلان‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش اعلان</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ route('admin.notifications.update', $notification->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">کاربر</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">انتخاب کاربر</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $notification->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ get_user_full_name($user->id) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">عنوان</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ old('title', $notification->title) }}">
                                    @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">پیام</label>
                                    <textarea name="message" id="message" rows="4"
                                              class="form-control">{{ old('message', $notification->message) }}</textarea>
                                    @error('message')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                                    بروزرسانی اعلان
                                </button>
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">بازگشت</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
