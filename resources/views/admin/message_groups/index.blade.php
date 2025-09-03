@extends('admin.layouts.base')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست گروه‌های پیام</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">پیام‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">گروه‌ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <!-- Search + Actions -->
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.message-groups.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.message-groups.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>گروه جدید
                                    </a>
                                    <select id="choices-single-default" class="form-control" name="sort">
                                        <option value="">مرتب‌سازی بر اساس</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>نام (الف - ی)</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>نام (ی - الف)</option>
                                        <option value="Newest" {{ request('sort') == 'Newest' ? 'selected' : '' }}>جدیدترین</option>
                                        <option value="Oldest" {{ request('sort') == 'Oldest' ? 'selected' : '' }}>قدیمی‌ترین</option>
                                    </select>
                                </div>

                                <div class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو گروه"
                                           value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>توضیحات</th>
                                    <th>تعداد کاربران</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ Str::limit($group->description, 50) ?? '-' }}</td>
                                        <td>{{ $group->users_count ?? $group->users()->count() }}</td>
                                        <td>{{ verta($group->created_at)->format('j F Y - H:i') }}</td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.message-groups.show', $group->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.message-groups.edit', $group->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این گروه مطمئن هستید؟')) { document.getElementById('delete-form-{{ $group->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm" title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $group->id }}"
                                                      action="{{ route('admin.message-groups.destroy', $group->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">هیچ گروهی یافت نشد.</td>
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
                <li class="page-item {{ $groups->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                       href="{{ $groups->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($groups->getUrlRange(1, $groups->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $groups->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $groups->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $groups->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>

        </div>
    </div>

@endsection
