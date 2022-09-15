@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Nghiên cứu khoa học" />
	<meta property="og:description" content="Cán bộ giảng viên {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Cán bộ giảng viên {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', 'Nghiên cứu khoa học')

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><i class="fal fa-atom-alt"></i> Nghiên cứu khoa học</li>
				</ul>
			</div>
			<div class="page-title">
				<h1>Nghiên cứu khoa học</h1>
			</div>
		</div>
	</section>
	
	<section id="section-research" class="p-t-30 p-b-0">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>Bài báo khoa học</h4>
			</div>
			<ul class="timeline-customize m-b-40">
				@foreach($hrm_baibaokhoahoc as $value)
					<li class="timeline-item">
						<div class="timeline-icon">{{ $loop->iteration }}</div>
						<h4>{{ $value->TenBaiBao }}</h4>
						<div class="timeline-item-date">{{ $value->NamXuatBan }} - {{ $value->LoaiBaiBao }}</div>
						<p>
							Tác giả: {{ $value->TacGiaNhomTacGia }}; Nơi đăng: {{ $value->NoiDang }}; Mã số: {{ $value->So }};
							@if(!empty($value->LienKet))
								Trang: {{ $value->TuTrangDenTrang }}; Liên kết: {{ $value->LienKet }}.
							@else
								Trang: {{ $value->TuTrangDenTrang }}.
							@endif
						</p>
					</li>
				@endforeach
			</ul>
			
			<div class="heading-text heading-section text-center heading-line">
				<h4>Đề tài khoa học</h4>
			</div>
			<ul class="timeline-customize m-b-40">
				@foreach($hrm_detaikhoahoc as $value)
					<li class="timeline-item">
						<div class="timeline-icon">{{ $loop->iteration }}</div>
						<h4>{{ $value->TenCongTrinh }}</h4>
						<div class="timeline-item-date">{{ $value->NamNghiemThu }} - {{ $value->CapQuanLy }}</div>
						<p>
							@php
								$thongTin = array();
								$thongTin[] = 'Chủ nhiệm: ' . $value->ChuNhiem;
								if(!empty($value->ThanhVienThamGia)) $thongTin[] = 'Thành viên: ' . $value->ThanhVienThamGia;
								if(!empty($value->LienKet)) $thongTin[] = 'Liên kết: ' . $value->LienKet;
								$thongTinDeTaiStr = implode('; ', $thongTin);
							@endphp
							{{ $thongTinDeTaiStr }}.
						</p>
					</li>
				@endforeach
			</ul>
			
			<div class="heading-text heading-section text-center heading-line">
				<h4>Sách - Giáo trình - Tài liệu</h4>
			</div>
			<ul class="timeline-customize m-b-40">
				@foreach($hrm_sachgiaotrinhtailieu as $value)
					<li class="timeline-item">
						<div class="timeline-icon">{{ $loop->iteration }}</div>
						<h4>{{ $value->Ten }}</h4>
						<div class="timeline-item-date">{{ $value->NamXuatBan }} - {{ $value->PhanLoai }}</div>
						<p>
							@php
								$thongTin = array();
								$thongTin[] = 'Tác giả: ' . $value->TacGiaNhomTacGia;
								if(!empty($value->NhaXuatBan)) $thongTin[] = 'Nhà xuất bản: ' . $value->NhaXuatBan;
								if(!empty($value->ISBN)) $thongTin[] = 'ISBN: ' . $value->ISBN;
								if(!empty($value->LienKet)) $thongTin[] = 'Liên kết: ' . $value->LienKet;
								$thongTinSanPhamStr = implode('; ', $thongTin);
							@endphp
							{{ $thongTinSanPhamStr }}.
						</p>
					</li>
				@endforeach
			</ul>
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_SCIENCE') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_SCIENCE') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection