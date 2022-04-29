@extends('admin.master')
@section('title')
  Quản lý hàng cứu trợ
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
                <a href="{{ route('admin.goods.create') }}" class="btn btn-success">Tạo mới</a>
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
                    <th scope="col">Tên</th>
                    <th scope="col">Đơn vị tính</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($goodsList as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->unit }}</td>
                      <td>{{ $item->qty }}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('admin.goods.edit', ['id' => $item->id]) }}" class="btn btn-info mr-1">Sửa</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $goodsList->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $goodsList->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
