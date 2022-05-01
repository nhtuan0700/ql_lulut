@extends('admin.master')
@section('title')
Quản lý hộ gia đình
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
            <div class="card-body pb-0">
              {{-- Search --}}
              
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã hộ khẩu</th>
                    <th scope="col">Tên chủ hộ</th>
                    <th scope="col">Số nhân khẩu</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Xã</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($families as $item)
                    <tr>
                      <th>{{ $item->holdhouse_id }}</th>
                      <td>{{ $item->owner_name }}</td>
                      <td>{{ $item->person_qty }}</td>
                      <td>{{ $item->address }}</td>
                      <td>{{ $item->ward->name }}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('admin.family.edit', ['id' => $item->id]) }}" class="btn btn-info mr-1">Sửa</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $families->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $families->links() }}
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

    })
  </script>
@endsection
