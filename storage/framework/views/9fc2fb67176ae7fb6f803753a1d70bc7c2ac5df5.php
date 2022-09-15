

<?php $__env->startSection('pagetitle'); ?>
	Danh sách hình ảnh
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.hinhanh.home')); ?>">Quản lý hình ảnh</a> <i class="fal fa-angle-double-right"></i> Danh sách hình ảnh</div>
		<div class="card-body">
			<p><a href="<?php echo e(route('admin.hinhanh.them')); ?>" class="btn btn-primary"><i class="fal fa-plus"></i> Thêm</a></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="20%">Chủ đề</th>
						<th width="60%">Thông tin hình ảnh</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $cms_hinhanh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($value->CMS_ChuDe->TenChuDe); ?></td>
							<td class="text-justify">
								<span class="font-weight-bold text-primary"><a href="<?php echo e(route('admin.hinhanh.sua', ['id' => $value->ID])); ?>"><?php echo e($value->MoTa); ?></a></span>
								<span class="small">
									<?php if(!empty($value->created_at)): ?>
										<br />Ngày đăng: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s')); ?>

									<?php endif; ?>
									<?php if(!empty($value->LuotXem)): ?>
										<br />Có <?php echo e($value->LuotXem); ?> lượt xem
									<?php endif; ?>
									<?php if(!empty($value->MaNguoiDung)): ?>
										<br />Người đăng: <?php echo e($value->SYS_NguoiDung->name); ?>

									<?php endif; ?>
									<?php if(!empty($value->ThuMuc)): ?>
										<br />Hình ảnh: <a href="#hinhanh" onclick="getXemHinh(<?php echo e($value->ID); ?>)"><?php echo e($value->ThuMuc); ?></a>
									<?php endif; ?>
								</span>
							</td>
							<td class="text-center">
								<?php if($value->KichHoat == 1): ?>
									<a href="<?php echo e(route('admin.hinhanh.kichhoat', ['id' => $value->ID])); ?>"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								<?php else: ?>
									<a href="<?php echo e(route('admin.hinhanh.kichhoat', ['id' => $value->ID])); ?>"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								<?php endif; ?>
							</td>
							<td class="text-center"><a href="<?php echo e(route('admin.hinhanh.sua', ['id' => $value->ID])); ?>"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->ID); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.hinhanh.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa hình ảnh</h5>
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
	<script src="<?php echo e(asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js')); ?>"></script>
	<script>
		function getXemHinh(id) {
			$.ajax({
				url: '<?php echo e(route("admin.hinhanh.ajax")); ?>',
				method: 'POST',
				data: { _token: '<?php echo e(csrf_token()); ?>', id: id },
				dataType: 'text',
				success: function(data) {
					CKFinder.modal(
					{
						displayFoldersPanel: false,
						width: 800,
						height: 500
					});
				}
			});
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/admin/hinhanh/danhsach.blade.php ENDPATH**/ ?>