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
              <span class="card-title mr-3">Danh sách</span>
              <a href="{{ route('admin.post.create') }}"
                class="btn btn-success">Tạo mới</a>
            </div>
          </div>
          <div class="card-body pb-0">
            {{-- Search --}}

          </div>

          <div class="card-body">
            <table id="example1"
              class="table table-bordered table-striped table-fix">
              <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
              </colgroup>
              <thead>
                <tr>
                  <th scope="col">Mã</th>
                  <th scope="col" style="width: 30%;">Tiêu đề</th>
                  <th scope="col">Thời gian</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td class="td-nowrap" title="{{$item->title}}">
                    {{ $item->title}}
                  </td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="{{ route('admin.post.edit', ['id' => $item->id]) }}"
                        class="btn btn-info mr-1">Sửa</a>
                      <form
                        action="{{ route('admin.post.delete', ['id' => $item->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-delete">Xóa</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex mt-4 justify-content-between">
              <div class="dataTables_info">Kết quả: {{ $posts->total() }}</div>
              <div class="dataTables_paginate paging_simple_numbers"
                id="example1_paginate">
                {{ $posts->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('script')
<script>
  $(function() {
      $('.btn-delete').click(function(e) {
      e.preventDefault();
      var message = 'Bạn có chắc muốn xóa bài viết này không';
      var isConfirm = confirm(message)
      if (isConfirm) {
        console.log($(this).closest('form'));
        $(this).closest('form').submit()
      }
    })
  })
</script>
@endsection