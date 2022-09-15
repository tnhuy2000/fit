@extends('layouts.admin')

@section('pagetitle')
	Quản lý hình ảnh
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> Quản lý hình ảnh</div>
		<div class="card-body admin-page">
			<div class="card-deck">
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hinhanh.them') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/themhinhanh.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Đăng hình ảnh</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="{{ route('admin.hinhanh.danhsach') }}">
							<img class="card-img-top" src="{{ asset('public/admin/images/icons/dshinhanh.png') }}" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Hình ảnh đã đăng</strong></p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection