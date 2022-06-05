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
              <span class="card-title mr-3">Chi tiết</span>
            </div>
          </div>

          <div class="card-body">
            <div>
              <h3 class="text-primary">{{ $registration->created_at }}</h3>
              <h5>{{ $registration->period->id }} - {{ $registration->period->ward->name }} - {{ $registration->period->name }} - Kết thúc: {{ $registration->period->date_end }}</h5>

              <div class="my-2 d-flex align-items-center">
                <span class="text-bold">Trạng thái: </span>
                <span class="px-1">{!! $registration->statusHTML !!}</span>
              </div>
              <b class="text-info">Nội dung ủng hộ</b>
              <p><b>Số tiền: </b>{{ formatCurrency(optional($registration->detailMoney)->money) }}</p>
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
                  @foreach ($registration->detailGoods as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->goods->name }}</td>
                      <td>{{ $item->goods->unit }}</td>
                      <td class="text-center">{{ $item->qty }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @if (intval($registration->status) === App\Enum\RegistrationStatus::PROCESSING)
                <div class="d-flex">
                  <form
                    action="{{ route('admin.registration.confirm', ['id' => $registration->id]) }}" 
                    method="post"
                  >
                    @csrf
                    <button class="btn btn-success mr-2">Duyệt</button>
                  </form>
                  <form 
                    action="{{ route('admin.registration.cancel', ['id' => $registration->id]) }}" 
                    method="post"
                  >
                    @csrf
                    <button class="btn btn-danger">Hủy</button>
                  </form>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

