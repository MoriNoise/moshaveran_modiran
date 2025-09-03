@extends('admin.layouts.base')

@section('breadcrumbs')
    <div>
        <p class="fw-medium fs-18 mb-0">
            سلام، {{ auth('admin')->user()->first_name }} عزیز
        </p>
        <p class="fs-13 text-muted mb-0">
            به داشبورد مدیریت خوش آمدید.
        </p>
    </div>
@endsection

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Row 1: Stats Cards -->
            <div class="row">
                <!-- Total Users -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body d-flex gap-3">
                            <div class="avatar avatar-md bg-primary svg-white">
                                <i class="ri-user-line fs-24"></i>
                            </div>
                            <div>
                                <div class="fw-medium fs-13 mb-1 text-dark">تعداد کاربران</div>
                                <div class="fs-22 fw-semibold mb-1 text-primary">{{ number_format($totalUsers) }}</div>
                                <div class="fs-11 text-muted">همه زمان‌ها</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Admins -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body d-flex gap-3">
                            <div class="avatar avatar-md bg-secondary svg-white">
                                <i class="ri-shield-user-line fs-24"></i>
                            </div>
                            <div>
                                <div class="fw-medium fs-13 mb-1 text-dark">تعداد ادمین‌ها</div>
                                <div class="fs-22 fw-semibold mb-1 text-secondary">{{ number_format($totalAdmins) }}</div>
                                <div class="fs-11 text-muted">همه زمان‌ها</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Templates -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body d-flex gap-3">
                            <div class="avatar avatar-md bg-success svg-white">
                                <i class="ri-message-3-line fs-24"></i>
                            </div>
                            <div>
                                <div class="fw-medium fs-13 mb-1 text-dark">قالب‌های پیام</div>
                                <div class="fs-22 fw-semibold mb-1 text-success">{{ number_format($totalTemplates) }}</div>
                                <div class="fs-11 text-muted">همه زمان‌ها</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Groups -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body d-flex gap-3">
                            <div class="avatar avatar-md bg-pink svg-white">
                                <i class="ri-group-line fs-24"></i>
                            </div>
                            <div>
                                <div class="fw-medium fs-13 mb-1 text-dark">گروه‌های پیام</div>
                                <div class="fs-22 fw-semibold mb-1 text-pink">{{ number_format($totalGroups) }}</div>
                                <div class="fs-11 text-muted">همه زمان‌ها</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row 1 -->

            <!-- Row 2: Recent Users Table (Index Style) -->
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                کاربران اخیر
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">مشاهده همه</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th>شماره تماس</th>
                                    <th>جنسیت</th>
                                    <th>وضعیت</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($recentUsers as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-rounded p-1 bg-primary-transparent me-2">
                                                    <img src="{{ getUserAvatarUrl($user) }}" alt="آواتار کاربر">
                                                </span>
                                                <div class="flex-fill">
                                                    <a href="javascript:void(0);"
                                                       class="fw-medium fs-14 d-block text-truncate">
                                                        {{ get_user_full_name($user->id) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>
                                            @if($user->gender === 'male')
                                                مرد
                                            @elseif($user->gender === 'female')
                                                زن
                                            @else
                                                نامشخص
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user->is_active ? 'bg-success-transparent' : 'bg-danger-transparent' }}">
                                                {{ $user->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" title="ویرایش">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این کاربر مطمئن هستید؟')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm" data-bs-toggle="tooltip"
                                                   title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $user->id }}"
                                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">کاربری یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row 2 -->

            <!-- Row 3: Widgets / placeholders -->
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            فعالیت کاربران (آخرین 7 روز)
                        </div>
                        <div class="card-body">
                            <div id="chartUsers" style="height: 200px; background-color: #f5f5f5; display:flex; align-items:center; justify-content:center;">
                                نمودار کاربران
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            پیام‌های اخیر
                        </div>
                        <div class="card-body">
                            <div style="height:200px; overflow:auto; background-color:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                                لیست پیام‌ها
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row 3 -->

        </div>
    </div>
@endsection
