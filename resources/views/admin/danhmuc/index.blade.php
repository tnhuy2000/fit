@extends('layouts.admin')

@section('pagetitle')
	Quản lý danh mục
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> Quản lý danh mục</div>
		<div class="card-body admin-page">
			<div class="card-deck">
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.chude') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/chude.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Chủ đề</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.loaibaiviet') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/loaibaiviet.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Loại bài viết</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.mainslide') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/trinhchieu.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Trình chiếu</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.slide') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/trinhchieumini.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Trình chiếu cơ bản</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.bangdientu') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/bangdientu.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Bảng điện tử</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.lienketngoai') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/lienketngoai.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Liên kết ngoài</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.chucvu') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/chucvu.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Chức vụ</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.donvi') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/donvi.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Đơn vị</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.nhanvien') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/nhanvien.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Nhân viên</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.nhanvien.donvi') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/nhanviendonvi.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Nhân viên - Đơn vị</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.danhmuc.nguoidung') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/nguoidung.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Người dùng</strong></p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection