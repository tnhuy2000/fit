

<?php $__env->startSection('pagetitle'); ?>
	Danh sách người dùng
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.danhmuc.home')); ?>">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách người dùng</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Họ và tên</th>
						<th width="10%">Tên đăng nhập</th>
						<th width="20%">Email</th>
						<th width="10%">Quyền hạn</th>
						<th width="15%">Ngày tạo</th>
						<th width="15%">Ngày cập nhật</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $sys_nguoidung; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($value->name); ?></td>
							<td><?php echo e($value->username); ?></td>
							<td><?php echo e($value->email); ?></td>
							<td>
								<?php if($value->privilege == "superadmin"): ?>
									<span class="badge badge-pill badge-danger">Toàn quyền</span>
								<?php elseif($value->privilege == "qldanhmuc"): ?>
									<span class="badge badge-pill badge-primary">QL Danh mục</span>
								<?php elseif($value->privilege == "qlbaiviet"): ?>
									<span class="badge badge-pill badge-success">QL Bài viết</span>
								<?php else: ?>
									<span class="badge badge-pill badge-warning">Cán bộ nhân viên</span>
								<?php endif; ?>
							</td>
							<td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s')); ?></td>
							<td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->format('d/m/Y H:i:s')); ?></td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat(<?php echo e($value->id); ?>, '<?php echo e($value->name); ?>', '<?php echo e($value->username); ?>', '<?php echo e($value->email); ?>', '<?php echo e($value->privilege); ?>'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->id); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.danhmuc.nguoidung.them')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm người dùng</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name"><span class="badge badge-info">1</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" required />
							<?php $__errorArgs = ['name'];
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
							<label for="username"><span class="badge badge-info">2</span> Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="username" name="username" value="<?php echo e(old('username')); ?>" required />
							<?php $__errorArgs = ['username'];
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
							<label for="email"><span class="badge badge-info">3</span> Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required />
							<?php $__errorArgs = ['email'];
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
							<label for="password"><span class="badge badge-info">4</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
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
								<div class="invalid-feedback"><strong><?php echo e($message); ?></strong></div>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>
						<div class="form-group">
							<label for="password_confirmation"><span class="badge badge-info">5</span> Xác nhận mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_confirmation" name="password_confirmation" required />
							<?php $__errorArgs = ['password_confirmation'];
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
							<label for="privilege"><span class="badge badge-info">6</span> Quyền hạn người dùng <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select <?php $__errorArgs = ['privilege'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="privilege" name="privilege" required>
								<option value="">-- Quyền hạn --</option>
								<option value="superadmin">Toàn quyền</option>
								<option value="qldanhmuc">Quản lý danh mục</option>
								<option value="qlbaiviet" selected>Quản lý bài viết</option>
								<option value="nhanvien">Cán bộ nhân viên</option>
							</select>
							<?php $__errorArgs = ['privilege'];
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
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.danhmuc.nguoidung.sua')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin người dùng</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name_edit"><span class="badge badge-info">1</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control <?php $__errorArgs = ['name_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name_edit" name="name_edit" value="<?php echo e(old('name_edit')); ?>" required />
							<?php $__errorArgs = ['name_edit'];
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
							<label for="username_edit"><span class="badge badge-info">2</span> Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control <?php $__errorArgs = ['username_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="username_edit" name="username_edit" value="<?php echo e(old('username_edit')); ?>" required />
							<?php $__errorArgs = ['username_edit'];
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
							<label for="email_edit"><span class="badge badge-info">3</span> Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="email" class="form-control <?php $__errorArgs = ['email_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email_edit" name="email_edit" value="<?php echo e(old('email_edit')); ?>" required />
							<?php $__errorArgs = ['email_edit'];
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
							<label for="password_edit"><span class="badge badge-info">4</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control <?php $__errorArgs = ['password_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_edit" name="password_edit" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							<?php $__errorArgs = ['password_edit'];
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
							<label for="password_edit_confirmation"><span class="badge badge-info">5</span> Xác nhận mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control <?php $__errorArgs = ['password_edit_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_edit_confirmation" name="password_edit_confirmation" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							<?php $__errorArgs = ['password_edit_confirmation'];
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
							<label for="privilege_edit"><span class="badge badge-info">6</span> Quyền hạn người dùng <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select <?php $__errorArgs = ['privilege_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="privilege_edit" name="privilege_edit" required>
								<option value="">-- Quyền hạn --</option>
								<option value="superadmin">Toàn quyền</option>
								<option value="qldanhmuc">Quản lý danh mục</option>
								<option value="qlbaiviet">Quản lý bài viết</option>
								<option value="nhanvien">Cán bộ nhân viên</option>
							</select>
							<?php $__errorArgs = ['privilege_edit'];
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
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.danhmuc.nguoidung.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="id_delete" name="id_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa người dùng</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<p class="font-weight-bold text-danger"><i class="fal fa-question-circle"></i> Xác nhận xóa? Hành động này không thể phục hồi.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fal fa-trash-alt"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php $__env->stopSection(); ?>
	
<?php $__env->startSection('javascript'); ?>
	<script>
		function getCapNhat(id, name, username, email, privilege) {
			$('#id_edit').val(id);
			$('#name_edit').val(name);
			$('#username_edit').val(username);
			$('#email_edit').val(email);
			$('#privilege_edit').val(privilege);
		}
		
		function getXoa(id) {
			$('#id_delete').val(id);
		}
		
		<?php if($errors->has('email') || $errors->has('name') || $errors->has('username') || $errors->has('password') || $errors->has('password_confirmation') || $errors->has('privilege')): ?>
			$('#myModal').modal('show');
		<?php endif; ?>
		
		<?php if($errors->has('email_edit') || $errors->has('name_edit') || $errors->has('username_edit') || $errors->has('password_edit') || $errors->has('password_edit_confirmation') || $errors->has('privilege_edit')): ?>
			$('#myModalEdit').modal('show');
		<?php endif; ?>
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/danhmuc/nguoidung.blade.php ENDPATH**/ ?>