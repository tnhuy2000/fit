@extends('layouts.admin')

@section('pagetitle')
	Trình chiếu cơ bản
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Trình chiếu cơ bản</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Hình ảnh</th>
						<th width="30%">Tiêu đề</th>
						<th width="35%">Liên kết</th>
						<th width="5%" title="Thứ tự hiển thị">TT</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms_trinhchieu_mini as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td class="text-center"><img src="{{ $path . $value->HinhAnh }}" width="100" /></td>
							<td>{{ $value->TieuDe }}</td>
							<td>{{ $value->LienKet }}</td>
							<td>{{ $value->ThuTuHienThi }}</td>
							<td class="text-center">
								@if($value->KichHoat == 1)
									<a href="{{ route('admin.danhmuc.slide.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								@else
									<a href="{{ route('admin.danhmuc.slide.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TieuDe }}', '{{ $value->HinhAnh }}', '{{ $value->LienKet }}', {{ $value->ThuTuHienThi }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.slide.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TieuDe"><span class="badge badge-secondary">1</span> Tiêu đề</label>
							<input type="text" class="form-control @error('TieuDe') is-invalid @enderror" id="TieuDe" name="TieuDe" value="{{ old('TieuDe') }}" />
							@error('TieuDe')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="HinhAnh"><span class="badge badge-info">2</span> Hình ảnh trình chiếu <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" id="ChonHinh"><a href="#hinhanh">Tải ảnh lên</a></div>
								</div>
								<input type="text" class="form-control @error('HinhAnh') is-invalid @enderror" id="HinhAnh" name="HinhAnh" value="{{ old('HinhAnh') }}" readonly required />
								@error('HinhAnh')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="LienKet"><span class="badge badge-secondary">3</span> Liên kết</label>
							<input type="text" class="form-control @error('LienKet') is-invalid @enderror" id="LienKet" name="LienKet" value="{{ old('LienKet') }}" />
							@error('LienKet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi"><span class="badge badge-secondary">4</span> Thứ tự hiển thị</label>
							<input type="text" class="form-control @error('ThuTuHienThi') is-invalid @enderror" id="ThuTuHienThi" name="ThuTuHienThi" value="1" />
							@error('ThuTuHienThi')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.danhmuc.slide.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TieuDe_edit"><span class="badge badge-secondary">1</span> Tiêu đề</label>
							<input type="text" class="form-control @error('TieuDe_edit') is-invalid @enderror" id="TieuDe_edit" name="TieuDe_edit" value="{{ old('TieuDe_edit') }}" />
							@error('TieuDe_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="HinhAnh_edit"><span class="badge badge-info">2</span> Hình ảnh trình chiếu <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" id="ChonHinh_edit"><a href="#hinhanh">Tải ảnh khác</a></div>
								</div>
								<input type="text" class="form-control @error('HinhAnh_edit') is-invalid @enderror" id="HinhAnh_edit" name="HinhAnh_edit" value="{{ old('HinhAnh_edit') }}" readonly required />
								@error('HinhAnh_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="LienKet_edit"><span class="badge badge-secondary">3</span> Liên kết</label>
							<input type="text" class="form-control @error('LienKet_edit') is-invalid @enderror" id="LienKet_edit" name="LienKet_edit" value="{{ old('LienKet_edit') }}" />
							@error('LienKet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi_edit"><span class="badge badge-secondary">4</span> Thứ tự hiển thị</label>
							<input type="text" class="form-control @error('ThuTuHienThi_edit') is-invalid @enderror" id="ThuTuHienThi_edit" name="ThuTuHienThi_edit" value="{{ old('ThuTuHienThi_edit') }}" />
							@error('ThuTuHienThi_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.danhmuc.slide.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa slider</h5>
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
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		function getCapNhat(id, tieuDe, hinhAnh, lienKet, thuTuHienThi) {
			$('#ID_edit').val(id);
			$('#TieuDe_edit').val(tieuDe);
			$('#HinhAnh_edit').val(hinhAnh);
			$('#LienKet_edit').val(lienKet);
			$('#ThuTuHienThi_edit').val(thuTuHienThi);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
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
		
		@if($errors->has('TieuDe') || $errors->has('HinhAnh') || $errors->has('LienKet') || $errors->has('ThuTuHienThi'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('TieuDe_edit') || $errors->has('HinhAnh_edit') || $errors->has('LienKet_edit') || $errors->has('ThuTuHienThi_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection