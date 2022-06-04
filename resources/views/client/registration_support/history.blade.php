@extends('client.master')
@section('title')
Lịch sử ủng hộ
@endsection
@section('content')
  @foreach ($registrationSupports as $item)
    <div>
      <h3 class="text-primary">{{ $item->created_date }}</h3>

      <p><b>Trạng thái: </b>{!! $item->statusHTML !!}</p>

      <b class="text-info">Nội dung ủng hộ</b>
      <p><b>Số tiền: </b>{{ formatCurrency($item->detailMoney->money) }}</p>
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
          @foreach ($item->detailGoods as $key => $item)
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
    <hr>
  @endforeach
@endsection