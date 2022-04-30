@extends('client.master')
@section('title')
Trang cá nhân
@endsection
@section('content')
<div class="row bg-white p-3">
  <div class="nav flex-column nav-pills col-sm-3" id="v-pills-tab"
    role="tablist" aria-orientation="vertical">
    <a class="nav-link" id="nav-info" href="{{ route('profile.info') }}">Thông tin cá nhân</a>
    <a class="nav-link" id="nav-password" href="{{ route('profile.password') }}">Đổi mật khẩu</a>
  </div>
  <div class="tab-content col-sm-9" id="v-pills-tabContent">
    @yield('content_profile')
  </div>
</div>
@endsection

@section('tag_head')

<link rel="stylesheet"
  href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/validator.js') }}"></script>
<script>
  $(function() {
		var url = url = new URL(window.location.href)
		path = url.pathname
		menu_name = path.split('/')[2] || 'info'
		itemMenuActive = '#nav-' + menu_name
		$(itemMenuActive).addClass('active')
	})
</script>
@endsection