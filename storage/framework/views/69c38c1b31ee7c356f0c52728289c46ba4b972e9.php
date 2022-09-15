

<?php $__env->startSection('meta'); ?>
	<meta property="og:image" content="<?php echo e(asset('public/frontend/images/share.png')); ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="<?php echo e($cms_baiviet->TieuDe); ?>" />
	<meta property="og:description" content="Nhấn vào để xem thông tin chi tiết về bài viết <?php echo e($cms_baiviet->TieuDe); ?>." />
	<meta name="description" content="Nhấn vào để xem thông tin chi tiết về bài viết <?php echo e($cms_baiviet->TieuDe); ?>." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', $cms_baiviet->TieuDe); ?>

<?php $__env->startSection('content'); ?>
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="<?php echo e(route('home')); ?>"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li><a href="<?php echo e(route('baiviet')); ?>"><i class="fal fa-newspaper"></i> Bài viết</a></li>
					<li class="active"><a href="<?php echo e(route('baiviet.chude',['chuDe' => $cms_baiviet->CMS_ChuDe->TenChuDeKhongDau])); ?>"><i class="fal fa-tag"></i> <?php echo e($cms_baiviet->CMS_ChuDe->TenChuDe); ?></a></li>
				</ul>
			</div>
			<div class="page-title-small">
				<h1 class="text-justify"><?php echo e($cms_baiviet->TieuDe); ?></h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="sidebar-right p-t-10 p-b-30">
		<div class="container">
			<div class="row">
				<div class="content col-lg-9">
					<div id="blog" class="single-post">
						<div class="post-item">
							<div class="post-item-wrap">
								<div class="post-item-description">
									<div class="post-meta">
										<span class="post-meta-date"><i class="fal fa-calendar-alt"></i><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cms_baiviet->created_at)->format('d/m/Y')); ?></span>
										<span class="post-meta-comments"><i class="fal fa-eye"></i><?php echo e($cms_baiviet->LuotXem); ?> lượt xem</span>
									</div>
									<?php if(!empty($cms_baiviet->TomTat)): ?>
										<p class="text-justify"><strong><?php echo $cms_baiviet->TomTat; ?></strong></p>
									<?php endif; ?>
									<?php echo $cms_baiviet->NoiDung; ?>

									<?php if($cms_baiviet_vanban && count($cms_baiviet_vanban) > 0): ?>
										<p><strong>Tập tin đính kèm bài viết:</strong></p>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-sm">
												<thead>
													<tr>
														<th width="5%">#</th>
														<th width="70%">Tên tài liệu</th>
														<th width="15%">Lượt tải</th>
														<th width="10%">Tải về</th>
													</tr>
												</thead>
												<tbody>
													<?php $__currentLoopData = $cms_baiviet_vanban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr>
															<td><?php echo e($loop->iteration); ?></td>
															<td><?php echo e($value->TenVanBan); ?></td>
															<td class="text-center"><?php echo e($value->LuotDownload); ?></td>
															<td class="text-center">
																<a href="<?php echo e(route('vanban.taive')); ?>" onclick="event.preventDefault();document.getElementById('download-form-<?php echo e($value->ID); ?>').submit();"><i class="fal fa-save fa-lg"></i></a>
																<form id="download-form-<?php echo e($value->ID); ?>" action="<?php echo e(route('vanban.taive')); ?>" method="post" style="display:none;">
																	<?php echo csrf_field(); ?>
																	<input type="hidden" name="id" value="<?php echo e($value->ID); ?>" />
																</form>
															</td>
														</tr>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									<?php endif; ?>
									<?php if($cms_baiviet_nhanvien && count($cms_baiviet_nhanvien) > 0): ?>
										<p><strong>Nhân sự trực thuộc <?php echo e($cms_baiviet->TieuDe); ?>:</strong></p>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-sm">
												<thead>
													<tr>
														<th width="5%">#</th>
														<th width="35%">Họ và tên</th>
														<th width="30%">Chức vụ</th>
														<th width="30%">Chuyên ngành</th>
													</tr>
												</thead>
												<tbody>
													<?php $stt = 1; ?>
													<?php $__currentLoopData = $cms_baiviet_nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($value->HRM_NhanVien->TrangThai == 1): ?>
															<tr>
																<td><?php echo e($stt); ?></td>
																<td><a href="<?php echo e(route('nhansu.chitiet', ['hoVaTenSlug' => $value->HRM_NhanVien->HoVaTenKhongDau])); ?>"><?php echo e($value->HRM_NhanVien->HoVaTen); ?></a></td>
																<td><?php echo e($value->HRM_ChucVu->TenChucVu); ?></td>
																<td><?php echo e($value->HRM_NhanVien->ChuyenNganh); ?></td>
															</tr>
															<?php $stt++; ?>
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</tbody>
											</table>
										</div>
									<?php endif; ?>
								</div>
								<div class="post-navigation">
									<?php if($cms_baiviet_truoc): ?>
										<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $cms_baiviet_truoc->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_baiviet_truoc->TieuDeKhongDau . '-' . $cms_baiviet_truoc->ID . '.html'])); ?>" class="post-prev">
											<div class="post-prev-title"><span>Bài trước</span><?php echo e(Str::limit($cms_baiviet_truoc->TieuDe, 30)); ?></div>
										</a>
									<?php endif; ?>
									<a href="<?php echo e(route('baiviet.chude',['chuDe' => $cms_baiviet->CMS_ChuDe->TenChuDeKhongDau])); ?>" class="post-all">
										<i class="icon-grid"></i>
									</a>
									<?php if($cms_baiviet_sau): ?>
										<a href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $cms_baiviet_sau->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_baiviet_sau->TieuDeKhongDau . '-' . $cms_baiviet_sau->ID . '.html'])); ?>" class="post-next">
											<div class="post-next-title"><span>Bài sau</span><?php echo e(Str::limit($cms_baiviet_sau->TieuDe, 30)); ?></div>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar sticky-sidebar col-lg-3">
					<div class="widget widget-categories">
						<h4 class="widget-title">Chuyên mục</h4>
						<ul class="list list-arrow-icons">
							<?php $__currentLoopData = $cms_chude_thongke; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a href="<?php echo e(route('baiviet.chude', ['chuDe' => $value->TenChuDeKhongDau])); ?>"><i class="fal fa-tag"></i> <?php echo e($value->TenChuDe); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<div class="widget">
						<h4 class="widget-title">Tin liên quan</h4>
						<div class="post-thumbnail-list">
							<?php $__currentLoopData = $cms_baiviet_lq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="post-thumbnail-entry">
									<img src="<?php echo e($cms_baiviet_lq_first_file[$value->ID]); ?>" />
									<div class="post-thumbnail-content">
										<a class="text-justify" href="<?php echo e(route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html'])); ?>"><?php echo e($value->TieuDe); ?></a>
										<span class="post-date"><i class="fal fa-calendar-alt"></i> <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y')); ?></span>
										<span class="post-category"><i class="fal fa-eye"></i> <?php echo e($value->LuotXem); ?> lượt xem</span>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_ARTICLE')); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_ARTICLE')); ?>', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\fit\resources\views/frontend/baiviet-chitiet.blade.php ENDPATH**/ ?>