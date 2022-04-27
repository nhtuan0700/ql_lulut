@extends('admin.master')
@section('title')
  Quản lý người dùng
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
                <a href="{{ route('admin.user.create') }}" class="btn btn-success">Tạo mới</a>
              </div>
            </div>
            <div class="card-body pb-0">
              {{-- Search --}}
              
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->info->name }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->info->phone_number }}</td>
                      <td>{{ $item->role->name }}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="btn btn-info mr-1">Sửa</a>
                          <form action="{{ route('admin.user.handle', ['id' => $item->id]) }}" method="post">
                            @csrf
                            @if ($item->is_actived)
                              <button class="btn btn-danger btn-handle">Khóa</button>
                            @else
                              <button class="btn btn-warning btn-handle">Kích hoạt</button>
                            @endif
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $users->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $users->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('tag_head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $(function() {
      $('.select2').select2()

      $('.btn-handle').click(function(e) {
        e.preventDefault();
        var isBlock = !!Number($(this).siblings('[name="is_block"]').val());
        var message = isBlock ? 'Bạn có chắc muốn khóa tài khoản này?' :
          'Bạn có chắc muốn kích hoạt lại tài khoản này';
        var isConfirm = confirm(message)
        if (isConfirm) {
          console.log($(this).closest('form'));
          $(this).closest('form').submit()
        }
      })
    })
  </script>
@endsection
