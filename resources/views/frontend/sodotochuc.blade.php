@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Sơ đồ tổ chức" />
	<meta property="og:description" content="Sơ đồ tổ chức của {{ config('app.name', 'LCMS') }}." />
	<meta name="description" content="Sơ đồ tổ chức của {{ config('app.name', 'LCMS') }}." />
@endsection

@section('title', 'Sơ đồ tổ chức')

@section('css')
	<link rel="stylesheet" href="{{ asset('public/frontend/css/chart.css') }}" />
@endsection

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><i class="fal fa-sitemap"></i> Sơ đồ tổ chức</li>
				</ul>
			</div>
			<div class="page-title">
				<h1>Sơ đồ tổ chức</h1>
			</div>
		</div>
	</section>
	
	<section id="page-content">
		<div class="container">
			<ol class="organizational-chart">
				<li>
					<div><h3><a href="{{ url('/bai-viet/gioi-thieu/ban-chu-nhiem-khoa-4.html') }}">Ban Chủ nhiệm Khoa</a></h3></div>
					<ol>
						<li>
							<div><h4><a href="{{ url('/bai-viet/gioi-thieu/van-phong-khoa-5.html') }}">Văn phòng Khoa</a></h4></div>
						</li>
						<li>
							<div><h4><a href="#bomon">Các Bộ môn</a></h4></div>
							<ol>
								<li><div><h5><a href="{{ url('/bai-viet/gioi-thieu/bo-mon-cong-nghe-thong-tin-6.html') }}">Bộ môn Công nghệ thông tin</a></h5></div></li>
								<li><div><h5><a href="{{ url('/bai-viet/gioi-thieu/bo-mon-ky-thuat-phan-mem-7.html') }}">Bộ môn Kỹ thuật phần mềm</a></h5></div></li>
							</ol>
						</li>
						<li>
							<div><h4><a href="#doanthe">Đoàn thể</a></h4></div>
							<ol>
								<li><div><h5><a href="{{ url('/bai-viet/gioi-thieu/cong-doan-8.html') }}">Công đoàn</a></h5></div></li>
								<li><div><h5><a href="{{ url('/bai-viet/gioi-thieu/doan-thanh-nien-9.html') }}">Đoàn thanh niên</a></h5></div></li>
								<li><div><h5><a href="{{ url('/bai-viet/gioi-thieu/cau-lac-bo-tin-hoc-14.html') }}">Câu lạc bộ Tin học</a></h5></div></li>
							</ol>
						</li>
						<li>
							<div><h4><a href="{{ url('/bai-viet/gioi-thieu/to-bao-tri-phong-may-16.html') }}">Tổ bảo trì phòng máy</a></h4></div>
						</li>
					</ol>
				</li>
			</ol>
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_HOME') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_HOME') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection