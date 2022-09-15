

<?php $__env->startSection('pagetitle'); ?>
	Danh sách nhân viên theo đơn vị
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.danhmuc.home')); ?>">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách nhân viên theo đơn vị</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="25%">Đơn vị</th>
						<th width="25%">Nhân viên</th>
						<th width="25%">Chức vụ</th>
						<th width="10%">Thứ tự</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $hrm_nhanvien_donvi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($value->HRM_DonVi->TenDonVi); ?></td>
							<td><?php echo e($value->HRM_NhanVien->HoVaTen); ?></td>
							<td><?php echo e($value->HRM_ChucVu->TenChucVu); ?></td>
							<td><?php echo e($value->ThuTuHienThi); ?></td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat(<?php echo e($value->ID); ?>, <?php echo e($value->MaNhanVien); ?>, <?php echo e($value->MaDonVi); ?>, <?php echo e($value->MaChucVu); ?>, <?php echo e($value->ThuTuHienThi); ?>); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->ID); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.donvi.them')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm nhân viên vào đơn vị</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="MaNhanVien"><span class="badge badge-info">1</span> Nhân viên <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaNhanVien" name="MaNhanVien" required>
								<option value="">-- Chọn nhân viên --</option>
								<?php $__currentLoopData = $hrm_nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->HoVaTen); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="MaDonVi"><span class="badge badge-info">2</span> Đơn vị <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaDonVi" name="MaDonVi" required>
								<option value="">-- Chọn đơn vị --</option>
								<?php $__currentLoopData = $hrm_donvi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenDonVi); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="MaChucVu"><span class="badge badge-info">3</span> Chức vụ <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaChucVu" name="MaChucVu" required>
								<option value="">-- Chọn chức vụ --</option>
								<?php $__currentLoopData = $hrm_chucvu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenChucVu); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi"><span class="badge badge-info">4</span> Thứ tự hiển thị <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control" id="ThuTuHienThi" name="ThuTuHienThi" value="<?php echo e(old('ThuTuHienThi')); ?>" required />
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.donvi.sua')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật nhân viên trong đơn vị</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="MaNhanVien_edit"><span class="badge badge-info">1</span> Nhân viên <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaNhanVien_edit" name="MaNhanVien_edit" required>
								<option value="">-- Chọn nhân viên --</option>
								<?php $__currentLoopData = $hrm_nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->HoVaTen); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="MaDonVi_edit"><span class="badge badge-info">2</span> Đơn vị <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaDonVi_edit" name="MaDonVi_edit" required>
								<option value="">-- Chọn đơn vị --</option>
								<?php $__currentLoopData = $hrm_donvi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenDonVi); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="MaChucVu_edit"><span class="badge badge-info">3</span> Chức vụ <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select" id="MaChucVu_edit" name="MaChucVu_edit" required>
								<option value="">-- Chọn chức vụ --</option>
								<?php $__currentLoopData = $hrm_chucvu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->ID); ?>"><?php echo e($value->TenChucVu); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi_edit"><span class="badge badge-info">4</span> Thứ tự hiển thị <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control" id="ThuTuHienThi_edit" name="ThuTuHienThi_edit" value="<?php echo e(old('ThuTuHienThi_edit')); ?>" required />
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.donvi.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa nhân viên khỏi đơn vị</h5>
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
		function getCapNhat(id, maNhanVien, maDonVi, maChucVu, thuTuHienThi) {
			$('#ID_edit').val(id);
			$('#MaNhanVien_edit').val(maNhanVien);
			$('#MaDonVi_edit').val(maDonVi);
			$('#MaChucVu_edit').val(maChucVu);
			$('#ThuTuHienThi_edit').val(thuTuHienThi);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/danhmuc/nhanvien_donvi.blade.php ENDPATH**/ ?>