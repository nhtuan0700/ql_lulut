@extends('admin.master')
@section('title')
Đăng ký gia đình ủng hộ
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="p-1 bg-light">
                <p><b>{{ $period->id }}</b> - {{ $period->name }} - {{ $period->ward->name }}</p>
                <p>Trạng thái: <span>{!! $period->statusHTML !!}</span></p>
                <p>Bàn giao cho cán bộ phường: <span class="badge badge-info">{{  $period->status === 0 ? 'Chưa bàn giao' : 'Đã bàn giao' }}</span></p>
                <p>Bàn giao cho gia đình: <span class="badge badge-info">{{  $period->status != 2 ? 'Chưa bàn giao' : 'Đã bàn giao' }}</span></p>
              </div>
              {{--  --}}
              <div class="bg-white p-2">
                <p><b>Số tiền: </b>{{ formatCurrency($money) }}</p>
                <table class="table" id="tableModal">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên hàng hóa</th>
                      <th>Đơn vị tính</th>
                      <th class="text-center">Số lượng ủng hộ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($goodsDetail as $key => $item)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->goods->name }}</td>
                        <td>{{ $item->goods->unit }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
