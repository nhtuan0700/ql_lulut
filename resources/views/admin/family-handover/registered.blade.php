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
              <form action="{{ route('admin.family_handover.handover', ['periodId' => $period->id]) }}" method="post">
                @csrf
                @foreach ($family_registrations as $item)
                  <hr>
                  <div class="mt-3">
                    <p><b>Mã hộ khẩu: </b> {{ $item->family->holdhouse_id }}</p>
                    <p><b>Tên chủ hộ: </b> {{ $item->family->owner_name }}</p>
                    <p><b>Địa chỉ: </b> {{ $item->family->address }}</p>
                    <p><b>Lý do: </b> {{ $item->description }}</p>
                    <div class="form-group">
                      <label for="money">Số tiền muốn ủng hộ</label>
                      <input type="text" class="form-control" name="family[{{ $item->family_id }}][money]" data-type="currency">
                    </div>
                    <table class="table" id="tableModal">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên hàng hóa</th>
                          <th>Đơn vị tính</th>
                          <th class="text-center">Tổng số lượng ủng hộ</th>
                          <th class="text-center w-25">Số lượng bàn giao</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($registrationGoods as $key => $itemRegistration)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $itemRegistration->goods->name }}</td>
                          <td>{{ $itemRegistration->goods->unit }}</td>
                          <td class="text-center">{{ $itemRegistration->qty_total }}</td>
                          <td class="text-center w-25">
                            <input 
                              type="number" 
                              class="form-control"
                              data-id="{{ $itemRegistration->goods->id }}"
                              name="family[{{ $item->family_id }}][goods][{{ $itemRegistration->goods->id }}]"
                              value="0"
                            >
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                @endforeach
              <button class="btn btn-primary d-inline-block" id="btnSubmit">Cập nhật bàn giao</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
@section('script')
  <script src="{{ asset('js/validator.js') }}"></script>
  <script src="{{ asset('js/currency.js') }}"></script>
  <script>
    $(function() {
      const totalMoneySupport = @json($total_money);
      const goodsSupport = Object.values(@json($registrationGoods));
      $('#btnSubmit').click(function(e) {
        e.preventDefault()
        let totalMoney = 0;
        $(`input[name$="[money]"]`).each(function() {
          totalMoney += parseInt($(this).val().replaceAll(',', '') || 0)
        })
        if (totalMoney != totalMoneySupport) {
          alert('Số tiền nhập vào chưa hợp lệ!')
          return;
        }
        goodsHandover = {}
        $(`input[name*="[goods]"]`).each(function() {
          if (goodsHandover[$(this).data('id')] === undefined) {
            goodsHandover[$(this).data('id')] = parseInt($(this).val())
          } else {
            goodsHandover[$(this).data('id')] += parseInt($(this).val())
          }
        })
        var checkGoods = goodsSupport.every(function(item) {
          return item.qty_total == goodsHandover[item.goods_id]
        })
        if (!checkGoods) {
          alert('Số lượng bàn giao hàng hóa chưa khớp')
          return;
        }
        $('form').submit()
      })
    })
  </script>
@endsection
