@extends('admin.layouts.base')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">افزودن اسلایدر جدید</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">اسلایدرها</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">افزودن اسلایدر</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-primary">
                        بازگشت به لیست
                    </a>
                </div>
            </div>
            <!-- Page Header Close -->

            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card p-3">
                        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-3 text-center">
                                <div id="image-preview"
                                     style="width: 100%; max-width: 800px; height: 250px; margin: 0 auto 10px; background-color: #f0f0f0; border: 2px dashed #ccc; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; cursor: pointer;">
                                    <img
                                            src=""
                                            alt="پیش‌نمایش تصویر"
                                            id="preview-img"
                                            style="width: 100%; height: 100%; object-fit: cover; display: none;"
                                    >
                                    <span id="preview-text" class="text-muted fs-6">تصویر انتخاب نشده</span>
                                </div>

                                <!-- input فایل هم‌عرض فرم -->
                                <div class="mt-2">
                                    <input type="file" name="image" id="image"
                                           class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- عنوان -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">عنوان</label>
                                <input type="text" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- توضیحات -->
                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">توضیحات</label>
                                <textarea name="description" id="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- لینک -->
                            <div class="mb-3">
                                <label for="link" class="form-label fw-semibold">لینک</label>
                                <input type="url" name="link" id="link"
                                       class="form-control @error('link') is-invalid @enderror"
                                       value="{{ old('link') }}">
                                @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- دکمه ذخیره -->
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i>ذخیره اسلایدر
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        const imageInput = document.getElementById('image');
        const previewDiv = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const previewText = document.getElementById('preview-text');

        // Remove dashed border if there is already an existing image
        if (previewImg.src && previewImg.src.trim() !== '') {
            previewDiv.style.border = 'none';
            previewText.style.display = 'none';
        } else {
            previewDiv.style.border = '2px dashed #ccc';
            previewText.style.display = 'block';
        }

        // Make preview div clickable
        previewDiv.addEventListener('click', function () {
            imageInput.click();
        });

        // Update preview when a new file is selected
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    previewText.style.display = 'none';
                    previewDiv.style.border = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
                previewText.style.display = 'block';
                previewDiv.style.border = '2px dashed #ccc';
            }
        });
    </script>

@endsection
