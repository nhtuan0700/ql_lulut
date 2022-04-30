@extends('client.profile.index')
@section('content_profile')
<div class="tab-pane fade show active">
  <div class="card-body">
    <form method="POST"
      action="{{ route('profile.info') }}" id="formInfo">
      @csrf
      @method('put')
      {{-- Name --}}
      <div class="form-group">
        <label for="name">Họ Tên:</label>
        <input type="text"
          class="form-control @error('name') is-invalid @enderror" id="name"
          name="name"
          value="{{ old('name') ?? $user->info->name }}"
          rules="required">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="card_id">CMND:</label>
        <input type="text"
          class="form-control @error('card_id') is-invalid @enderror"
          id="card_id" name="card_id"
          value="{{ old('card_id') ?? $user->info->card_id }}"
          maxlength="9" rules="required">
        @error('card_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- Phone number --}}
      <div class="form-group">
        <label for="phone_number">Số điện thoại:</label>
        <input type="text"
          class="form-control @error('phone_number') is-invalid @enderror"
          id="phone_number" name="phone_number"
          value="{{ old('phone_number') ?? $user->info->phone_number }}"
          maxlength="10" rules="required|phone">
        @error('phone_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="dob">Ngày sinh:</label>
        <div class="input-group date" id="dob" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input"
            data-target="#dob" name="dob" autocomplete="off" rules="required" />
          <div class="input-group-append" data-target="#dob"
            data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
        @error('dob')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
          value="{{ old('address') ?? $user->info->address }}" rules="required">
        @error('address')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      {{-- Email --}}
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text"
          class="form-control @error('email') is-invalid @enderror" id="email"
          name="email" value="{{ $user->email }}" disabled>
      </div>
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script
  src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}">
</script>
<script src="{{ asset('js/vi.js') }}"></script>
<script>
  $(function() {
    const validator = new Validator('#formInfo');
    $('#dob').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      locale: 'vi',
      format: 'L'
    });
    var dob = `{{ old('dob') }}` || `{{ $user->info->dob }}`
    $("#dob input").val(dob);
  })
</script>
@endpush