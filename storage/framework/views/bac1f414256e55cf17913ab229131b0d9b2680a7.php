

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="<?php echo e(isset($session_title) ? $session_title : $cms_chude->TenChuDe); ?>" />
	<meta property="og:description" content="Nhấn vào để xem các bài viết của <?php echo e(config('app.name', 'LCMS')); ?>." />
	<meta name="description" content="Nhấn vào để xem các bài viết của <?php echo e(config('app.name', 'LCMS')); ?>." />
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
					<li><a href="<?php echo e(route('baiviet')); ?>"><i class="fal fa-newspaper"></i> Bài viết</a></li>
					<li class="active"><i class="fal fa-tag"></i> <?php if(isset($session_title)): ?> <?php echo e($session_title); ?> <?php else: ?> <?php echo e($cms_chude->TenChuDe); ?> <?php endif; ?></li>
				</ul>
			</div>
			<div class="page-title">
				<h1><?php if(isset($session_title)): ?> <?php echo e($session_title); ?> <?php else: ?> <?php echo e($cms_chude->TenChuDe); ?> <?php endif; ?></h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="sidebar-right p-t-30 p-b-30">
		<div class="container">
			<div class="row">
				<div class="content col-lg-9">
					<div id="blog" class="grid-layout post-thumbnails post-1-columns m-b-10" data-item="post-item">
						<?php $__currentLoopData = $cms_baiviet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="post-item">
								<div class="post-item-wrap">
									<div class="post-image">
										<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><img src="<?php echo e($cms_baiviet_first_file[$value->ID]); ?>" /></a>
										<span class="post-meta-category"><a href="<?php echo e(route('baiviet.chude', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau])); ?>"><?php echo e($value->CMS_ChuDe->TenChuDe); ?></a></span>
									</div>
									<div class="post-item-description">
										<span class="post-meta-date"><i class="fal fa-calendar-alt"></i><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y')); ?></span>
										<span class="post-meta-comments"><i class="fal fa-eye"></i><?php echo e($value->LuotXem); ?> lượt xem</span>
										<h2 class="text-justify"><a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><?php echo e($value->TieuDe); ?></a></h2>
										<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>" class="item-link">Xem tiếp <i class="fal fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div id="pagination" class="d-flex justify-content-center">
						<?php echo e($cms_baiviet->links()); ?>

					</div>
				</div>
				<div class="sidebar sticky-sidebar col-lg-3">
					<div class="widget widget-categories">
						<h4 class="widget-title">Chuyên mục</h4>
						<ul class="list list-arrow-icons">
							<?php $__currentLoopData = $cms_chude_thongke; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e(route('baiviet.chude', ['chuDe' => $value->TenChuDeKhongDau])); ?>"><i class="fal fa-tag"></i> <?php echo e($value->TenChuDe); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<div class="widget">
						<h4 class="widget-title">Xem nhiều nhất</h4>
						<div class="post-thumbnail-list">
							<?php $__currentLoopData = $cms_baiviet_xnn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="post-thumbnail-entry">
									<img src="<?php echo e($cms_baiviet_xnn_first_file[$value->ID]); ?>" />
									<div class="post-thumbnail-content">
										<a class="text-justify" href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><?php echo e($value->TieuDe); ?></a>
										<span class="post-date"><i class="fal fa-calendar-alt"></i> <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y')); ?></span>
										<span class="post-category"><i class="fal fa-eye"></i> <?php echo e($value->LuotXem); ?> lượt xem</span>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_ARTICLE')); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_ARTICLE')); ?>', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/frontend/baiviet.blade.php ENDPATH**/ ?>