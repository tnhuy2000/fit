

<?php $__env->startSection('pagetitle'); ?>
	Trang chủ quản trị
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header">Trang chủ quản trị</div>
		<div class="card-body admin-page">
			<?php if(session('status')): ?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
					<span class="font-weight-bold text-primary"><i class="fal fa-info-circle"></i> <?php echo e(session('status')); ?></span>
				</div>
			<?php endif; ?>
			<div class="card-deck">
				<?php if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qldanhmuc"): ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="card text-center">
							<a href="<?php echo e(route('admin.danhmuc.home')); ?>">
								<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/danhmuc.png')); ?>" alt="" />
								<div class="card-body">
									<p class="card-text"><strong>Danh mục</strong></p>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<?php if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qlbaiviet"): ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="card text-center">
							<a href="<?php echo e(route('admin.baiviet.home')); ?>">
								<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/baiviet.png')); ?>" alt="" />
								<div class="card-body">
									<p class="card-text"><strong>Bài viết</strong></p>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<?php if(Auth::user()->privilege == "superadmin" || Auth::user()->privilege == "qlbaiviet"): ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="card text-center">
							<a href="<?php echo e(route('admin.hinhanh.home')); ?>">
								<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/hinhanh.png')); ?>" alt="" />
								<div class="card-body">
									<p class="card-text"><strong>Hình ảnh</strong></p>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card text-center">
						<a href="<?php echo e(route('admin.hosonhanvien.home')); ?>">
							<img class="card-img-top" src="<?php echo e(asset('public/admin/images/icons/hosonhanvien.png')); ?>" alt="" />
							<div class="card-body">
								<p class="card-text"><strong>Hồ sơ nhân viên</strong></p>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div>
				<form>
					<input type="text" class="form-control" name="ngaycong" id="ngaycong">
					<input type="text" class="form-control" name="luong" id="luong" value="0">
					<input type="text" class="form-control" name="phucap" id="phucap">
				</form>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>  
<script type="text/javascript">

	const source = document.getElementById('ngaycong');
	//const source1 = document.getElementById('luongcobantheocv');
	const result = document.getElementById('luong');
  
	const inputHandler = function(e) {
	  var ngaycong= e.target.value;
	  result.value = parseInt(ngaycong)* 200000;
	}
  
	source.addEventListener('input', inputHandler);
	source.addEventListener('propertychange', inputHandler); // for IE8
  
  </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/index.blade.php ENDPATH**/ ?>