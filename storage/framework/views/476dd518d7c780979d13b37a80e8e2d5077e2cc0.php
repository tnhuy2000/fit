

<?php $__env->startSection('pagetitle'); ?>
	Danh sách bài viết
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="card">
		<div class="card-header"><a href="<?php echo e(route('admin.home')); ?>">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="<?php echo e(route('admin.baiviet.home')); ?>">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Danh sách bài viết</div>
		<div class="card-body">
			<p><a href="<?php echo e(route('admin.baiviet.them')); ?>" class="btn btn-primary"><i class="fal fa-plus"></i> Thêm</a></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="4%">#</th>
						<th width="15%">Chủ đề</th>
						<th width="65%">Thông tin bài viết</th>
						<th width="4%" title="Bài viết quan trọng">Top</th>
						<th width="4%">O/F</th>
						<th width="4%">Sửa</th>
						<th width="4%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $cms_baiviet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($value->CMS_ChuDe->TenChuDe); ?></td>
							<td class="text-justify">
								<span class="font-weight-bold text-primary"><a href="<?php echo e(route('admin.baiviet.sua', ['id' => $value->ID])); ?>"><?php echo e($value->TieuDe); ?></a></span>
								<span class="small">
									<?php if(!empty($value->CMS_LoaiBaiViet->TenLoai)): ?>
										<br />Loại bài viết: <?php echo e($value->CMS_LoaiBaiViet->TenLoai); ?>

										<?php if($value->MaLoai == 2): ?>
											(<a href="<?php echo e(route('admin.baiviet.vanban', ['id' => $value->ID])); ?>">Chỉnh sửa văn bản</a>)
										<?php endif; ?>
									<?php endif; ?>
									<?php if(!empty($value->created_at)): ?>
										<br />Ngày đăng: <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s')); ?>

									<?php endif; ?>
									<?php if(!empty($value->MaNguoiDung)): ?>
										<br />Người đăng: <?php echo e($value->SYS_NguoiDung->name); ?>

									<?php endif; ?>
									<?php if(!empty($value->LuotXem)): ?>
										<br />Có <?php echo e($value->LuotXem); ?> lượt xem
									<?php endif; ?>
								</span>
							</td>
							<td class="text-center">
								<?php if($value->QuanTrong == 1): ?>
									<a href="<?php echo e(route('admin.baiviet.quantrong', ['id' => $value->ID])); ?>"><i class="fal fa-check-circle" title="Bài viết quan trọng"></i></a>
								<?php else: ?>
									<a href="<?php echo e(route('admin.baiviet.quantrong', ['id' => $value->ID])); ?>"><i class="fal fa-ban text-danger" title="Bài viết bình thường"></i></a>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<?php if($value->KichHoat == 1): ?>
									<a href="<?php echo e(route('admin.baiviet.kichhoat', ['id' => $value->ID])); ?>"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								<?php else: ?>
									<a href="<?php echo e(route('admin.baiviet.kichhoat', ['id' => $value->ID])); ?>"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								<?php endif; ?>
							</td>
							<td class="text-center"><a href="<?php echo e(route('admin.baiviet.sua', ['id' => $value->ID])); ?>"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa(<?php echo e($value->ID); ?>); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="<?php echo e(route('admin.baiviet.xoa')); ?>" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa bài viết</h5>
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
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\wamp64\www\fit\resources\views/admin/baiviet/danhsach.blade.php ENDPATH**/ ?>