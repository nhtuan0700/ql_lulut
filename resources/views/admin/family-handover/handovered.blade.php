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
                <b class="text-info">Thống kê ủng hộ</b>
                <p><b>Số tiền: </b>{{ formatCurrency($total_money) }}</p>
          
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
                    @foreach ($registrationGoods as $key => $item)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->goods->name }}</td>
                        <td>{{ $item->goods->unit }}</td>
                        <td class="text-center">{{ $item->qty_total }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <b>Danh sách hộ gia đình đã đăng ký</b>
                @foreach ($familyHandovers as $family)
                @php
                  $money = $family->handovers->whereNotNull('money')->pluck('money')->first()
                @endphp
                <hr>
                <div class="mt-3">
                  <p><b>Mã hộ khẩu: </b> {{ $family->holdhouse_id }}</p>
                  <p><b>Tên chủ hộ: </b> {{ $family->owner_name }}</p>
                  <p><b>Địa chỉ: </b> {{ $family->address }}</p>
                  <div class="form-group">
                    <p for="money">Số tiền bàn giao: <span>{{ formatCurrency($money) }}</span></p>
                  </div>
                  <table class="table" id="tableModal">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tên hàng hóa</th>
                        <th>Đơn vị tính</th>
                        <th class="text-center w-25">Số lượng bàn giao</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if ($item->qty > 0)
                      @foreach ($family->handovers->whereNull('money') as $key => $itemHandover)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $itemHandover->goods->name }}</td>
                          <td>{{ $itemHandover->goods->unit }}</td>
                          <td class="text-center w-25">
                            {{ $itemHandover->qty }}
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
              @endforeach
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
