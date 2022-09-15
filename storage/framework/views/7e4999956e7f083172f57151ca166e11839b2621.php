<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="AGChain Lab." />
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
	<?php echo $__env->yieldContent('meta'); ?>
	<title><?php echo $__env->yieldContent('title', 'Chuyên mục'); ?> - <?php echo e(config('app.name', 'LCMS')); ?></title>
	<link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/plugins.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/style.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('public/frontend/css/color-variations/blue.css')); ?>" media="screen" />
	<?php echo $__env->yieldContent('css'); ?>
</head>
<body class="boxed background-secondary">
	<div class="body-inner">
		<div id="topbar" class="d-none d-xl-block d-lg-block">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="topbar-dropdown">
							<div class="title"><i class="fal fa-calendar-alt"></i> <?php echo e($topbar_today); ?></div>
						</div>
						<div class="topbar-dropdown">
							<div class="title"><i class="fal fa-<?php echo e($topbar_weather_icon); ?>"></i> Long Xuyên <?php echo e($topbar_weather_temperature); ?>°C</div>
						</div>
						<div class="topbar-dropdown">
							<?php if(session()->has('enLanguage')): ?>
								<div class="title"><a href="<?php echo e(route('language.vi')); ?>"><i class="fal fa-globe-americas"></i> Tiếng Việt</a></div>
							<?php else: ?>
								<div class="title"><a href="<?php echo e(route('language.en')); ?>"><i class="fal fa-globe-asia"></i> English</a></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="social-icons social-icons-colored-hover">
							<ul>
								<li class="social-facebook"><a href="https://www.fb.com/fit.agu.edu.vn" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li class="social-rss"><a href="<?php echo e(route('rss')); ?>"><i class="fal fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<header id="header" class="header-disable-fixed">
			<div class="header-inner">
				<div class="container">
					<div id="logo">
						<a href="<?php echo e(route('home')); ?>">
							<span class="logo-default d-lg-none d-xl-block"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>" style="max-height:50px;" /></span>
							<span class="logo-default d-none d-lg-block d-xl-none"><img src="<?php echo e(asset('public/frontend/images/logo-only.png')); ?>" style="max-height:50px;" /></span>
							<span class="logo-dark"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>" style="max-height:50px;" /></span>
						</a>
					</div>
					<div id="search">
						<a id="btn-search-close" class="btn-search-close" aria-label="Đóng"><i class="icon-x"></i></a>
						<form class="search-form" action="https://www.google.com.vn/search" method="get">
							<input type="hidden" name="hl" id="hl" value="vi" />
							<input type="hidden" name="as_sitesearch" id="as_sitesearch" value="fit.agu.edu.vn" />
							<input class="form-control" name="as_q" id="as_q" type="search" placeholder="Bạn muốn tìm gì?" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
							<span class="text-muted">Nhấn "Enter" để tìm kiếm hoặc "ESC" để đóng cửa sổ.</span>
						</form>
					</div>
					<div class="header-extras">
						<ul>
							<li><a id="btn-search" href="#tim-kiem"><i class="icon-search"></i></a></li>
						</ul>
					</div>
					<div id="mainMenu-trigger"><a class="lines-button x"><span class="lines"></span></a></div>
					<div id="mainMenu">
						<div class="container">
							<nav>
								<ul>
									<li class="dropdown">
										<a href="#tong-quan"><i class="fal fa-compass"></i>Tổng quan</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/gioi-thieu-1.html')); ?>"><i class="fal fa-fw fa-globe-asia"></i>Giới thiệu</a></li>
											<li><a href="<?php echo e(route('sodotochuc')); ?>"><i class="fal fa-fw fa-sitemap"></i>Sơ đồ tổ chức</a></li>
											<li><a href="<?php echo e(route('nhansu')); ?>"><i class="fal fa-fw fa-users"></i>Nhân sự</a></li>
											<li><a href="<?php echo e(route('lienhe')); ?>"><i class="fal fa-fw fa-map-marked-alt"></i>Thông tin liên hệ</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#tong-quan"><i class="fal fa-building"></i>Đơn vị trực thuộc</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/ban-chu-nhiem-khoa-4.html')); ?>"><i class="fal fa-fw fa-cube"></i>Ban Chủ nhiệm Khoa</a></li>
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/van-phong-khoa-5.html')); ?>"><i class="fal fa-fw fa-cube"></i>Văn phòng Khoa</a></li>
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/bo-mon-cong-nghe-thong-tin-6.html')); ?>"><i class="fal fa-fw fa-cube"></i>Bộ môn Công nghệ thông tin</a></li>
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/bo-mon-ky-thuat-phan-mem-7.html')); ?>"><i class="fal fa-fw fa-cube"></i>Bộ môn Kỹ thuật phần mềm</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#tong-quan"><i class="fal fa-books"></i>Đào tạo</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/dai-hoc-cong-nghe-thong-tin-10.html')); ?>"><i class="fal fa-fw fa-book"></i>Đại học Công nghệ thông tin</a></li>
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/dai-hoc-ky-thuat-phan-mem-11.html')); ?>"><i class="fal fa-fw fa-book"></i>Đại học Kỹ thuật phần mềm</a></li>
											<li><a href="<?php echo e(url('/bai-viet/gioi-thieu/cao-dang-cong-nghe-thong-tin-12.html')); ?>"><i class="fal fa-fw fa-book"></i>Cao đẳng Công nghệ thông tin</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="<?php echo e(route('baiviet')); ?>"><i class="fal fa-bullhorn"></i>Thông báo</a>
										<ul class="dropdown-menu">
											<?php $__currentLoopData = $navbar_data_thongbao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a href="<?php echo e(route('baiviet.chude', ['chuDe' => $value->TenChuDeKhongDau])); ?>"><i class="fal fa-fw fa-bell-on"></i><?php echo e($value->TenChuDe); ?></a></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#tong-quan"><i class="fal fa-external-link"></i>Liên kết ngoài</a>
										<ul class="dropdown-menu">
											<?php $__currentLoopData = $navbar_data_lienketngoai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a href="<?php echo e($value->LienKet); ?>" target="_blank"><i class="fal fa-fw fa-link"></i><?php echo e($value->TenLienKet); ?></a></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<?php echo $__env->yieldContent('content'); ?>
		
		<section id="section-contact" class="background-grey p-t-40 p-b-0">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="icon-box effect small clean m-b-20">
							<div class="icon"><i class="fal fa-map-marker-alt"></i></div>
							<h3>Địa chỉ liên hệ</h3>
							<p>
								<strong>Văn phòng Khoa:</strong>
								<br />18 Ung Văn Khiêm, Phường Đông Xuyên
								<br />Thành phố Long Xuyên, Tỉnh An Giang
							</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="icon-box effect small clean m-b-20">
							<div class="icon"><i class="fal fa-phone"></i></div>
							<h3>Điện thoại liên hệ</h3>
							<p>
								<strong>Cố định:</strong>
								<br /><a href="tel:+842966256565">+84 296 6256565 (ext 1045)</a>
								<br /><a href="tel:+842966256565">+84 296 6256565 (ext 1091)</a>
							</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="icon-box effect small clean m-b-20">
							<div class="icon"><i class="fal fa-clock"></i></div>
							<h3>Giờ làm việc</h3>
							<p>
								<strong>Thứ Hai đến Thứ Sáu</strong>
								<br />Buổi sáng: Từ 07:00 đến 11:00
								<br />Buổi chiều: Từ 13:00 đến 17:00
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<footer id="footer">
			<div class="copyright-content">
				<div class="container">
					<div class="copyright-text text-center text-uppercase">&copy; <?php echo e(@date("Y")); ?> <?php echo e(config('app.name', 'LCMS')); ?>.</div>
				</div>
			</div>
		</footer>
	</div>
	
	<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
	<script src="<?php echo e(asset('public/frontend/js/jquery.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/plugins.js')); ?>"></script>
	<script src="<?php echo e(asset('public/frontend/js/functions.js')); ?>"></script>
	<?php echo $__env->yieldContent('javascript'); ?>
</body>
</html><?php /**PATH G:\wamp64\www\fit\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>