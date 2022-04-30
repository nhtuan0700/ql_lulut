@extends('client.master')
@section('title')
Trang chủ
@endsection
@section('content')
<div class="d-flex flex-column align-items-center w-75 mx-auto ">
  {{-- <h3 class="mb-3">Các bài viết</h3> --}}

  <div class="">
    @forelse ($posts as $post)
    <div class="post bg-white p-3 rounded my-3">
      <div class="user-block">
        <img class="img-circle img-bordered-sm"
          src="{{ asset('img/admin.png') }}" alt="user image">
        <span class="username">
          <a href="#">Quản trị.</a>
        </span>
        <span class="description">{{ $post->created_at }}</span>
      </div>
      <!-- /.user-block -->
      <h4>{{ $post->title }}</h4>
      <p>
        {{ $post->content }}
      </p>
      <div id="gallery-{{ $post->id }}"></div>
    </div>
    @empty
    Không có bài viết
    @endforelse
  </div>
</div>
@endsection
@section('tag_head')
<link rel="stylesheet" href="{{ asset('css/images-grid.css') }}">
@endsection
@section('script')
<script src="{{ asset('js/images-grid.js') }}"></script>
<script>
  $(function() {
    const posts = @json($posts);
    posts.forEach(item => {
      const images = item.images
      $(`#gallery-${item.id}`).imagesGrid({
          images: images.slice(0, images.length)
      });
    })
  })
</script>
@endsection