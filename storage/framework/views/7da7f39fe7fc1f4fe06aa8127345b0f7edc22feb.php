

<?php $__env->startSection('pagetitle'); ?>
	Quản lý bài viết
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> Quản lý bài viết</div>
		<div class="card-body admin-page">
			<div class="card-deck">
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="<?php echo e(route('admin.baiviet.them')); ?>">
							<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/thembaiviet.png')); ?>" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Đăng bài viết</strong></p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="<?php echo e(route('admin.baiviet.danhsach')); ?>">
							<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/dsbaiviet.png')); ?>" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Bài viết đã đăng</strong></p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/baiviet/index.blade.php ENDPATH**/ ?>