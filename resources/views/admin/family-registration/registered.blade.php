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
                    <th scope="col"></th>
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
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

