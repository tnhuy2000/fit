@extends('layouts.admin')

@section('pagetitle')
	Hồ sơ nhân viên
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> Hồ sơ nhân viên</div>
		<div class="card-body admin-page">
			<div class="card-deck">
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.coban') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/coban.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Thông tin cơ bản</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.quatrinhcongtac') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/quatrinhcongtac.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Quá trình công tác</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.detaikhoahoc') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/detaikhoahoc.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Đề tài khoa học</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.baibaokhoahoc') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/baibaokhoahoc.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Bài báo khoa học</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/sachgiaotrinhtailieu.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Sách - GT - Tài liệu</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hosonhanvien.huongdansaudaihoc') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/huongdansaudaihoc.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Hướng dẫn SĐH</strong></p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection