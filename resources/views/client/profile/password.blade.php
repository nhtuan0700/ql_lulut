@extends('client.profile.index')
@section('content_profile')
<div class="tab-pane fade show active">
  <div class="card-body">
    <form method="POST" action="{{ route('profile.password') }}"
      id="formPassword">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="password">Mật khẩu hiện tại:</label>
        <input type="password"
          class="form-control @error('password') is-invalid @enderror"
          id="password" name="password" rules="required|min:6">
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="new_password">Mật khẩu mới:</label>
        <input type="password"
          class="form-control @error('new_password') is-invalid @enderror"
          id="new_password" name="new_password" rules="required|min:6">
        @error('new_password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="new_password_confirmation">Nhập lại mật khẩu mới:</label>
        <input type="password" class="form-control"
          id="new_password_confirmation" name="new_password_confirmation"
          rules="required|min:6|confirm:new_password">
      </div>

      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
  </div>
</div>
@endsection
@push('js')
<script>
  $(function() {
      const validator = new Validator('#formPassword');
    })
</script>
@endpush