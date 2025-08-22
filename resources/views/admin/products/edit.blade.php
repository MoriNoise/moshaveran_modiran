@extends('admin.layouts.base')



@section('content')

    <div class="main-content app-content">
        <div class="container-fluid pt-4">
            <!-- Page Header -->
            <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h1 class="page-title fw-medium fs-18 mb-2">ویرایش محصول</h1>
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">محصولات</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش محصول</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->
            @include('admin.layouts.alerts')

            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    ویرایش محصول
                                </div>
                            </div>

                            <div class="card-body">

                                <!-- Product Images -->
                                <div class="image-upload-wrapper d-flex flex-wrap gap-2 px-0 pt-0 mb-3" id="imagePreviewContainer"
                                     style=" border-radius: 8px; padding: 10px;">
                                    @if($product->files && count($product->files))
                                        @foreach($product->files as $img)
                                            <div class="position-relative" style="width:150px;height:150px;">
                                                <img src="{{ asset('storage/'.$img->filename) }}"
                                                     class="img-fluid rounded"
                                                     style="width:100%;height:100%;object-fit:cover;" alt="">
                                                <a href="{{ route('admin.products.images.delete', [$product->id, $img->id]) }}"
                                                   class="remove-btn btn btn-sm btn-danger position-absolute top-0 end-0 delete-image"
                                                   data-confirm="حذف این تصویر؟">×</a>
                                            </div>
                                        @endforeach
                                    @endif

                                    {{-- upload placeholder here --}}
                                    <label id="uploadPlaceholder" class="upload-placeholder" for="imageInput"
                                           style="cursor: pointer; width:150px; height:150px; display: flex; justify-content: center; align-items: center; border: 2px dashed #ccc; border-radius: 8px; padding: 20px; text-align: center;">
                                        <div>📷<br><strong>آپلود یا کشیدن</strong></div>
                                        <small style="color:#999;">JPG / PNG — حداقل 300×300</small>
                                    </label>
                                    <input id="imageInput" name="images[]" type="file" accept="image/*" multiple
                                           style="display:none"/>
                                </div>

                                <div class="row gy-3">
                                    <!-- Category -->
                                    <div class="col-xl-6">
                                        <label class="form-label">دسته‌بندی</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ ($product->category_id ?? old('category_id')) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Name -->
                                    <div class="col-xl-6">
                                        <label class="form-label">نام محصول</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام محصول را وارد کنید"
                                               value="{{ old('name', $product->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-xl-6">
                                        <label class="form-label">اسلاگ</label>
                                        <input type="text" class="form-control" name="slug"
                                               placeholder="اسلاگ محصول را وارد کنید"
                                               value="{{ old('slug', $product->slug) }}">
                                        @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div class="col-xl-6">
                                        <label class="form-label">قیمت</label>
                                        <input type="number" step="0.01" class="form-control" name="price"
                                               value="{{ old('price', $product->price) }}"
                                               placeholder="قیمت را وارد کنید">
                                        @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Discount Price -->
                                    <div class="col-xl-6">
                                        <label class="form-label">قیمت تخفیفی</label>
                                        <input type="number" step="0.01" class="form-control" name="discount_price"
                                               value="{{ old('discount_price', $product->discount_price) }}"
                                               placeholder="قیمت تخفیفی را وارد کنید">
                                        @error('discount_price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Stock -->
                                    <div class="col-xl-6">
                                        <label class="form-label">موجودی</label>
                                        <input type="number" class="form-control" name="stock"
                                               value="{{ old('stock', $product->stock) }}"
                                               placeholder="تعداد موجودی را وارد کنید">
                                        @error('stock')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-xl-6">
                                        <label class="form-label">وضعیت</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1" {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>
                                                فعال
                                            </option>
                                            <option value="0" {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>
                                                غیرفعال
                                            </option>
                                        </select>
                                        @error('is_active')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="col-xl-12">
                                        <label class="form-label">توضیحات</label>
                                        <textarea class="form-control" name="description" rows="4"
                                                  placeholder="توضیحات محصول را وارد کنید">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">به‌روزرسانی محصول</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                if (!confirm('حذف این تصویر؟')) return;

                const url = this.href;
                const imageDiv = this.closest('div.position-relative');

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            imageDiv.remove();
                            location.reload(); // reload to show flash message
                        } else {
                            location.reload(); // reload to show flash message
                        }
                    })
                    .catch(() => location.reload());
            });
        });

    </script>
@endsection
