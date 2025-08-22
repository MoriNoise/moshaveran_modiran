@extends('admin.layouts.base')


@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">لیست اسلایدرها</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">اسلایدرها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست اسلایدرها</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form method="GET" action="{{ route('admin.sliders.index') }}">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary me-2">
                                        <i class="ri-add-line me-1 fw-medium align-middle"></i>اسلایدر جدید
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
                                    <input class="form-control me-2" type="search" name="search" placeholder="جستجو اسلایدر" value="{{ request('search') }}">
                                    <button class="btn btn-light" type="submit">جستجو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        <input class="form-check-input check-all" type="checkbox" id="all-sliders">
                                    </th>
                                    <th>تصویر</th>
                                    <th>عنوان</th>
                                    <th>توضیحات</th>
                                    <th>لینک</th>
                                    <th>وضعیت</th>
                                    <th>ترتیب</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($sliders as $slider)
                                    <tr class="slider-list">
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="{{ $slider->id }}">
                                        </td>
                                        <td>
                                        <span class="avatar avatar-md avatar-square bg-light">
                                            <img src="{{ $slider->files->first()?->filename ? asset('storage/'.$slider->files->first()->filename) : asset('assets/admin/images/ecommerce/jpg/placeholder.jpg') }}"
                                                 class="w-100 h-100" alt="{{ $slider->title ?? 'بدون عنوان' }}">
                                        </span>
                                        </td>
                                        <td>{{ $slider->title ?? 'بدون عنوان' }}</td>
                                        <td>{{ $slider->description ?? '-' }}</td>
                                        <td>
                                            @if($slider->link)
                                                <a href="{{ $slider->link }}" target="_blank">{{ $slider->link }}</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                        <span class="badge {{ $slider->is_active ? 'bg-primary-transparent' : 'bg-danger-transparent' }}">
                                            {{ $slider->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                        </td>
                                        <td>{{ $slider->sort_order ?? '-' }}</td>
                                        <td>{{ $slider->created_at ? verta($slider->created_at)->format('j F Y - H:i') : '-' }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                   class="btn btn-secondary-light btn-icon btn-sm" title="ویرایش">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('آیا از حذف این اسلایدر مطمئن هستید؟')">
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
                                        <td colspan="8" class="text-center">هیچ اسلایدری یافت نشد.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>


            <div>
                <!-- Pagination -->
                <ul class="pagination justify-content-end mt-3">
                    <li class="page-item {{ $sliders->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $sliders->previousPageUrl() ?? 'javascript:void(0);' }}">قبلی</a>
                    </li>
                    @foreach ($sliders->getUrlRange(1, $sliders->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $sliders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $sliders->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $sliders->nextPageUrl() ?? 'javascript:void(0);' }}">بعدی</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

@endsection
