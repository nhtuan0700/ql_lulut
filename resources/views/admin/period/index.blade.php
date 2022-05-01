@extends('admin.master')
@section('title')
  Quản lý đợt ủng hộ
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
                <a href="{{ route('admin.period.create') }}" class="btn btn-success">Tạo mới</a>
              </div>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên đợt ủng hộ</th>
                    <th scope="col">Thời gian bắt đầu</th>
                    <th scope="col">Thời gian kết thúc</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($periods as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->created_at }}</td>
                      <td>{{ $item->start_time }}</td>
                      <td>{{ $item->end_time }}</td>
                      <td>{!! $item->statusHTML !!}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('admin.period.edit', ['id' => $item->id]) }}" class="btn btn-info">
                            {{ $item->getStatus() === 0 ? 'Xem' : 'Sửa' }}
                          </a>
                          <div class="m-1"></div>
                          @can('delete', $item)
                            <form class="d-none" action="{{ route('admin.period.delete', ['id' => $item->id]) }}"
                              method="post">
                              @csrf
                              @method('delete')
                            </form>
                            <button type="button" class="btn btn-danger btn-delete" data-name="{{ $item->name }}">
                              Xóa</button>
                          @endcan
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex mt-4 justify-content-between">
                <div class="dataTables_info">Kết quả: {{ $periods->total() }}</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $periods->links() }}
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
        let name = $(this).data('name')
        var isConfirm = confirm(`Bạn có chắc muốn xóa ${name}`)
        if (isConfirm) {
          $(this).siblings('form').submit()
        }
      })
    })
  </script>
@endsection
