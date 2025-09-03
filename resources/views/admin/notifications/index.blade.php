@extends('admin.layouts.base')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست قالب پیام‌ها</h1>
                    <div class="">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">قالب پیام‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست</li>
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
                        <form method="GET" action="{{ route('admin.notifications.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>قالب جدید
                                    </a>
                                    <select id="choices-single-default" class="form-control" name="sort">
                                        <option value="">مرتب‌سازی بر اساس</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>نام (الف - ی)</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>نام (ی - الف)</option>
                                        <option value="Newest" {{ request('sort') == 'Newest' ? 'selected' : '' }}>جدیدترین</option>
                                        <option value="Oldest" {{ request('sort') == 'Oldest' ? 'selected' : '' }}>قدیمی‌ترین</option>
                                        <option value="category" {{ request('sort') == 'category' ? 'selected' : '' }}>دسته‌بندی</option>
                                    </select>
                                </div>

                                <div class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو قالب"
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
                    <div class="card custom-card ">
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>دسته‌بندی</th>
                                    <th>محتوا</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($templates as $template)
                                    <tr>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->category ?? '-' }}</td>
                                        <td>{{ Str::limit($template->content, 50) }}</td>
                                        <td>{{ verta($template->created_at)->format('j F Y - H:i') }}</td>
                                        <td>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.notifications.show', $template->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.notifications.edit', $template->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   onclick="if(confirm('آیا از حذف این قالب مطمئن هستید؟')) { document.getElementById('delete-form-{{ $template->id }}').submit(); }"
                                                   class="btn btn-pink-light btn-icon btn-sm" title="حذف">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $template->id }}"
                                                      action="{{ route('admin.notifications.destroy', $template->id) }}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">هیچ قالبی یافت نشد.</td>
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
                <li class="page-item {{ $templates->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                       href="{{ $templates->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($templates->getUrlRange(1, $templates->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $templates->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $templates->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $templates->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>

        </div>
    </div>

@endsection
