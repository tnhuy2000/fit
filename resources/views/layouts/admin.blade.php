<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="AGChain Lab." />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('pagetitle', 'Trang chủ') - {{ config('app.short_name', 'Laravel') }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/4.5.3/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendor/datatables/datatables-1.10.22/css/dataTables.bootstrap4.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/vendor/fontawesome/15.4.0/css/all.min.css') }}" />
	@yield('css')
	<link rel="stylesheet" href="{{ asset('public/admin/css/custom.css') }}" />
</head>

<body>
	<div id="app" class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light mb-2 shadow-sm" style="background:#ebc7df;">
			<a class="navbar-brand" href="{{ route('admin.home') }}">
				<img src="{{ asset('public/favicon.ico') }}" width="30" height="30" class="d-inline-block align-top" alt="" />
				{{ config('app.short_name', 'Laravel') }}
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Điều hướng">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				@guest
					<ul class="navbar-nav mr-auto">
						<li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ web</a></li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fal fa-sign-in-alt"></i> Đăng nhập</a></li>
						@if(Route::has('register'))
							<li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fal fa-user-plus"></i> Đăng ký</a></li>
						@endif
					</ul>
				@else
					<ul class="navbar-nav mr-auto">
						@if(Auth::user()->privilege == "superadmin")
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#hethong" id="navbarHeThong" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog"></i> Hệ thống</a>
								<div class="dropdown-menu" aria-labelledby="navbarHeThong">
									<a class="dropdown-item" href="{{ route('admin.baiviet.suanhanh') }}"><i class="fal fa-tasks fa-fw"></i> Cập nhật nhanh bài viết</a>
									<a class="dropdown-item" href="{{ route('admin.hinhanh.suanhanh') }}"><i class="fal fa-images fa-fw"></i> Cập nhật nhanh hình ảnh</a>
									<a class="dropdown-item" href="{{ route('admin.baiviet.vanban.suanhanh') }}"><i class="fal fa-file-edit fa-fw"></i> Cập nhật nhanh văn bản</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('app.version') }}"><i class="fal fa-code-branch fa-fw"></i> Xem phiên bản hệ thống</a>
									<a class="dropdown-item" href="{{ route('app.key') }}" onclick="return confirm('Bạn muốn tạo khóa mới (APP_KEY) cho hệ thống?');"><i class="fal fa-key fa-fw"></i> Tạo khóa mới cho hệ thống</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('app.clear.cache') }}" onclick="return confirm('Bạn muốn xóa cache hệ thống?');"><i class="fal fa-trash-alt fa-fw"></i> Xóa cache hệ thống</a>
									<a class="dropdown-item" href="{{ route('app.clear.config') }}" onclick="return confirm('Bạn muốn xóa cache cấu hình?');"><i class="fal fa-trash-alt fa-fw"></i> Xóa cache cấu hình</a>
									<a class="dropdown-item" href="{{ route('app.clear.route') }}" onclick="return confirm('Bạn muốn xóa cache cho các routes?');"><i class="fal fa-trash-alt fa-fw"></i> Xóa cache cho các routes</a>
									<a class="dropdown-item" href="{{ route('app.clear.view') }}" onclick="return confirm('Bạn muốn xóa cache cho các views?');"><i class="fal fa-trash-alt fa-fw"></i> Xóa cache cho các views</a>
									<div class="dropdown-divider"></div>
									@if(app()->isDownForMaintenance())
										<a class="dropdown-item text-primary" href="{{ route('app.up') }}" onclick="return confirm('Bạn muốn TẮT chế độ bảo trì trang web?');"><i class="fal fa-construction"></i> Tắt chế độ bảo trì hệ thống</a>
									@else
										<a class="dropdown-item text-danger" href="{{ route('app.down') }}" onclick="return confirm('Bạn muốn BẬT chế độ bảo trì trang web?');"><i class="fal fa-construction"></i> Bật chế độ bảo trì hệ thống</a>
									@endif
								</div>
							</li>
						@endif
						@if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qldanhmuc")
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#danhmuc" id="navbarDanhMuc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-list-alt"></i> Danh mục</a>
								<div class="dropdown-menu" aria-labelledby="navbarDanhMuc">
									<a class="dropdown-item" href="{{ route('admin.danhmuc.chude') }}"><i class="fal fa-tag fa-fw"></i> Chủ đề</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.loaibaiviet') }}"><i class="fal fa-ballot-check fa-fw"></i> Loại bài viết</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.mainslide') }}"><i class="fal fa-desktop-alt fa-fw"></i> Trình chiếu</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.slide') }}"><i class="fal fa-desktop fa-fw"></i> Trình chiếu cơ bản</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.bangdientu') }}"><i class="fal fa-newspaper fa-fw"></i> Bảng điện tử</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.lienketngoai') }}"><i class="fal fa-external-link fa-fw"></i> Liên kết ngoài</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.chucvu') }}"><i class="fal fa-user-tag fa-fw"></i> Chức vụ</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.donvi') }}"><i class="fal fa-home-lg fa-fw"></i> Đơn vị</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.nhanvien') }}"><i class="fal fa-user-friends fa-fw"></i> Nhân viên</a>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.nhanvien.donvi') }}"><i class="fal fa-users-class fa-fw"></i> Nhân viên - Đơn vị</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('admin.danhmuc.nguoidung') }}"><i class="fal fa-users-cog fa-fw"></i> Tài khoản người dùng</a>
								</div>
							</li>
						@endif
						@if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qlbaiviet")
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#baiviet" id="navbarBaiViet" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-file-word"></i> Bài viết</a>
								<div class="dropdown-menu" aria-labelledby="navbarBaiViet">
									<a class="dropdown-item" href="{{ route('admin.baiviet.them') }}"><i class="fal fa-file-plus fa-fw"></i> Đăng bài viết</a>
									<a class="dropdown-item" href="{{ route('admin.baiviet.danhsach') }}"><i class="fal fa-copy fa-fw"></i> Bài viết đã đăng</a>
								</div>
							</li>
						@endif
						@if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qlbaiviet")
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#hinhanh" id="navbarHinhAnh" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-photo-video"></i> Hình ảnh</a>
								<div class="dropdown-menu" aria-labelledby="navbarHinhAnh">
									<a class="dropdown-item" href="{{ route('admin.hinhanh.them') }}"><i class="fal fa-file-plus fa-fw"></i> Đăng hình ảnh</a>
									<a class="dropdown-item" href="{{ route('admin.hinhanh.danhsach') }}"><i class="fal fa-images fa-fw"></i> Hình ảnh đã đăng</a>
								</div>
							</li>
						@endif
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#hosonhanvien" id="navbarHoSoNhanVien" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-book-user"></i> Hồ sơ nhân viên</a>
							<div class="dropdown-menu" aria-labelledby="navbarHoSoNhanVien">
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.coban') }}"><i class="fal fa-id-card fa-fw"></i> Thông tin cơ bản</a>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.quatrinhcongtac') }}"><i class="fal fa-user-chart fa-fw"></i> Quá trình công tác</a>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.detaikhoahoc') }}"><i class="fal fa-file-code fa-fw"></i> Đề tài khoa học</a>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.baibaokhoahoc') }}"><i class="fal fa-newspaper fa-fw"></i> Bài báo khoa học</a>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu') }}"><i class="fal fa-books fa-fw"></i> Sách - GT - Tài liệu</a>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.huongdansaudaihoc') }}"><i class="fal fa-users-medical fa-fw"></i> Hướng dẫn sau đại học</a>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#taikhoan" id="navbarTaiKhoan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-user-circle"></i> {{ Auth::user()->name }}</a>
							<div class="dropdown-menu" aria-labelledby="navbarTaiKhoan">
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-power-off fa-fw"></i> Đăng xuất</a>
								<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">{{ csrf_field() }}</form>
								<a class="dropdown-item" href="{{ route('admin.hosonhanvien.doimatkhau') }}"><i class="fal fa-key fa-fw"></i> Đổi mật khẩu</a>
							</div>
						</li>
					</ul>
				@endguest
			</div>
		</nav>
		@yield('content')
		<hr class="shadow-sm" />
		<footer class="footer"><p>&copy; {{ @date("Y") }} {{ config('app.short_name', 'Laravel') }} (Ver 4.0.1020).</p></footer>
	</div>
	<script src="{{ asset('public/vendor/jquery/3.5.1/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/vendor/popper.js/1.16.1/popper.min.js') }}"></script>
	<script src="{{ asset('public/vendor/bootstrap/4.5.3/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/vendor/datatables/datatables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/vendor/datatables/datatables-1.10.22/js/dataTables.bootstrap4.min.js') }}"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ADMIN') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_ADMIN') }}', { cookie_flags: 'SameSite=None;Secure' });
	</script>
	<script>
		$(document).ready(function() {
			$("#DataList").DataTable({
				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
				"iDisplayLength": 25,
				"oLanguage": {
					"sLengthMenu": "Hiện _MENU_ dòng",
					"oPaginate": {
						"sFirst": "<i class='fal fa-step-backward'></i>",
						"sLast": "<i class='fal fa-step-forward'></i>",
						"sNext": "<i class='fal fa-chevron-right'></i>",
						"sPrevious": "<i class='fal fa-chevron-left'></i>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiện từ _START_ đến _END_ của _TOTAL_ dòng",
					"sInfoEmpty" : "Không tìm thấy",
					"sInfoFiltered": " (tổng số _MAX_ dòng)"
				}
			});
			
			$("#DataList").wrap('<div class="table-responsive"></div>');
			$("#DataList_wrapper").removeClass("container-fluid");
		});
	</script>
	@yield('javascript')
</body>

</html>