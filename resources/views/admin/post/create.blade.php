@extends('admin.master')
@section('title')
  Quản lý bài viết
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex  align-items-center">
                <span class="card-title mr-2">Tạo mới</span>
              </div>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('admin.post.store') }}" id="form" enctype="multipart/form-data">
                @csrf
                {{-- Tiêu đề --}}
                <div class="form-group">
                  <label for="title">Tiêu đề:</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" rules="required">
                  @error('title')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                {{-- Slug --}}
                {{-- <div class="form-group">
                  <label for="slug">Slug: </label>
                  <input type="text" id="slug" name="slug" class="form-control bg-light" readonly/>
                </div> --}}
                  
                {{-- Nội dung --}}
                <div class="form-group">
                  <label for="content">Nội dung bài viết:</label>
                  <textarea type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" rules="required">{{ old('content') }}</textarea>
                  @error('content')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="images">Ảnh:</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input name="images[]" type="file" id="images" accept="image/*"
                        class="custom-file-input  @if($errors->has('images') || $errors->has('images.*')) is-invalid @endif" multiple rules="required">
                      <label class="custom-file-label" for="images">Chọn ảnh</label>
                    </div>
                  </div>
                  @error('images')
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @enderror
                  @error('images.*')
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @enderror
                  <div id="preview-image" class="preview-image preview-product d-flex flex-wrap">

                  </div>
                </div>

                <a class="btn btn-default mr-1" href="{{ route('admin.post.index') }}">Quay lại</a>
                <button type="submit" class="btn btn-primary">Tạo mới</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
  <script src="{{ asset('js/validator.js') }}"></script>
  <script src="{{ asset('js/preview-image.js') }}"></script>
  <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('js/slug.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('form');
      imagePreview('#images');
      bsCustomFileInput.init();
      changeSlug($('input#title'), $('input#slug'), "{{ old('title') }}");
    })
  </script>
@endsection