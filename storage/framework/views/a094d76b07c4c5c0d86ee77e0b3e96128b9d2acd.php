

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="Hình ảnh hoạt động" />
	<meta property="og:description" content="Nhấn vào để xem hình ảnh hoạt động của <?php echo e(config('app.name', 'LCMS')); ?>." />
	<meta name="description" content="Nhấn vào để xem hình ảnh hoạt động của <?php echo e(config('app.name', 'LCMS')); ?>." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<?php if(isset($session_title)): ?>
		<?php echo e($session_title); ?>

	<?php else: ?>
		<?php echo e($cms_chude->TenChuDe); ?>

	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li><a href="<?php echo e(route('hinhanh')); ?>"><i class="fal fa-images"></i> Hình ảnh</a></li>
					<li class="active"><i class="fal fa-tag"></i> <?php if(isset($session_title)): ?> <?php echo e($session_title); ?> <?php else: ?> <?php echo e($cms_chude->TenChuDe); ?> <?php endif; ?></li>
				</ul>
			</div>
			<div class="page-title">
				<h1><?php if(isset($session_title)): ?> <?php echo e($session_title); ?> <?php else: ?> <?php echo e($cms_chude->TenChuDe); ?> <?php endif; ?></h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="p-t-30 p-b-30">
		<div class="container">
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
				<div id="portfolio" class="grid-layout portfolio-3-columns m-b-30" data-margin="20">
					<?php $__currentLoopData = $cms_hinhanh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="portfolio-item img-zoom shadow <?php echo e($value->CMS_ChuDe->TenChuDeKhongDau); ?>">
							<div class="portfolio-item-wrap">
								<div class="portfolio-image">
									<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->MoTaKhongDau . '-' . $value->ID . '.html'])); ?>">
										<img src="<?php echo e($cms_hinhanh_first_file[$value->ID]); ?>" />
									</a>
								</div>
								<div class="portfolio-description">
									<a title="<?php echo e($value->MoTa); ?>" data-lightbox="image" href="<?php echo e($cms_hinhanh_first_file[$value->ID]); ?>"><i class="fal fa-expand"></i></a>
									<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->MoTaKhongDau . '-' . $value->ID . '.html'])); ?>"><i class="fal fa-link"></i></a>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div id="pagination" class="d-flex justify-content-center">
					<?php echo e($cms_hinhanh->links()); ?>

				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_PHOTO')); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_PHOTO')); ?>', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/frontend/hinhanh.blade.php ENDPATH**/ ?>