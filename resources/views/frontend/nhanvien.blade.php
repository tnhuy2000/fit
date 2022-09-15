@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Cán bộ giảng viên" />
	<meta property="og:description" content="Cán bộ giảng viên {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Cán bộ giảng viên {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', 'Cán bộ giảng viên')

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><i class="fal fa-users"></i> Cán bộ giảng viên</li>
				</ul>
			</div>
			<div class="page-title">
				<h1>Cán bộ giảng viên</h1>
			</div>
		</div>
	</section>
	
	<section id="section-staff" class="p-t-30 p-b-0">
		<div class="container">
			@foreach($hrm_donvi as $donvi)
				<div class="heading-text heading-section text-center heading-line">
					<h4>{{ $donvi->TenDonVi }}</h4>
				</div>
				<div class="row team-members team-members-left team-members-shadow m-b-20">
					@foreach($hrm_nhanvien_donvi as $value)
						@if($donvi->ID == $value->MaDonVi && $value->HRM_NhanVien->TrangThai == 1)
							<div class="col-lg-6">
								<div class="team-member">
									<div class="team-image">
										@if(!empty($value->HRM_NhanVien->HinhAnh))
											<img src="{{ $staffs_path . strstr($value->HRM_NhanVien->Email, '@', true) . '/' . $value->HRM_NhanVien->HinhAnh }}" height="210" />
										@else
											<img src="{{ $no_photo }}" height="210" />
										@endif
									</div>
									<div class="team-desc">
										<h3><a href="{{ route('nhansu.chitiet', ['hoVaTenSlug' => $value->HRM_NhanVien->HoVaTenKhongDau]) }}">{{ $value->HRM_NhanVien->HoVaTen }}</a></h3>
										<span>{{ $value->HRM_NhanVien->HocVi }}</span>
										<p>{{ $value->HRM_ChucVu->TenChucVu }}</p>
										<a href="{{ route('nhansu.chitiet', ['hoVaTenSlug' => $value->HRM_NhanVien->HoVaTenKhongDau]) }}" class="item-link">Xem chi tiết <i class="fal fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			@endforeach
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_STAFF') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_STAFF') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection