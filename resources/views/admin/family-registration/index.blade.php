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
              <form action="{{ route('admin.family_registration.register') }}" method="post">
                @csrf
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Mã hộ khẩu</th>
                      <th scope="col">Tên chủ hộ</th>
                      <th scope="col">Số nhân khẩu</th>
                      <th scope="col">Địa chỉ</th>
                      <th scope="col">Xã</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
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
                          <input type="checkbox" name="families[{{ $item->id }}][]"  value="{{ $item->id }}" />
                        </td>
                        <td>
                          <input type="text" class="form-control" id="families_desc[{{ $item->id }}]" name="families_desc[{{ $item->id }}]"
                            value="" rules="required">
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>   
                <button type="submit" class="btn btn-primary">Đăng ký</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

