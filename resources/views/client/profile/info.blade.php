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
        <label for="type">Đại diện</label>
        <select class="form-control" name="type" id="type">
          <option value="1" @if(is_null(auth()->user()->info->company)) selected @endif>Đại diện cá nhân</option>
          <option value="2" @if(!is_null(auth()->user()->info->company)) selected @endif>Đại diện công ty/tổ chức</option>
        </select>
      </div>
      
      {{-- Cá nhân --}}
      <div class="" id="personal">
        <div class="form-group">
          <label for="address">Địa chỉ:</label>
          <input type="text"
            class="form-control @error('address') is-invalid @enderror"
            name="address" value="{{ old('address') ?? auth()->user()->info->address }}">
          @error('address')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      {{-- Tổ chức --}}
      <div class="" id="organize">
        <div class="mb-3 form-group">
          <label for="company_name">Tên công ty/tổ chức</label>
          <input type="text"
            class="form-control @error('company_name') is-invalid @enderror"
            name="company_name" value="{{ old('company_name') ?? optional(auth()->user()->info->company)->name }}" >
          @error('company_name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3 form-group">
          <label for="company_address">Địa chỉ công ty/tổ chức</label>
          <input type="text"
            class="form-control @error('company_address') is-invalid @enderror"
            name="company_address" value="{{ old('company_address') ?? optional(auth()->user()->info->company)->address }}" >
          @error('company_address')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
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
    $('#dob').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      locale: 'vi',
      format: 'L'
    });
    var dob = `{{ old('dob') }}` || `{{ $user->info->dob }}`
    $("#dob input").val(dob);

    if ($('#type').val() == 2) {
      $('#organize').removeClass('d-none')
      $('#personal').addClass('d-none')
      $('#organize').find('input').attr('rules', 'required')
    } else {
      $('#organize').addClass('d-none')
      $('#personal').removeClass('d-none')
      $('#personal').find('input').attr('rules', 'required')
    }
    new Validator('#formInfo');

    $('#type').change(function() {
      if ($(this).val() == 2) {
        $('#organize').removeClass('d-none')
        $('#personal').addClass('d-none')
        $('#personal').find('input').removeAttr('rules')
        $('#organize').find('input').attr('rules', 'required')
        new Validator('#formInfo');
      } else {
        $('#organize').addClass('d-none')
        $('#personal').removeClass('d-none')
        $('#organize').find('input').removeAttr('rules')
        $('#personal').find('input').attr('rules', 'required')
        new Validator('#formInfo');
      }
    })
  })
</script>
@endpush