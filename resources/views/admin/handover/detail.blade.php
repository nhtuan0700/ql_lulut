@extends('admin.master')
@section('title')
Bàn giao đợt ủng hộ
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
                <p>Trạng thái bàn giao: <span class="badge badge-info">{{  $period->status === 0 ? 'Chưa bàn giao' : 'Đã bàn giao' }}</span></p>
              </div>
              <b>Danh sách đã đăng ký</b>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Mã hộ khẩu</th>
                    <th scope="col">Tên chủ hộ</th>
                    <th scope="col">Số nhân khẩu</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Xã</th>
                    <th scope="col">Lý do</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($family_registrations as $item)
                    <tr>
                      <th>{{ $item->family->holdhouse_id }}</th>
                      <td>{{ $item->family->owner_name }}</td>
                      <td>{{ $item->family->person_qty }}</td>
                      <td>{{ $item->family->address }}</td>
                      <td>{{ $item->family->ward->name }}</td>
                      <td>
                        {{ $item->description }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              
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
                <div class="d-flex">
                  <a href="{{ route('admin.handover.print', ['periodId' => $period->id]) }}" 
                    target="_blank" class="btn btn-secondary mr-1">
                    In phiếu</a>
                  @if ($period->getRawOriginal('date_end') < now() && $period->status === 0)
                    <form action="{{ route('admin.handover.handover', ['periodId' => $period->id]) }}" method="post">
                      @csrf
                      <button class="btn btn-info">Bàn giao</button>
                    </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

