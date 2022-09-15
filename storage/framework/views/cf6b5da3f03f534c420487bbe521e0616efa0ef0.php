

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="<?php echo e($cms_hinhanh->MoTa); ?>" />
	<meta property="og:description" content="Nhấn vào để xem hình ảnh hoạt động về <?php echo e($cms_hinhanh->MoTa); ?>." />
	<meta name="description" content="Nhấn vào để xem hình ảnh hoạt động về <?php echo e($cms_hinhanh->MoTa); ?>." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', $cms_hinhanh->MoTa); ?>

<?php $__env->startSection('content'); ?>
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li><a href="<?php echo e(route('hinhanh')); ?>"><i class="fal fa-images"></i> Hình ảnh</a></li>
					<li class="active"><a href="<?php echo e(route('hinhanh.chude', ['chuDe' => $cms_hinhanh->CMS_ChuDe->TenChuDeKhongDau])); ?>"><i class="fal fa-tag"></i> <?php echo e($cms_hinhanh->CMS_ChuDe->TenChuDe); ?></a></li>
				</ul>
			</div>
			<div class="page-title-small">
				<h1 class="text-justify"><?php echo e($cms_hinhanh->MoTa); ?></h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="p-t-10 p-b-0">
		<div class="container">
			<div id="blog" class="single-post">
				<div class="post-item">
					<div class="post-item-wrap">
						<div class="post-item-description">
							<div class="post-meta">
								<span class="post-meta-date"><i class="fal fa-calendar-alt"></i><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cms_hinhanh->created_at)->format('d/m/Y')); ?></span>
								<span class="post-meta-comments"><i class="fal fa-eye"></i><?php echo e($cms_hinhanh->LuotXem); ?> lượt xem</span>
							</div>
							<div class="portfolio-content" data-lightbox="gallery">
								<?php $__currentLoopData = $all_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a title="<?php echo e($cms_hinhanh->MoTa); ?>" data-lightbox="gallery-image" href="<?php echo e(url($dir . $file['basename'])); ?>">
										<img class="mb-4 shawdow rounded" src="<?php echo e(url($dir . $file['basename'])); ?>" data-animate="fadeInUp" />
									</a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<div class="post-navigation">
							<?php if($cms_hinhanh_truoc): ?>
								<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $cms_hinhanh_truoc->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_hinhanh_truoc->MoTaKhongDau . '-' . $cms_hinhanh_truoc->ID . '.html'])); ?>" class="post-prev">
									<div class="post-prev-title"><span>Bài trước</span><?php echo e(Str::limit($cms_hinhanh_truoc->MoTa, 30)); ?></div>
								</a>
							<?php endif; ?>
							<a href="<?php echo e(route('hinhanh.chude', ['chuDe' => $cms_hinhanh->CMS_ChuDe->TenChuDeKhongDau])); ?>" class="post-all">
								<i class="icon-grid"></i>
							</a>
							<?php if($cms_hinhanh_sau): ?>
								<a href="<?php echo e(route('hinhanh.chitiet', ['chuDe' => $cms_hinhanh_sau->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_hinhanh_sau->MoTaKhongDau . '-' . $cms_hinhanh_sau->ID . '.html'])); ?>" class="post-next">
									<div class="post-next-title"><span>Bài sau</span><?php echo e(Str::limit($cms_hinhanh_sau->MoTa, 30)); ?></div>
								</a>
							<?php endif; ?>
						</div>
					</div>
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
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/frontend/hinhanh-chitiet.blade.php ENDPATH**/ ?>