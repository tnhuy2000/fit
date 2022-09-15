@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Thông tin liên hệ" />
	<meta property="og:description" content="Thông tin liên hệ với {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Thông tin liên hệ với {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', 'Thông tin liên hệ')

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><i class="fal fa-map-marked-alt"></i> Thông tin liên hệ</li>
				</ul>
			</div>
			<div class="page-title">
				<h1>Thông tin liên hệ</h1>
			</div>
		</div>
	</section>
	
	<section id="section-contact" class="p-t-30 p-b-30">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>Thông tin liên hệ với {{ config('app.name', 'LCMS') }}:</h4>
			</div>
			<div class="row col-no-margin equalize" data-equalize-item=".text-box">
				<div class="col-lg-4" style="background:#99e9f2;">
					<div class="text-box text-dark py-2">
						<i class="fal fa-building"></i>
						<h3>Văn phòng Khoa<br />Công nghệ thông tin</h3>
						<p>
							Dãy Văn phòng Khoa<br />
							18 Ung Văn Khiêm, TP. Long Xuyên, An Giang<br />
							Điện thoại: <a href="tel:+842966256565">+84 296 6256565 (số nội bộ 1091)</a>
						</p>
					</div>
				</div>
				<div class="col-lg-4" style="background:#c5f6fa;">
					<div class="text-box text-dark py-2">
						<i class="fal fa-building"></i>
						<h3>Bộ môn<br />Công nghệ thông tin</h3>
						<p>
							Phòng ND210<br />
							18 Ung Văn Khiêm, TP. Long Xuyên, An Giang<br />
							Điện thoại: <a href="tel:+842966256565">+84 296 6256565 (số nội bộ 1045)</a>
						</p>
					</div>
				</div>
				<div class="col-lg-4" style="background:#e3fafc;">
					<div class="text-box text-dark py-2">
						<i class="fal fa-building"></i>
						<h3>Bộ môn<br />Kỹ thuật phần mềm</h3>
						<p>
							Phòng ND206<br />
							18 Ung Văn Khiêm, TP. Long Xuyên, An Giang<br />
							Điện thoại: <a href="tel:+842966256565">+84 296 6256565 (số nội bộ 1091)</a>
						</p>
					</div>
				</div>
			</div>
			<div class="border mt-4">
				<div class="map" data-latitude="10.370575" data-longitude="105.431131" data-style="light" data-icon="{{ asset('public/frontend/images/map-pointer.png') }}" data-info="<div class='map-info'><address><strong>Văn phòng Khoa Công nghệ thông tin</strong><br />Địa chỉ: 18 Ung Văn Khiêm, TP. Long Xuyên, An Giang<br />Điện thoại: +84 296 6256565 (số nội bộ 1091)</address></div>" data-zoom="17"></div>
			</div>
		</div>
	</section>
@endsection

@section('javascript')
	<script src="https://maps.googleapis.com/maps/api/js?v=3&region=VI&language=vi&key=AIzaSyCh49zMBpsMBlE8ret6vehXGpm0KIuWw4k&signed_in=false&libraries=geometry,places&sensor=true"></script>
	<script src="{{ asset('public/frontend/plugins/gmap3/gmap3.min.js') }}"></script>
	<script src="{{ asset('public/frontend/plugins/gmap3/map-styles.js') }}"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_HOME') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_HOME') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection