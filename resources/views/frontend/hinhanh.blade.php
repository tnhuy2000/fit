@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Hình ảnh hoạt động" />
	<meta property="og:description" content="Nhấn vào để xem hình ảnh hoạt động của {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Nhấn vào để xem hình ảnh hoạt động của {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title')
	@if(isset($session_title))
		{{ $session_title }}
	@else
		{{ $cms_chude->TenChuDe }}
	@endif
@endsection

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li><a href="{{ route('hinhanh') }}"><i class="fal fa-images"></i> Hình ảnh</a></li>
					<li class="active"><i class="fal fa-tag"></i> @if(isset($session_title)) {{ $session_title }} @else {{ $cms_chude->TenChuDe }} @endif</li>
				</ul>
			</div>
			<div class="page-title">
				<h1>@if(isset($session_title)) {{ $session_title }} @else {{ $cms_chude->TenChuDe }} @endif</h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="p-t-30 p-b-30">
		<div class="container">
			<div class="portfolio">
				<nav class="grid-filter gf-outline" data-layout="#portfolio">
					<ul>
						<li class="active"><a href="{{ route('hinhanh') }}" data-category="*">Xem tất cả</a></li>
						@foreach($cms_hinhanh_chude as $value)
							<li><a href="{{ route('hinhanh.chude', ['chuDe' => $value->TenChuDeKhongDau]) }}" data-category=".{{ $value->TenChuDeKhongDau }}">{{ $value->TenChuDe }}</a></li>
						@endforeach
					</ul>
					<div class="grid-active-title">Xem tất cả</div>
				</nav>
				<div id="portfolio" class="grid-layout portfolio-3-columns m-b-30" data-margin="20">
					@foreach($cms_hinhanh as $value)
						<div class="portfolio-item img-zoom shadow {{ $value->CMS_ChuDe->TenChuDeKhongDau }}">
							<div class="portfolio-item-wrap">
								<div class="portfolio-image">
									<a href="{{ route('hinhanh.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->MoTaKhongDau . '-' . $value->ID . '.html']) }}">
										<img src="{{ $cms_hinhanh_first_file[$value->ID] }}" />
									</a>
								</div>
								<div class="portfolio-description">
									<a title="{{ $value->MoTa }}" data-lightbox="image" href="{{ $cms_hinhanh_first_file[$value->ID] }}"><i class="fal fa-expand"></i></a>
									<a href="{{ route('hinhanh.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->MoTaKhongDau . '-' . $value->ID . '.html']) }}"><i class="fal fa-link"></i></a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div id="pagination" class="d-flex justify-content-center">
					{{ $cms_hinhanh->links() }}
				</div>
			</div>
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_PHOTO') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_PHOTO') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection