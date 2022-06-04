@extends('client.master')
@section('title')
Đăng ký ủng hộ
@endsection
@section('content')
  <form action="{{ route('registration') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="period_id">Đợt ủng hộ</label>
      <select class="custom-select" name="period_id" id="period_id">
        @foreach ($periods as $period)
          <option value="{{ $period->id }}">
            {{ $period->id }} - {{ $period->name }} - Kết thúc: {{ $period->date_end }}
          </option>
        @endforeach
      </select>
    </div>
    <div>
      <p class="font-weight-bold">Danh sách ủng hộ</p>
      
      <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#modal">
        Thêm
      </button>
      <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Danh sách hàng hóa hỗ trợ
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table" id="tableModal">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên hàng hóa</th>
                    <th>Đơn vị tính</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <table class="table" id="tableData">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên hàng hóa</th>
            <th scope="col">Đơn vị tính</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="form-group">
      <label for="money">Số tiền muốn ủng hộ</label>
      <input type="text" class="form-control" name="money" placeholder="100,000" data-type="currency">
    </div>
    <button class="btn btn-primary">Lưu</button>
  </form>
@endsection
@section('script')
  <script src="{{ asset('js/validator.js') }}"></script>
  
  <script src="{{ asset('js/currency.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('form');
      const goods = @json($goods);
      const goodsWillAdd = []
      loadDataModal(goods)
      handleAdd()

      function handleAdd() {
        $('.btn-add').click(function(e) {
          let row = $(this).closest('tr')
          const data = goods.find(item => item.id == row.data('id'))
          const index = goods.findIndex(item => item.id == row.data('id'))
          // 
          goods.splice(index, 1)
          loadDataModal(goods)
          handleAdd()
          // 
          goodsWillAdd.push(data)
          goodsWillAdd.sort((a, b) => a.id - b.id)
          loadData(goodsWillAdd)
          handleRemove()
          const validator = new Validator('form');
        })
      }

      function handleRemove() {
        $('.btn-remove').click(function(e) {
          let row = $(this).closest('tr')
          const data = goodsWillAdd.find(function(item) {
            return item.id == row.data('id')
          })
          const index = goodsWillAdd.findIndex(item => item.id == row.data('id'))
          // 
          goodsWillAdd.splice(index, 1)
          loadData(goodsWillAdd)
          handleRemove()
          // 
          goods.push(data)
          goods.sort((a, b) => a.id - b.id)
          loadDataModal(goods)
          handleAdd()
        })
      }

      function loadDataModal(goods) {
        const rowGoodsTableModal = goods.map((item, index) => rowTableModal(item, index + 1))
        $('#tableModal tbody').html(rowGoodsTableModal.join(''))
      }

      function loadData(goods) {
        const rowGoodsTable = goods.map((item, index) => rowTable(item, index + 1))
        $('#tableData tbody').html(rowGoodsTable.join(''))
      }

      function rowTable(data, index) {
        return `
          <tr data-id=${data.id}>
            <td>${index}</td>
            <td>${data.name}</td>
            <td>${data.unit}</td>
            <td class="w-25">
              <div class="form-group">
                <input class="form-control text-center" name="data[${data.id}]"
                  type="number" value="1" rules="required|integer|min:1" />  
              </div>
            </td>
            <td>
              <button
                class="btn btn-danger btn-remove" type="button"
              >
                Xóa
              </button>
            </td>
          </tr>
        `
      }
      
      function rowTableModal(data, index) {
        return `
          <tr data-id=${data.id}>
            <td>${index}</td>
            <td>${data.name}</td>
            <td>${data.unit}</td>
            <td>
              <button
                class="btn btn-info btn-add" type="button"
              >
                Thêm
              </button>
            </td>
          </tr>
        `
      }
    })

    
  </script>
@endsection