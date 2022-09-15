

<?php $__env->startSection('pagetitle'); ?>
	Đăng hình ảnh
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.hinhanh.danhsach')); ?>">Quản lý hình ảnh</a> <i class="fal fa-angle-double-right"></i> Đăng hình ảnh</div>
		<div class="card-body">
			<form role="form" method="post" action="<?php echo e(route('admin.hinhanh.them')); ?>">
				<?php echo csrf_field(); ?>
				<div class="form-group">
					<label for="MaChuDe"><span class="badge badge-info">1</span> Chủ đề <span class="text-danger font-weight-bold">*</span></label>
					<select class="custom-select <?php $__errorArgs = ['MaChuDe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MaChuDe" name="MaChuDe" required>
						<option value="">-- Chọn chủ đề --</option>
						<?php $__currentLoopData = $cms_chude; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenChuDe); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<?php $__errorArgs = ['MaChuDe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="invalid-feedback"><strong><?php echo e($message); ?></strong></div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				<div class="form-group">
					<label for="MoTa"><span class="badge badge-info">2</span> Mô tả album ảnh <span class="text-danger font-weight-bold">*</span></label>
					<textarea class="form-control <?php $__errorArgs = ['MoTa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MoTa" name="MoTa" required><?php echo e(old('MoTa')); ?></textarea>
					<?php $__errorArgs = ['MoTa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="invalid-feedback"><strong><?php echo e($message); ?></strong></div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				<div class="form-group">
					<label for="ThuMuc"><span class="badge badge-info">3</span> Hình ảnh đính kèm <span class="text-danger font-weight-bold">*</span></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text" id="ChonHinh"><a href="#hinhanh">Tải ảnh lên</a></div>
						</div>
						<input type="text" class="form-control" id="ThuMuc" name="ThuMuc" value="<?php echo e($folder); ?>" readonly required />
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Đăng hình ảnh</button>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js')); ?>"></script>
	<script>
		var chonHinh = document.getElementById('ChonHinh');
		chonHinh.onclick = function() { uploadFileWithCKFinder(); };
		function uploadFileWithCKFinder()
		{
			CKFinder.modal(
			{
				displayFoldersPanel: false,
				width: 800,
				height: 500
			});
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/admin/hinhanh/them.blade.php ENDPATH**/ ?>