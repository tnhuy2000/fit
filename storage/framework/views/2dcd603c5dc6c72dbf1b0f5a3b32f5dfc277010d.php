

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="404 - Không tìm thấy trang" />
	<meta property="og:description" content="Trang chủ <?php echo e(config('app.name', 'LCMS')); ?>." />
	<meta name="description" content="Trang chủ <?php echo e(config('app.name', 'LCMS')); ?>." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', '404 - Không tìm thấy trang'); ?>

<?php $__env->startSection('content'); ?>
	<section class="m-t-0 m-b-0">
		<div class="container">
			<div class="row">
				<div class="col-xl-6">
					<div class="page-error-404 text-center">404</div>
				</div>
				<div class="col-xl-6">
					<div class="mt-lg-4 mt-xl-0">
						<h1 class="text-medium text-sm-center text-xl-left">Không tìm thấy trang!</h1>
						<p class="lead text-sm-center text-xl-left">Liên kết trang bị lỗi hoặc trang này không còn tồn tại trên hệ thống.</p>
						<div class="seperator m-t-20"></div>
						<div class="text-sm-center text-xl-left"><a href="<?php echo e(route('home')); ?>" class="btn"><i class="fal fa-home"></i> Về trang chủ</a></div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/errors/404.blade.php ENDPATH**/ ?>