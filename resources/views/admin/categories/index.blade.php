@extends('admin.layouts.base')


@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست دسته‌بندی‌ها</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">دسته‌بندی‌ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست دسته‌بندی‌ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')

            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.categories.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>ایجاد دسته‌بندی
                                    </a>
                                    <select id="choices-single-default" class="form-control" name="sort">
                                        <option value="">مرتب‌سازی بر اساس</option>
                                        <option
                                            value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            الفبا (الف - ی)
                                        </option>
                                        <option
                                            value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            الفبا (ی - الف)
                                        </option>
                                        <option
                                            value="Date Added" {{ request('sort') == 'Date Added' ? 'selected' : '' }}>
                                            تاریخ اضافه شدن
                                        </option>
                                        <option value="Newest" {{ request('sort') == 'Newest' ? 'selected' : '' }}>
                                            جدیدترین
                                        </option>
                                        <option value="Type" {{ request('sort') == 'Type' ? 'selected' : '' }}>نوع
                                        </option>
                                    </select>

                                </div>
                                <div class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو دسته‌بندی" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Categories Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th>دسته‌بندی</th>
                                    <th>توضیحات</th>
                                    <th>تعداد محصولات</th>
                                    <th scope="col">وضعیت</th>

                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                        <span class="avatar avatar-md avatar-square bg-light">
                                         <img
                                                 src="{{ getCategoryImageUrl($category) }}"
                                                 class="w-100 h-100"
                                                 alt="{{ $category->name }}">

                                        </span>
                                                <div class="ms-2">
                                                    <p class="fw-semibold mb-0 name-limit">
                                                        <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                                                    </p>
                                                    <p class="fs-12 text-muted mb-0 ">{{ $category->id }}#</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="description-limit">{{ $category->description ?? 'ندارد' }}</td>
                                        <td>{{ $category->products()->count() ?? 0 }}</td>
                                        <td>
                                        <span
                                                class="badge {{ $category->is_active === true ? 'bg-success-transparent' : 'bg-danger-transparent' }}">
                                            {{ $category->is_active === true ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                        </td>
                                        <td>{{ verta($category->created_at)->format('j F Y') }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                                   class="btn btn-primary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="مشاهده">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('آیا از حذف این دسته‌بندی مطمئن هستید؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger-light">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">هیچ دسته‌بندی‌ای یافت نشد.</td>
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
                <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $categories->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                </li>
                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $categories->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                </li>
            </ul>

        </div>
    </div>

@endsection
