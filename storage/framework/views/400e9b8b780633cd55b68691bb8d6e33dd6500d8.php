

<?php $__env->startSection('pagetitle'); ?>
	Đề tài khoa học
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.hosonhanvien.home')); ?>">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Đề tài khoa học</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="65%">Thông tin đề tài</th>
						<th width="10%">Nghiệm thu</th>
						<th width="10%">Hiện công khai</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $hrm_detaikhoahoc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td>
								<span class="text-primary font-weight-bold d-block"><?php echo e($value->TenCongTrinh); ?></span>
								<span class="d-block">Cấp quản lý: <strong><?php echo e($value->CapQuanLy); ?></strong></span>
								<span class="d-block">Chủ nhiệm: <strong><?php echo e($value->ChuNhiem); ?></strong></span>
								<?php if(!empty($value->ThanhVienThamGia)): ?>
									<span class="d-block">Thành viên tham gia: <strong><?php echo e($value->ThanhVienThamGia); ?></strong></span>
								<?php endif; ?>
								<?php if(!empty($value->LienKet)): ?>
									<span class="d-block">Xem chi tiết: <strong><?php echo e($value->LienKet); ?></strong></span>
								<?php endif; ?>
							</td>
							<td><?php echo e($value->NamNghiemThu); ?></td>
							<td class="text-center">
								<?php if($value->HienThiCongKhai == 1): ?>
									<a href="<?php echo e(route('admin.hosonhanvien.detaikhoahoc.congbo', ['id' => $value->ID])); ?>"><i class="fal fa-check-circle" title="Hiển thị công khai trong mục NCKH"></i></a>
								<?php else: ?>
									<a href="<?php echo e(route('admin.hosonhanvien.detaikhoahoc.congbo', ['id' => $value->ID])); ?>"><i class="fal fa-ban text-danger" title="Không hiển thị"></i></a>
								<?php endif; ?>
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat(<?php echo e($value->ID); ?>, '<?php echo e($value->CapQuanLy); ?>', '<?php echo e(addslashes($value->TenCongTrinh)); ?>', '<?php echo e($value->ChuNhiem); ?>', '<?php echo e($value->ThanhVienThamGia); ?>', '<?php echo e($value->NamNghiemThu); ?>', '<?php echo e($value->LienKet); ?>', <?php echo e($value->HienThiCongKhai); ?>); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->ID); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.hosonhanvien.detaikhoahoc.them')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm đề tài khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="CapQuanLy"><span class="badge badge-info">1</span> Cấp quản lý <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select <?php $__errorArgs = ['CapQuanLy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="CapQuanLy" name="CapQuanLy" required>
									<option value="">-- Chọn loại --</option>
									<option>Sinh viên</option>
									<option>Cấp Khoa/Bộ môn/Phòng ban</option>
									<option>Cấp Trường</option>
									<option>Cấp cơ sở</option>
									<option>Cấp tỉnh</option>
									<option>Cấp ĐHQG - Loại A</option>
									<option>Cấp ĐHQG - Loại B</option>
									<option>Cấp ĐHQG - Loại C</option>
									<option>Cấp bộ/Nhà nước</option>
									<option>Dự án Quốc tế</option>
									<option>Dự án Trong nước</option>
								</select>
								<?php $__errorArgs = ['CapQuanLy'];
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
							<div class="form-group col-md-8">
								<label for="TenCongTrinh"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['TenCongTrinh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="TenCongTrinh" name="TenCongTrinh" value="<?php echo e(old('TenCongTrinh')); ?>" required />
								<?php $__errorArgs = ['TenCongTrinh'];
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ChuNhiem"><span class="badge badge-info">3</span> Chủ nhiệm đề tài <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['ChuNhiem'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="ChuNhiem" name="ChuNhiem" value="<?php echo e(old('ChuNhiem')); ?>" required />
								<?php $__errorArgs = ['ChuNhiem'];
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
							<div class="form-group col-md-8">
								<label for="ThanhVienThamGia"><span class="badge badge-secondary">4</span> Thành viên tham gia</label>
								<input type="text" class="form-control" id="ThanhVienThamGia" name="ThanhVienThamGia" value="<?php echo e(old('ThanhVienThamGia')); ?>" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="NamNghiemThu"><span class="badge badge-info">5</span> Năm nghiệm thu <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['NamNghiemThu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NamNghiemThu" name="NamNghiemThu" value="<?php echo e(old('NamNghiemThu')); ?>" required />
								<?php $__errorArgs = ['NamNghiemThu'];
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
							<div class="form-group col-md-8">
								<label for="LienKet"><span class="badge badge-secondary">6</span> Liên kết</label>
								<input type="text" class="form-control" id="LienKet" name="LienKet" value="<?php echo e(old('LienKet')); ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="HienThiCongKhai" name="HienThiCongKhai" value="1" />
								<label class="custom-control-label font-weight-bold text-danger" for="HienThiCongKhai">Cho phép hiển thị công khai trong mục NCKH.</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.hosonhanvien.detaikhoahoc.sua')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật đề tài khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="CapQuanLy_edit"><span class="badge badge-info">1</span> Cấp quản lý <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select <?php $__errorArgs = ['CapQuanLy_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="CapQuanLy_edit" name="CapQuanLy_edit" required>
									<option value="">-- Chọn loại --</option>
									<option>Sinh viên</option>
									<option>Cấp Khoa/Bộ môn/Phòng ban</option>
									<option>Cấp Trường</option>
									<option>Cấp cơ sở</option>
									<option>Cấp tỉnh</option>
									<option>Cấp ĐHQG - Loại A</option>
									<option>Cấp ĐHQG - Loại B</option>
									<option>Cấp ĐHQG - Loại C</option>
									<option>Cấp bộ/Nhà nước</option>
									<option>Dự án Quốc tế</option>
									<option>Dự án Trong nước</option>
								</select>
								<?php $__errorArgs = ['CapQuanLy_edit'];
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
							<div class="form-group col-md-8">
								<label for="TenCongTrinh_edit"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['TenCongTrinh_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="TenCongTrinh_edit" name="TenCongTrinh_edit" value="<?php echo e(old('TenCongTrinh_edit')); ?>" required />
								<?php $__errorArgs = ['TenCongTrinh_edit'];
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ChuNhiem_edit"><span class="badge badge-info">3</span> Chủ nhiệm đề tài <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['ChuNhiem_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="ChuNhiem_edit" name="ChuNhiem_edit" value="<?php echo e(old('ChuNhiem_edit')); ?>" required />
								<?php $__errorArgs = ['ChuNhiem_edit'];
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
							<div class="form-group col-md-8">
								<label for="ThanhVienThamGia_edit"><span class="badge badge-secondary">4</span> Thành viên tham gia</label>
								<input type="text" class="form-control" id="ThanhVienThamGia_edit" name="ThanhVienThamGia_edit" value="<?php echo e(old('ThanhVienThamGia_edit')); ?>" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="NamNghiemThu_edit"><span class="badge badge-info">5</span> Năm nghiệm thu <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['NamNghiemThu_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NamNghiemThu_edit" name="NamNghiemThu_edit" value="<?php echo e(old('NamNghiemThu_edit')); ?>" required />
								<?php $__errorArgs = ['NamNghiemThu_edit'];
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
							<div class="form-group col-md-8">
								<label for="LienKet_edit"><span class="badge badge-secondary">6</span> Liên kết</label>
								<input type="text" class="form-control" id="LienKet_edit" name="LienKet_edit" value="<?php echo e(old('LienKet_edit')); ?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="HienThiCongKhai_edit" name="HienThiCongKhai_edit" value="1" />
								<label class="custom-control-label font-weight-bold text-danger" for="HienThiCongKhai_edit">Cho phép hiển thị công khai trong mục NCKH.</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.hosonhanvien.detaikhoahoc.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa đề tài khoa học</h5>
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
		function getCapNhat(id, capQuanLy, tenCongTrinh, chuNhiem, thanhVien, nam, lienKet, congKhai) {
			$('#ID_edit').val(id);
			$('#CapQuanLy_edit').val(capQuanLy);
			$('#TenCongTrinh_edit').val(tenCongTrinh);
			$('#ChuNhiem_edit').val(chuNhiem);
			$('#ThanhVienThamGia_edit').val(thanhVien);
			$('#NamNghiemThu_edit').val(nam);
			$('#LienKet_edit').val(lienKet);
			$('#HienThiCongKhai_edit').prop('checked', congKhai);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		<?php if($errors->has('CapQuanLy') || $errors->has('TenCongTrinh') || $errors->has('ChuNhiem') || $errors->has('NamNghiemThu')): ?>
			$('#myModal').modal('show');
		<?php endif; ?>
		
		<?php if($errors->has('CapQuanLy_edit') || $errors->has('TenCongTrinh_edit') || $errors->has('ChuNhiem_edit') || $errors->has('NamNghiemThu_edit')): ?>
			$('#myModalEdit').modal('show');
		<?php endif; ?>
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/hosonhanvien/detaikhoahoc.blade.php ENDPATH**/ ?>