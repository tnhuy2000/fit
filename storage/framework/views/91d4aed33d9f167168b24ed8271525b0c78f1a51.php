

<?php $__env->startSection('pagetitle'); ?>
	Danh sách nhân viên
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('public/vendor/datepicker/1.9.0/css/bootstrap-datepicker.min.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.danhmuc.home')); ?>">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách nhân viên</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Hình ảnh</th>
						<th width="15%">Mã cán bộ</th>
						<th width="50%">Thông tin nhân viên</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $hrm_nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td class="text-center">
								<?php if(!empty($value->HinhAnh)): ?>
									<img class="rounded" src="<?php echo e($path . strstr($value->Email, '@', true). '/' . $value->HinhAnh); ?>" width="100" />
								<?php else: ?>
									<img class="rounded" src="<?php echo e($path . 'noimage.png'); ?>" width="100" />
								<?php endif; ?>
							</td>
							<td>
								<?php echo e($value->MaCanBo); ?>

								<?php if($value->TrangThai == 0): ?>
									<span class="d-block small text-danger font-weight-bold">Đã chuyển công tác</span>
								<?php endif; ?>
							</td>
							<td>
								<span class="text-primary font-weight-bold"><?php echo e($value->HoVaTen); ?></span>
								<span class="small">
									<?php if(!empty($value->NamSinh)): ?>
										<br />Năm sinh: <?php echo e($value->NamSinh); ?>

									<?php endif; ?>
									<?php $ngayVaoLam = null; ?>
									<?php if(!empty($value->NgayVaoLam)): ?>
										<?php $ngayVaoLam = Carbon\Carbon::createFromFormat('Y-m-d', $value->NgayVaoLam)->format('d/m/Y'); ?>
										<br />Ngày vào làm: <?php echo e($ngayVaoLam); ?>

									<?php endif; ?>
									<?php if(!empty($value->ChuyenNganh)): ?>
										<br />Chuyên ngành: <?php echo e($value->ChuyenNganh); ?>

									<?php endif; ?>
									<?php if(!empty($value->HocVi)): ?>
										<br />Học vị: <?php echo e($value->HocVi); ?>

										<?php if(!empty($value->NamNhanHocVi)): ?>
											(<?php echo e($value->NamNhanHocVi); ?>)
										<?php endif; ?>
									<?php endif; ?>
									<?php if(!empty($value->HocHam)): ?>
										<br />Học hàm: <?php echo e($value->HocHam); ?>

										<?php if(!empty($value->NamNhanHocHam)): ?>
											(<?php echo e($value->NamNhanHocHam); ?>)
										<?php endif; ?>
									<?php endif; ?>
									<?php if(!empty($value->Email)): ?>
										<br />Email: <?php echo e($value->Email); ?>

									<?php endif; ?>
									<?php if(!empty($value->DienThoai)): ?>
										<br />Điện thoại: <?php echo e($value->DienThoai); ?>

									<?php endif; ?>
									<?php if(!empty($value->TrangWeb)): ?>
										<br />Trang web: <?php echo e($value->TrangWeb); ?>

									<?php endif; ?>
									<?php if(!empty($value->ThongTinThem)): ?>
										<br />Thông tin khác: <?php echo e($value->ThongTinThem); ?>

									<?php endif; ?>
								</span>
							</td>
							<td class="text-center">
								<?php if($value->TrangThai == 1): ?>
									<a href="<?php echo e(route('admin.danhmuc.nhanvien.trangthai', ['id' => $value->ID])); ?>"><i class="fal fa-check-circle" title="Đang hoạt động"></i></a>
								<?php else: ?>
									<a href="<?php echo e(route('admin.danhmuc.nhanvien.trangthai', ['id' => $value->ID])); ?>"><i class="fal fa-ban text-danger" title="Đã chuyển công tác"></i></a>
								<?php endif; ?>
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat(<?php echo e($value->ID); ?>, '<?php echo e($value->MaCanBo); ?>', '<?php echo e($value->HoVaTen); ?>', '<?php echo e($value->NamSinh); ?>', '<?php echo e($ngayVaoLam); ?>', '<?php echo e($value->ChuyenNganh); ?>', '<?php echo e($value->HocVi); ?>', '<?php echo e($value->NamNhanHocVi); ?>', '<?php echo e($value->HocHam); ?>', '<?php echo e($value->NamNhanHocHam); ?>', '<?php echo e($value->Email); ?>', '<?php echo e($value->DienThoai); ?>', '<?php echo e($value->TrangWeb); ?>', '<?php echo e($value->HinhAnh); ?>'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->ID); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.them')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm nhân viên</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="MaCanBo"><span class="badge badge-secondary">1</span> Mã cán bộ</label>
								<input type="text" class="form-control <?php $__errorArgs = ['MaCanBo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MaCanBo" name="MaCanBo" value="<?php echo e(old('MaCanBo')); ?>" placeholder="Ví dụ: T50-15111-0531" />
								<?php $__errorArgs = ['MaCanBo'];
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
								<label for="HoVaTen"><span class="badge badge-info">2</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['HoVaTen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="HoVaTen" name="HoVaTen" value="<?php echo e(old('HoVaTen')); ?>" required />
								<?php $__errorArgs = ['HoVaTen'];
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
							<div class="form-group col-md-2">
								<label for="NamSinh"><span class="badge badge-secondary">3</span> Năm sinh</label>
								<input type="text" class="form-control <?php $__errorArgs = ['NamSinh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NamSinh" name="NamSinh" value="<?php echo e(old('NamSinh')); ?>" placeholder="yyyy" />
								<?php $__errorArgs = ['NamSinh'];
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
							<div class="form-group col-md-6">
								<label for="Email"><span class="badge badge-info">4</span> Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Email" name="Email" value="<?php echo e(old('Email')); ?>" required />
								<?php $__errorArgs = ['Email'];
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
								<label for="DienThoai"><span class="badge badge-secondary">5</span> Điện thoại</label>
								<input type="text" class="form-control <?php $__errorArgs = ['DienThoai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="DienThoai" name="DienThoai" value="<?php echo e(old('DienThoai')); ?>" />
								<?php $__errorArgs = ['DienThoai'];
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
							<div class="form-group col-md-6">
								<label for="NgayVaoLam"><span class="badge badge-secondary">6</span> Ngày vào làm</label>
								<div class="input-group">
									<input type="text" class="form-control DatePicker" id="NgayVaoLam" name="NgayVaoLam" value="<?php echo e(old('NgayVaoLam')); ?>" placeholder="dd/mm/yyyy" />
									<div class="input-group-append">
										<div class="input-group-text"><i class="fal fa-calendar"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="ChuyenNganh"><span class="badge badge-secondary">7</span> Chuyên ngành</label>
								<input type="text" class="form-control" id="ChuyenNganh" name="ChuyenNganh" value="<?php echo e(old('ChuyenNganh')); ?>" list="DSChuyenNganh" />
								<datalist id="DSChuyenNganh">
									<option value="Công nghệ phần mềm" />
									<option value="Công nghệ tri thức" />
									<option value="Hệ thống thông tin" />
									<option value="Khoa học máy tính" />
									<option value="Mạng máy tính và viễn thông" />
									<option value="Tin học" />
								</datalist>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocVi"><span class="badge badge-secondary">8</span> Học vị</label>
								<select class="custom-select" id="HocVi" name="HocVi">
									<option value="">-- Chọn học vị --</option>
									<option>Trung cấp</option>
									<option>Cao đẳng</option>
									<option>Cử nhân</option>
									<option>Cử nhân (Cao học)</option>
									<option>Kỹ sư</option>
									<option>Kỹ sư (Cao học)</option>
									<option>Thạc sĩ</option>
									<option>Thạc sĩ (Nghiên cứu sinh)</option>
									<option>Tiến sĩ</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocVi"><span class="badge badge-secondary">9</span> Năm nhận học vị</label>
								<input type="text" class="form-control" id="NamNhanHocVi" name="NamNhanHocVi" value="<?php echo e(old('NamNhanHocVi')); ?>" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocHam"><span class="badge badge-secondary">10</span> Học hàm</label>
								<select class="custom-select" id="HocHam" name="HocHam">
									<option value="">-- Chọn học hàm --</option>
									<option>Phó Giáo sư</option>
									<option>Giáo sư</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocHam"><span class="badge badge-secondary">11</span> Năm nhận học hàm</label>
								<input type="text" class="form-control" id="NamNhanHocHam" name="NamNhanHocHam" value="<?php echo e(old('NamNhanHocHam')); ?>" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="HinhAnh"><span class="badge badge-secondary">12</span> Hình ảnh đại diện</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="ChonHinh"><a href="#hinhanh">Chọn hình</a></div>
									</div>
									<input type="text" class="form-control" id="HinhAnh" name="HinhAnh" value="<?php echo e(old('HinhAnh')); ?>" readonly />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="TrangWeb"><span class="badge badge-secondary">13</span> Trang web cá nhân</label>
								<input type="text" class="form-control" id="TrangWeb" name="TrangWeb" value="<?php echo e(old('TrangWeb')); ?>" placeholder="http://www.demo.com" />
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
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.sua')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật nhân viên</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="MaCanBo_edit"><span class="badge badge-secondary">1</span> Mã cán bộ</label>
								<input type="text" class="form-control <?php $__errorArgs = ['MaCanBo_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="MaCanBo_edit" name="MaCanBo_edit" value="<?php echo e(old('MaCanBo_edit')); ?>" placeholder="Ví dụ: T50-15111-0531" />
								<?php $__errorArgs = ['MaCanBo_edit'];
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
								<label for="HoVaTen_edit"><span class="badge badge-info">2</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['HoVaTen_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="HoVaTen_edit" name="HoVaTen_edit" value="<?php echo e(old('HoVaTen_edit')); ?>" required />
								<?php $__errorArgs = ['HoVaTen_edit'];
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
							<div class="form-group col-md-2">
								<label for="NamSinh_edit"><span class="badge badge-secondary">3</span> Năm sinh</label>
								<input type="text" class="form-control <?php $__errorArgs = ['NamSinh_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NamSinh_edit" name="NamSinh_edit" value="<?php echo e(old('NamSinh_edit')); ?>" placeholder="yyyy" />
								<?php $__errorArgs = ['NamSinh_edit'];
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
							<div class="form-group col-md-6">
								<label for="Email_edit"><span class="badge badge-info">4</span> Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control <?php $__errorArgs = ['Email_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="Email_edit" name="Email_edit" value="<?php echo e(old('Email_edit')); ?>" required />
								<?php $__errorArgs = ['Email_edit'];
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
								<label for="DienThoai_edit"><span class="badge badge-secondary">5</span> Điện thoại</label>
								<input type="text" class="form-control <?php $__errorArgs = ['DienThoai_edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="DienThoai_edit" name="DienThoai_edit" value="<?php echo e(old('DienThoai_edit')); ?>" />
								<?php $__errorArgs = ['DienThoai_edit'];
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
							<div class="form-group col-md-6">
								<label for="NgayVaoLam_edit"><span class="badge badge-secondary">6</span> Ngày vào làm</label>
								<div class="input-group">
									<input type="text" class="form-control DatePicker" id="NgayVaoLam_edit" name="NgayVaoLam_edit" value="<?php echo e(old('NgayVaoLam_edit')); ?>" placeholder="dd/mm/yyyy" />
									<div class="input-group-append">
										<div class="input-group-text"><i class="fal fa-calendar"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="ChuyenNganh_edit"><span class="badge badge-secondary">7</span> Chuyên ngành</label>
								<input type="text" class="form-control" id="ChuyenNganh_edit" name="ChuyenNganh_edit" value="<?php echo e(old('ChuyenNganh_edit')); ?>" list="DSChuyenNganh_edit" />
								<datalist id="DSChuyenNganh_edit">
									<option value="Công nghệ phần mềm" />
									<option value="Công nghệ tri thức" />
									<option value="Hệ thống thông tin" />
									<option value="Khoa học máy tính" />
									<option value="Mạng máy tính và viễn thông" />
									<option value="Tin học" />
								</datalist>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocVi_edit"><span class="badge badge-secondary">8</span> Học vị</label>
								<select class="custom-select" id="HocVi_edit" name="HocVi_edit">
									<option value="">-- Chọn học vị --</option>
									<option>Trung cấp</option>
									<option>Cao đẳng</option>
									<option>Cử nhân</option>
									<option>Cử nhân (Cao học)</option>
									<option>Kỹ sư</option>
									<option>Kỹ sư (Cao học)</option>
									<option>Thạc sĩ</option>
									<option>Thạc sĩ (Nghiên cứu sinh)</option>
									<option>Tiến sĩ</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocVi_edit"><span class="badge badge-secondary">9</span> Năm nhận học vị</label>
								<input type="text" class="form-control" id="NamNhanHocVi_edit" name="NamNhanHocVi_edit" value="<?php echo e(old('NamNhanHocVi_edit')); ?>" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocHam_edit"><span class="badge badge-secondary">10</span> Học hàm</label>
								<select class="custom-select" id="HocHam_edit" name="HocHam_edit">
									<option value="">-- Chọn học hàm --</option>
									<option>Phó Giáo sư</option>
									<option>Giáo sư</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocHam_edit"><span class="badge badge-secondary">11</span> Năm nhận học hàm</label>
								<input type="text" class="form-control" id="NamNhanHocHam_edit" name="NamNhanHocHam_edit" value="<?php echo e(old('NamNhanHocHam_edit')); ?>" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="HinhAnh_edit"><span class="badge badge-secondary">12</span> Hình ảnh đại diện</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="ChonHinh_edit"><a href="#hinhanh">Chọn hình</a></div>
									</div>
									<input type="text" class="form-control" id="HinhAnh_edit" name="HinhAnh_edit" value="<?php echo e(old('HinhAnh_edit')); ?>" readonly />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="TrangWeb_edit"><span class="badge badge-secondary">13</span> Trang web cá nhân</label>
								<input type="text" class="form-control" id="TrangWeb_edit" name="TrangWeb_edit" value="<?php echo e(old('TrangWeb_edit')); ?>" placeholder="http://www.demo.com" />
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
	
	<form action="<?php echo e(route('admin.danhmuc.nhanvien.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa nhân viên</h5>
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
	<script src="<?php echo e(asset('public/vendor/datepicker/1.9.0/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script src="<?php echo e(asset('public/vendor/datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js')); ?>"></script>
	<script src="<?php echo e(asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js')); ?>"></script>
	<script>
		$('.DatePicker').datepicker({
			format: "dd/mm/yyyy",
			weekStart: 1,
			startDate: "1/1/1960",
			endDate: "31/12/2040",
			startView: 2,
			maxViewMode: 2,
			clearBtn: true,
			language: "vi",
			todayHighlight: true
		});
		
		function escapeHtml(unsafe)
		{
			return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		var chonHinh = document.getElementById('ChonHinh');
		chonHinh.onclick = function() { selectFileWithCKFinder('HinhAnh'); };
		
		var chonHinhEdit = document.getElementById('ChonHinh_edit');
		chonHinhEdit.onclick = function() { selectFileWithCKFinder('HinhAnh_edit'); };
		
		function selectFileWithCKFinder(elementId)
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
						var output = document.getElementById(elementId);
						output.value = escapeHtml(file.get('name'));
					});
					finder.on('file:choose:resizedImage', function(evt) {
						var output = document.getElementById(elementId);
						output.value = escapeHtml(evt.data.file.get('name'));
					});
				}
			});
		}
		
		function getCapNhat(id, maCanBo, hoVaTen, namSinh, ngayVaoLam, chuyenNganh, hocVi, namNhanHocVi, hocHam, namNhanHocHam, email, dienThoai, trangWeb, hinhAnh) {
			$('#ID_edit').val(id);
			$('#MaCanBo_edit').val(maCanBo);
			$('#HoVaTen_edit').val(hoVaTen);
			$('#NamSinh_edit').val(namSinh);
			$('#NgayVaoLam_edit').val(ngayVaoLam);
			$('#ChuyenNganh_edit').val(chuyenNganh);
			$('#HocVi_edit').val(hocVi);
			$('#NamNhanHocVi_edit').val(namNhanHocVi);
			$('#HocHam_edit').val(hocHam);
			$('#NamNhanHocHam_edit').val(namNhanHocHam);
			$('#Email_edit').val(email);
			$('#DienThoai_edit').val(dienThoai);
			$('#TrangWeb_edit').val(trangWeb);
			$('#HinhAnh_edit').val(hinhAnh);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		<?php if($errors->has('MaCanBo') || $errors->has('HoVaTen') || $errors->has('NamSinh') ||  $errors->has('Email') || $errors->has('DienThoai')): ?>
			$('#myModal').modal('show');
		<?php endif; ?>
		
		<?php if($errors->has('MaCanBo_edit') || $errors->has('HoVaTen_edit') || $errors->has('NamSinh_edit') || $errors->has('Email_edit') || $errors->has('DienThoai_edit')): ?>
			$('#myModalEdit').modal('show');
		<?php endif; ?>
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/danhmuc/nhanvien.blade.php ENDPATH**/ ?>