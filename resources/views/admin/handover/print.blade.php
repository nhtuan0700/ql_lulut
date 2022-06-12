<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>In phiếu bàn giao</title>

  <style>
    body {
      font-family: "roboto";
      font-size: 12px;
      padding: 0;
    }

    .text-center {
      text-align: center !important;
    }

    .text-border {
      border-bottom: 1px solid black;
      padding-bottom: 3px;
      display: inline-block
    }

    .w-100 {
      width: 100% !important;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
      font-size: 11px;
    }

    .table td,
    .table th {
      text-align: left;
      border: 1px solid #dddddd;
      padding: 5px;
    }

    .table th {
      text-align: center;
    }

    .clear-both {
      clear: both
    }

    td.fit,
    th.fit {
      white-space: nowrap;
      width: 1%;
    }

  </style>
</head>

<body>
  <div style="float: left;text-align:center">
    <b>Thành phố đà nẵng</b><br>
    <b class="text-border">
      Huyện Hòa Vang</b>
    </p>
  </div>
  <div style="float: right;text-align:center">
    <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br>
    <b class="text-border">
      Độc lập - Tự do - Hạnh phúc</b></p>
  </div>
  <div class="clear-both"></div>
  <h3 class="text-center">PHIẾU BÀN GIAO</h3>
  <div>
    <table class="w-100">
      <tr>
        <td>
          <b>Mã đợt ủng hộ:</b> {{ $period->id }}
        </td>
      </tr>
      <tr>
        <td>
          <b>Người bàn giao:</b> {{ auth()->user()->info->name }}
        </td>
      </tr>
      <tr>
        <td>
          <b>Xã:</b> {{ $period->ward->name }}
        </td>
      </tr>
    </table>
  </div>
  <p><b>Danh sách bàn giao</b></p>
  <p><b>Số tiền: </b>{{ formatCurrency($total_money) }}</p>

  <table class="table" id="tableModal">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên hàng hóa</th>
        <th>Đơn vị tính</th>
        <th class="text-center">Số lượng ủng hộ</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($registrationGoods as $key => $item)
        <tr>
          <td>{{ $key }}</td>
          <td>{{ $item->goods->name }}</td>
          <td>{{ $item->goods->unit }}</td>
          <td class="text-center">{{ $item->qty_total }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top: 30px"></div>
  <table class="w-100">
    <tr>
      <td></td>
      <td></td>
      <td class="fit">
        <span>Đà nẵng ngày {{ now()->day }} tháng {{ now()->month }} năm {{ now()->year }}</span>
      </td>
    </tr>
    <tr>
      <td style="text-align: center">
        <b>Người tạo phiếu</b>
      </td>
      <td></td>
      <td style="text-align: center">
        <b>Người nhận</b>
      </td>
    </tr>
  </table>
</body>

</html>
