

<?php $__env->startSection('pagetitle'); ?>
	Đăng nhập
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Đăng nhập</div>
					<div class="card-body">
						<?php if(session('warning')): ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
								<span class="font-weight-bold text-danger"><i class="fal fa-exclamation-triangle"></i> <?php echo e(session('warning')); ?></span>
							</div>
						<?php endif; ?>
						<a class="btn btn-lg btn-warning d-block mb-3" href="<?php echo e(route('google.login')); ?>" role="button"><i class="fab fa-google"></i> Đăng nhập bằng AGU email</a>
						<a class="btn btn-lg btn-primary d-block" href="#login-form" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="login-form"><i class="fal fa-user-circle"></i> Đăng nhập bằng tài khoản FIT</a>
						<form method="post" action="<?php echo e(route('login')); ?>" class="collapse mt-3" id="login-form">
							<?php echo csrf_field(); ?>
							<div class="form-group">
								<label for="email"><span class="badge badge-info">1</span> Tài khoản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control<?php echo e(($errors->has('email') || $errors->has('username')) ? ' is-invalid' : ''); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email hoặc Tên đăng nhập" required />
								<?php if($errors->has('email') || $errors->has('username')): ?>
									<span class="invalid-feedback" role="alert"><strong><?php echo e(empty($errors->first('email')) ? $errors->first('username') : $errors->first('email')); ?></strong></span>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<label for="password"><span class="badge badge-info">2</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" required />
								<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group">
								<label for="feedback-recaptcha"><span class="badge badge-info">3</span> Xác thực đăng nhập <span class="text-danger font-weight-bold">*</span></label>
								<div class="g-recaptcha <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>" data-size="normal" data-theme="light"></div>
								<?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="remember" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> />
									<label class="custom-control-label" for="remember">Duy trì đăng nhập</label>
								</div>
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-info"><i class="fal fa-sign-in-alt"></i> Đăng nhập</button>
								<?php if(Route::has('password.request')): ?>
									<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">Quên mật khẩu?</a>
								<?php endif; ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="https://www.google.com/recaptcha/api.js?hl=vi" async defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/auth/login.blade.php ENDPATH**/ ?>