@extends('admin.master')
@section('title')
  Quản lý đăng ký ủng hộ
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
              </div>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Người ủng hộ</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($registrations as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->supporter }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td>{!! $item->statusHTML !!}</td>
                      <td>
                        <a href="{{ route('admin.registration.detail', ['id' => $item->id]) }}" class="btn btn-info">
                          Xem
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $registrations->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $registrations->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

