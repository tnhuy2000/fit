

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Trang chủ" />
	<meta property="og:description" content="Trang chủ <?php echo e(config('app.name', 'LCMS')); ?>." />
	<meta name="description" content="Trang chủ <?php echo e(config('app.name', 'LCMS')); ?>." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Trang chủ'); ?>

<?php $__env->startSection('content'); ?>
	<section id="section-home" class="p-t-0 p-b-0">
		<div class="container">
			<div class="d-none d-xl-block d-lg-block">
				<div id="slider" class="inspiro-slider slider-halfscreen dots-creative" data-height-xs="360" data-autoplay="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
					<?php $__currentLoopData = $cms_trinhchieu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="slide background-image" style="background-image:url('<?php echo e($slider_path . $value->HinhAnh); ?>');">
							<div class="container">
								<div class="slide-captions">
									<!--
										<h6>Xin chào bạn tới</h6>
										<h2 class="text-uppercase text-medium">KHOA CÔNG NGHỆ THÔNG TIN</h2>
										<p class="lead">Thân thiện - Chất lượng - Thực tiễn</p>
										<a class="btn" href="#">Tìm hiểu thêm</a>
									-->
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<div class="d-sm-block d-md-block d-lg-none d-xl-none">
				<div class="grid-articles carousel" data-items="1" data-margin="0" data-autoplay="true" data-autoplay="2000" data-loop="true" data-arrows="false" data-dots="false" data-auto-width="true">
					<?php $__currentLoopData = $cms_trinhchieu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<article class="post-entry">
							<a href="#" class="post-image"><img src="<?php echo e($slider_path . $value->HinhAnh); ?>" /></a>
							<div class="post-entry-overlay">
								<div class="post-entry-meta">
									<!--
										<div class="post-entry-meta-category">
											<span class="badge badge-danger">Chuyên mục</span>
										</div>
										<div class="post-entry-meta-title">
											<h2><a href="#">Tiêu đề</a></h2>
										</div>
										<span class="post-date"><i class="fal fa-calendar-alt"></i> Ngày đăng</span>
									-->
								</div>
							</div>
						</article>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="news-ticker-customize">
				<div class="news-ticker-customize-title">
					<h4>TIN MỚI NHẤT</h4>
				</div>
				<div class="carousel news-ticker-customize-content" data-margin="20" data-items="1" data-autoplay="true" data-autoplay="2000" data-loop="true" data-arrows="false" data-dots="false" data-auto-width="true">
					<?php if($cms_bangdientu->isEmpty()): ?>
						<?php $__currentLoopData = $cms_baiviet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><?php echo e(Str::limit($value->TieuDe, 120)); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<?php $__currentLoopData = $cms_bangdientu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e(empty($value->LienKet) ? '#tin-moi' : $value->LienKet); ?>"><?php echo e($value->NoiDung); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	
	<section id="section-companyinfo" class="p-t-30 p-b-30">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-6">
					<h4 class="m-b-5">Giới thiệu</h4>
					<h3 class="m-b-5">KHOA CÔNG NGHỆ THÔNG TIN</h3>
					<p class="text-justify">Khoa Công nghệ thông tin Trường Đại học An Giang được thành lập theo Quyết định số 1461/QĐ-ĐHAG của Hiệu trưởng Trường Đại học An Giang ngày 14/8/2017 với nhiệm vụ: Đào tạo nguồn nhân lực chất lượng cao thuộc lĩnh vực công nghệ thông tin, nghiên cứu khoa học và chuyển giao tiến bộ khoa học kỹ thuật nhằm giải quyết các vấn đề liên quan đến công nghệ thông tin của tỉnh An Giang và khu vực Đồng bằng sông Cửu Long.</p>
					<a href="<?php echo e(url('/bai-viet/gioi-thieu/gioi-thieu-1.html')); ?>" class="btn btn-primary"><span class="btn-label"><i class="fal fa-info-circle"></i></span> Tìm hiểu thêm</a>
				</div>
				<div class="col-md-12 col-lg-6 p-t-10">
					<iframe src="https://player.vimeo.com/video/473729711?title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			</div>
			<div class="row m-t-40">
				<div class="col-lg-6 text-md-left text-lg-right">
					<h3>TẦM NHÌN</h3>
					<p class="text-md-justify">Đến năm 2025, Khoa Công nghệ thông tin sẽ trở thành trung tâm đào tạo trình độ đại học và sau đại học chất lượng cao về lĩnh vực công nghệ thông tin; là một trong những Khoa mạnh về nghiên cứu khoa học và chuyển giao công nghệ ở khu vực Đồng bằng sông Cửu Long.</p>
				</div>
				<div class="col-lg-6 text-md-left text-lg-left">
					<h3>SỨ MỆNH</h3>
					<p class="text-md-justify">Khoa Công nghệ thông tin có sứ mệnh đào tạo nguồn nhân lực công nghệ thông tin đạt chuẩn Quốc gia, có uy tín và đóng góp hiệu quả vào sự phát triển kinh tế - xã hội của địa phương và của đất nước trong quá trình công nghiệp hóa, hiện đại hóa và hội nhập quốc tế.</p>
				</div>
			</div>
		</div>
	</section>
	
	<section id="section-page" class="p-t-50 p-b-0 background-grey">
		<div class="triangle-divider-top"></div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="<?php echo e(route('sodotochuc')); ?>"><i class="fal fa-sitemap"></i></a>
						</div>
						<h3>Sơ đồ tổ chức</h3>
						<p>Cơ cấu tổ chức của Khoa Công nghệ thông tin.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="<?php echo e(route('nghiencuukhoahoc')); ?>"><i class="fal fa-atom-alt"></i></a>
						</div>
						<h3>Nghiên cứu khoa học</h3>
						<p>Các sản phẩm khoa học của giảng viên và sinh viên.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/hoat-dong-doi-ngoai')); ?>"><i class="fal fa-handshake"></i></a>
						</div>
						<h3>Hoạt động đối ngoại</h3>
						<p>Thông tin hoạt động đối ngoại của Khoa Công nghệ thông tin.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/van-ban-bieu-mau')); ?>"><i class="fal fa-folder-tree"></i></a>
						</div>
						<h3>Văn bản - Biểu mẫu</h3>
						<p>Các văn bản và biểu mẫu dành cho giảng viên và sinh viên.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="https://fit.agu.edu.vn/thuctap" target="_blank"><i class="fal fa-file-chart-pie"></i></a>
						</div>
						<h3>Thực tập cuối khóa</h3>
						<p>Chuyên trang về Khóa luận tốt nghiệp và Thực tập cuối khóa.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="https://fit.agu.edu.vn/apps/lichphongmay" target="_blank"><i class="fal fa-calendar-alt"></i></a>
						</div>
						<h3>Lịch phòng máy</h3>
						<p>Chuyên trang về quản lý lịch thực hành phòng máy.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="https://fit.agu.edu.vn/apps/cuusinhvien" target="_blank"><i class="fal fa-user-graduate"></i></a>
						</div>
						<h3>Cựu sinh viên</h3>
						<p>Trang thông tin Cựu sinh viên Khoa Công nghệ thông tin.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
					<div class="icon-box effect medium color border center">
						<div class="icon">
							<a href="https://fit.agu.edu.vn/apps/clbtinhoc" target="_blank"><i class="fal fa-computer-speaker"></i></a>
						</div>
						<h3>Câu lạc bộ Tin học</h3>
						<p>Trang thông tin hoạt động Câu lạc bộ Tin học.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="triangle-divider-bottom"></div>
	</section>
	
	<section id="section-department" class="p-t-30 p-b-0">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>ĐƠN VỊ TRỰC THUỘC</h4>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="icon-box effect square medium color">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/gioi-thieu/ban-chu-nhiem-khoa-4.html')); ?>"><i class="fal fa-building"></i></a>
						</div>
						<h3>Ban Chủ nhiệm Khoa</h3>
						<p>Trực tiếp quản lý và điều hành các hoạt động của Khoa theo qui định của nhà trường.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="icon-box effect square medium color">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/gioi-thieu/van-phong-khoa-5.html')); ?>"><i class="fal fa-building"></i></a>
						</div>
						<h3>Văn phòng Khoa</h3>
						<p>Đầu mối liên hệ giữa các đơn vị, lên kế hoạch và tổ chức triển khai thực hiện công tác đào tạo.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="icon-box effect square medium color">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/gioi-thieu/bo-mon-cong-nghe-thong-tin-6.html')); ?>"><i class="fal fa-building"></i></a>
						</div>
						<h3>Bộ môn Công nghệ thông tin</h3>
						<p>Quản lý chương trình đào tạo và giảng dạy sinh viên chuyên ngành Công nghệ thông tin...</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="icon-box effect square medium color">
						<div class="icon">
							<a href="<?php echo e(url('/bai-viet/gioi-thieu/bo-mon-ky-thuat-phan-mem-7.html')); ?>"><i class="fal fa-building"></i></a>
						</div>
						<h3>Bộ môn Kỹ thuật phần mềm</h3>
						<p>Quản lý chương trình đào tạo và giảng dạy sinh viên chuyên ngành Kỹ thuật phần mềm...</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="section-education" class="p-t-30 p-b-50 background-grey">
		<div class="triangle-divider-top"></div>
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>CHƯƠNG TRÌNH ĐÀO TẠO</h4>
			</div>
			<div class="row col-no-margin equalize" data-equalize-item=".text-box">
				<div class="col-lg-4" style="background:#99e9f2;">
					<div class="text-box hover-effect text-dark py-2">
						<a href="<?php echo e(url('/bai-viet/gioi-thieu/dai-hoc-cong-nghe-thong-tin-10.html')); ?>">
							<i class="fal fa-book"></i>
							<h3>Đại học<br />Công nghệ thông tin</h3>
							<p>Chi tiết chương trình đào tạo cử nhân Đại học Công nghệ thông tin.</p>
						</a>
					</div>
				</div>
				<div class="col-lg-4" style="background:#c5f6fa;">
					<div class="text-box hover-effect text-dark py-2">
						<a href="<?php echo e(url('/bai-viet/gioi-thieu/dai-hoc-ky-thuat-phan-mem-11.html')); ?>">
							<i class="fal fa-book"></i>
							<h3>Đại học<br />Kỹ thuật phần mềm</h3>
							<p>Chi tiết chương trình đào tạo cử nhân Đại học Kỹ thuật phần mềm.</p>
						</a>
					</div>
				</div>
				<div class="col-lg-4" style="background:#e3fafc;">
					<div class="text-box hover-effect text-dark py-2">
						<a href="<?php echo e(url('/bai-viet/gioi-thieu/cao-dang-cong-nghe-thong-tin-12.html')); ?>">
							<i class="fal fa-book"></i>
							<h3>Cao đẳng<br />Công nghệ thông tin</h3>
							<p>Chi tiết chương trình đào tạo cử nhân Cao đẳng Công nghệ thông tin.</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="triangle-divider-bottom"></div>
	</section>
	
	<section id="section-article" class="p-t-30 p-b-30">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>THÔNG BÁO</h4>
			</div>
			<div class="grid-articles-customize grid-articles-customize-space grid-articles-customize-v2">
				<?php $__currentLoopData = $cms_baiviet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<article class="post-entry">
						<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>" class="post-image"><img src="<?php echo e($cms_baiviet_first_file[$value->ID]); ?>" /></a>
						<div class="post-entry-overlay">
							<div class="post-entry-meta">
								<div class="post-entry-meta-category">
									<span class="badge badge-primary"><a href="<?php echo e(route('baiviet.chude', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau])); ?>"><?php echo e($value->CMS_ChuDe->TenChuDe); ?></a></span>
								</div>
								<div class="post-entry-meta-title">
									<h2><a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><?php echo e($value->TieuDe); ?></a></h2>
								</div>
								<span class="post-date"><i class="fal fa-calendar-alt"></i><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y')); ?></span>
								<span class="post-numviews"><i class="fal fa-eye"></i><?php echo e($value->LuotXem); ?> lượt xem</span>
							</div>
						</div>
					</article>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</section>
	
	<div class="seperator seperator-image seperator-over-top background-white" style="background-image:url(<?php echo e(asset('public/frontend/images/seperator-top.png')); ?>);"></div>
	<section id="section-portfolio" class="p-t-30 p-b-30" style="background-color:#e9e6df;">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>HÌNH ẢNH</h4>
			</div>
			<div class="portfolio">
				<nav class="grid-filter gf-outline" data-layout="#portfolio">
					<ul>
						<li class="active"><a href="<?php echo e(route('hinhanh')); ?>" data-category="*">Xem tất cả</a></li>
						<?php $__currentLoopData = $cms_hinhanh_chude; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a href="<?php echo e(route('hinhanh.chude', ['chuDe' => $value->TenChuDeKhongDau])); ?>" data-category=".<?php echo e($value->TenChuDeKhongDau); ?>"><?php echo e($value->TenChuDe); ?></a></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					<div class="grid-active-title">Xem tất cả</div>
				</nav>
				<div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="20">
					<?php $__currentLoopData = $hinhanhhoatdong; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="portfolio-item img-zoom <?php echo e($value['TenChuDeKhongDau']); ?>">
							<div class="portfolio-item-wrap">
								<div class="portfolio-image portfolio-image-index">
									<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $value['TenChuDeKhongDau'], 'titleWithID' => $value['MoTaKhongDau'] . '-' . $value['ID'] . '.html'])); ?>">
										<img src="<?php echo e($value['HinhDaiDien']); ?>" />
									</a>
								</div>
								<div class="portfolio-description">
									<a title="<?php echo e($value['MoTa']); ?>" data-lightbox="image" href="<?php echo e($value['HinhDaiDien']); ?>"><i class="fal fa-expand"></i></a>
									<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $value['TenChuDeKhongDau'], 'titleWithID' => $value['MoTaKhongDau'] . '-' . $value['ID'] . '.html'])); ?>"><i class="fal fa-link"></i></a>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</section>
	<div class="seperator seperator-image background-white" style="background-image:url(<?php echo e(asset('public/frontend/images/seperator-bottom.png')); ?>);"></div>
	
	<section id="section-client" class="p-t-30 p-b-30">
		<div class="container">
			<div class="heading-text heading-section text-center heading-line">
				<h4>HỢP TÁC VỚI DOANH NGHIỆP</h4>
			</div>
			<div class="carousel client-logos" data-items="4" data-items-sm="3" data-items-xs="2" data-items-xxs="2" data-margin="20" data-arrows="false" data-autoplay="true" data-autoplay="3000" data-loop="true">
				<div>
					<a href="#dek"><img src="<?php echo e(asset('public/frontend/images/companies/dek.png')); ?>"></a>
				</div>
				<div>
					<a href="#tma"><img src="<?php echo e(asset('public/frontend/images/companies/tma.png')); ?>"></a>
				</div>
				<div>
					<a href="#vbc"><img src="<?php echo e(asset('public/frontend/images/companies/vbc.png')); ?>"></a>
				</div>
				<div>
					<a href="#elca"><img src="<?php echo e(asset('public/frontend/images/companies/elca.png')); ?>"></a>
				</div>
				<div>
					<a href="#leopard"><img src="<?php echo e(asset('public/frontend/images/companies/leopard.png')); ?>"></a>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_HOME')); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_HOME')); ?>', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/frontend/index.blade.php ENDPATH**/ ?>