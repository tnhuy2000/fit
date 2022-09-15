

<?php $__env->startSection('pagetitle'); ?>
	Đăng bài viết
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.baiviet.danhsach')); ?>">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Đăng bài viết</div>
		<div class="card-body">
			<form role="form" method="post" action="<?php echo e(route('admin.baiviet.them')); ?>">
				<?php echo csrf_field(); ?>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="MaLoai"><span class="badge badge-info">1</span> Loại bài viết <span class="text-danger font-weight-bold">*</span></label>
						<select class="custom-select <?php $__errorArgs = ['MaLoai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MaLoai" name="MaLoai" required>
							<option value="">-- Chọn loại --</option>
							<?php $__currentLoopData = $cms_loaibaiviet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenLoai); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php $__errorArgs = ['MaLoai'];
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
					<div class="form-group col-md-6">
						<label for="MaChuDe"><span class="badge badge-info">2</span> Chủ đề <span class="text-danger font-weight-bold">*</span></label>
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
				</div>
				<div class="form-group">
					<label for="TieuDe"><span class="badge badge-info">3</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" class="form-control <?php $__errorArgs = ['TieuDe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="TieuDe" name="TieuDe" required />
					<?php $__errorArgs = ['TieuDe'];
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
					<label for="TomTat"><span class="badge badge-secondary">4</span> Tóm tắt bài viết</label>
					<textarea class="form-control" id="TomTat" name="TomTat"></textarea>
				</div>
				<div class="form-group">
					<label for="NoiDung"><span class="badge badge-info">5</span> Nội dung bài viết <span class="text-danger font-weight-bold">*</span></label>
					<textarea class="form-control <?php $__errorArgs = ['NoiDung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> ckeditor" id="NoiDung" name="NoiDung" required></textarea>
					<?php $__errorArgs = ['NoiDung'];
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
				<div class="form-group" id="divDonVi">
					<label for="MaDonVi"><span class="badge badge-info">6</span> Nhân sự trực thuộc <span class="text-danger font-weight-bold">*</span></label>
					<select class="custom-select <?php $__errorArgs = ['MaDonVi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MaDonVi" name="MaDonVi">
						<option value="">-- Chọn đơn vị --</option>
						<?php $__currentLoopData = $hrm_donvi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenDonVi); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<?php $__errorArgs = ['MaDonVi'];
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
				<div class="form-group" id="divDinhKem">
					<label for="DinhKem"><span class="badge badge-info">6</span> Văn bản đính kèm <span class="text-danger font-weight-bold">*</span></label>
					<div class="form-row add-more-after">
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><a href="#taptin" onclick="BrowseServer(1);">Chọn tập tin</a></div>
								</div>
								<input type="text" class="form-control" id="DinhKem1" name="DinhKem[]" value="" readonly />
								<div class="input-group-append">
									<button class="btn btn-primary btn-add-more" type="button"><i class="fal fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" id="TenVanBan1" name="TenVanBan[]" value="" placeholder="Tên văn bản (bắt buộc)" />
						</div>
					</div>
					<div class="copy d-none">
						<div class="form-row">
							<div class="form-group col-md-6">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><a href="#taptin" onclick="">Chọn tập tin</a></div>
									</div>
									<input type="text" class="form-control" id="" name="DinhKem[]" value="" readonly />
									<div class="input-group-append">
										<button class="btn btn-danger btn-remover" type="button"><i class="fal fa-times"></i></button>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" id="" name="TenVanBan[]" value="" placeholder="Tên văn bản (bắt buộc)" />
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox" id="QuanTrong" name="QuanTrong" value="1" />
						<label class="custom-control-label" for="QuanTrong">Ghim bài viết lên trên cùng</label>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Đăng bài viết</button>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('public/vendor/ckeditor/4.15.0/ckeditor.js')); ?>"></script>
	<script src="<?php echo e(asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js')); ?>"></script>
	<script>
		$(document).ready(function() {
			if($("#MaLoai").val() == "1") {
				$("#divDinhKem").hide();
				$("#divDonVi").hide();
			} else if($("#MaLoai").val() == "2") {
				$("#divDinhKem").show();
				$("#divDonVi").hide();
			} else if($("#MaLoai").val() == "3") {
				$("#divDinhKem").hide();
				$("#divDonVi").show();
			} else {
				$("#divDinhKem").hide();
				$("#divDonVi").hide();
			}
			$("#MaLoai").change(function() {
				if($("#MaLoai").val() == "1") {
					$("#divDinhKem").hide();
					$("#divDonVi").hide();
				} else if($("#MaLoai").val() == "2") {
					$("#divDinhKem").show();
					$("#divDonVi").hide();
				} else if($("#MaLoai").val() == "3") {
					$("#divDinhKem").hide();
					$("#divDonVi").show();
				} else {
					$("#divDinhKem").hide();
					$("#divDonVi").hide();
				}
			});
			
			var index = 2;
			$(".btn-add-more").click(function() {
				$(".copy input[name^='DinhKem']").attr("id", "DinhKem" + index);
				$(".copy input[name^='TenVanBan']").attr("id", "TenVanBan" + index);
				$(".copy a").attr("onclick", "BrowseServer(" + index + ");");
				index++;
				
				var html = $(".copy").html();
				$(".add-more-after").after(html);
			});
			$("body").on("click", ".btn-remover", function() {
				$(this).parents(".form-row").remove();
			});
		});
		
		function escapeHtml(unsafe)
		{
			return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		function BrowseServer(index)
		{
			CKFinder.modal(
			{
				chooseFiles: true,
				displayFoldersPanel: false,
				width: 800,
				height: 500,
				onInit: function(finder) {
					finder.on('files:choose', function(evt) {
						var file = evt.data.files.first();
						var output = document.getElementById("DinhKem" + index);
						output.value = escapeHtml(file.get('name'));
					});
					finder.on('file:choose:resizedImage', function(evt) {
						var output = document.getElementById("DinhKem" + index);
						output.value = escapeHtml(evt.data.file.get('name'));
					});
				}
			});
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/baiviet/them.blade.php ENDPATH**/ ?>