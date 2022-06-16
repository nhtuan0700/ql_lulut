@extends('admin.master')
@section('title')
  Lịch sử được ủng hộ
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
                    <th scope="col">Tên đợt ủng hộ</th>
                    <th scope="col">Xã</th>
                    <th scope="col">Thời gian kết thúc</th>
                    <th scope="col">Trạng thái diễn ra</th>
                    <th scope="col">Trạng thái bàn giao</th>
                    <th scope="col" class="fit">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($periods as $item)
                    <tr>
                      <th>{{ $item->id }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->ward->name }}</td>
                      <td>{{ $item->date_end }}</td>
                      <td>{!! $item->statusHTML !!}</td>
                      <td>
                        <span class="badge badge-info">{{  $item->status === 0 ? 'Chưa bàn giao' : 'Đã bàn giao' }}</span>
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('admin.handover_history.detail', ['periodId' => $item->id]) }}" class="btn btn-info">
                            Xem
                          </a>
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
