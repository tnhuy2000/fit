@extends('layouts.admin')

@section('pagetitle')
	Trình chiếu
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Trình chiếu</div>
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
					@foreach($cms_trinhchieu as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td class="text-center"><img src="{{ $path . $value->HinhAnh }}" width="100" /></td>
							<td class="small">
								@if(!empty($value->TieuDe))
									<span class="d-block"><strong>Lớn</strong>: {{ $value->TieuDe }}</span>
								@endif
								@if(!empty($value->TieuDeNho))
									<span class="d-block"><strong>Nhỏ</strong>: {{ $value->TieuDeNho }}</span>
								@endif
							</td>
							<td class="small">
								@if(!empty($value->TenLienKet1))
									<span class="d-block"><strong>{{ $value->TenLienKet1 }}</strong>: {{ $value->LienKet1 }}</span>
								@endif
								@if(!empty($value->TenLienKet2))
									<span class="d-block"><strong>{{ $value->TenLienKet2 }}</strong>: {{ $value->LienKet2 }}</span>
								@endif
							</td>
							<td>{{ $value->ThuTuHienThi }}</td>
							<td class="text-center">
								@if($value->KichHoat == 1)
									<a href="{{ route('admin.danhmuc.mainslide.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								@else
									<a href="{{ route('admin.danhmuc.mainslide.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TieuDe }}', '{{ $value->TieuDeNho }}', '{{ $value->HinhAnh }}', '{{ $value->TenLienKet1 }}', '{{ $value->LienKet1 }}', '{{ $value->TenLienKet2 }}', '{{ $value->LienKet2 }}', {{ $value->ThuTuHienThi }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.mainslide.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TieuDe"><span class="badge badge-secondary">1</span> Tiêu đề lớn</label>
								<input type="text" class="form-control @error('TieuDe') is-invalid @enderror" id="TieuDe" name="TieuDe" value="{{ old('TieuDe') }}" />
								@error('TieuDe')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TieuDeNho"><span class="badge badge-secondary">2</span> Tiêu đề nhỏ</label>
								<input type="text" class="form-control @error('TieuDeNho') is-invalid @enderror" id="TieuDeNho" name="TieuDeNho" value="{{ old('TieuDeNho') }}" />
								@error('TieuDeNho')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="HinhAnh"><span class="badge badge-info">3</span> Hình ảnh trình chiếu <span class="text-danger font-weight-bold">*</span></label>
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TenLienKet1"><span class="badge badge-secondary">4</span> Tên liên kết 1</label>
								<input type="text" class="form-control @error('TenLienKet1') is-invalid @enderror" id="TenLienKet1" name="TenLienKet1" value="{{ old('TenLienKet1') }}" />
								@error('TenLienKet1')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet1"><span class="badge badge-secondary">5</span> Liên kết 1</label>
								<input type="text" class="form-control @error('LienKet1') is-invalid @enderror" id="LienKet1" name="LienKet1" value="{{ old('LienKet1') }}" />
								@error('LienKet1')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TenLienKet2"><span class="badge badge-secondary">6</span> Tên liên kết 2</label>
								<input type="text" class="form-control @error('TenLienKet2') is-invalid @enderror" id="TenLienKet2" name="TenLienKet2" value="{{ old('TenLienKet2') }}" />
								@error('TenLienKet2')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet2"><span class="badge badge-secondary">7</span> Liên kết 2</label>
								<input type="text" class="form-control @error('LienKet2') is-invalid @enderror" id="LienKet2" name="LienKet2" value="{{ old('LienKet2') }}" />
								@error('LienKet2')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi"><span class="badge badge-secondary">8</span> Thứ tự hiển thị</label>
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
	
	<form action="{{ route('admin.danhmuc.mainslide.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin slider</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TieuDe_edit"><span class="badge badge-secondary">1</span> Tiêu đề lớn</label>
								<input type="text" class="form-control @error('TieuDe_edit') is-invalid @enderror" id="TieuDe_edit" name="TieuDe_edit" value="{{ old('TieuDe_edit') }}" />
								@error('TieuDe_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TieuDeNho_edit"><span class="badge badge-secondary">2</span> Tiêu đề nhỏ</label>
								<input type="text" class="form-control @error('TieuDeNho_edit') is-invalid @enderror" id="TieuDeNho_edit" name="TieuDeNho_edit" value="{{ old('TieuDeNho_edit') }}" />
								@error('TieuDeNho_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="HinhAnh_edit"><span class="badge badge-info">3</span> Hình ảnh trình chiếu <span class="text-danger font-weight-bold">*</span></label>
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TenLienKet1_edit"><span class="badge badge-secondary">4</span> Tên liên kết 1</label>
								<input type="text" class="form-control @error('TenLienKet1_edit') is-invalid @enderror" id="TenLienKet1_edit" name="TenLienKet1_edit" value="{{ old('TenLienKet1_edit') }}" />
								@error('TenLienKet1_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet1_edit"><span class="badge badge-secondary">5</span> Liên kết 1</label>
								<input type="text" class="form-control @error('LienKet1_edit') is-invalid @enderror" id="LienKet1_edit" name="LienKet1_edit" value="{{ old('LienKet1_edit') }}" />
								@error('LienKet1_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="TenLienKet2_edit"><span class="badge badge-secondary">6</span> Tên liên kết 2</label>
								<input type="text" class="form-control @error('TenLienKet2_edit') is-invalid @enderror" id="TenLienKet2_edit" name="TenLienKet2_edit" value="{{ old('TenLienKet2_edit') }}" />
								@error('TenLienKet2_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet2_edit"><span class="badge badge-secondary">7</span> Liên kết 2</label>
								<input type="text" class="form-control @error('LienKet2_edit') is-invalid @enderror" id="LienKet2_edit" name="LienKet2_edit" value="{{ old('LienKet2_edit') }}" />
								@error('LienKet2_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi_edit"><span class="badge badge-secondary">8</span> Thứ tự hiển thị</label>
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
	
	<form action="{{ route('admin.danhmuc.mainslide.xoa') }}" method="post">
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
		function getCapNhat(id, tieuDe, tieuDeNho, hinhAnh, tenLienKet1, lienKet1, tenLienKet2, lienKet2, thuTuHienThi) {
			$('#ID_edit').val(id);
			$('#TieuDe_edit').val(tieuDe);
			$('#TieuDeNho_edit').val(tieuDeNho);
			$('#HinhAnh_edit').val(hinhAnh);
			$('#TenLienKet1_edit').val(tenLienKet1);
			$('#LienKet1_edit').val(lienKet1);
			$('#TenLienKet2_edit').val(tenLienKet2);
			$('#LienKet2_edit').val(lienKet2);
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
		
		@if($errors->has('TieuDe') || $errors->has('TieuDeNho') || $errors->has('HinhAnh') || $errors->has('TenLienKet1') || $errors->has('LienKet1') || $errors->has('TenLienKet2') || $errors->has('LienKet2') || $errors->has('ThuTuHienThi'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('TieuDe_edit') || $errors->has('TieuDeNho_edit') || $errors->has('HinhAnh_edit') || $errors->has('TenLienKet1_edit') || $errors->has('LienKet1_edit') || $errors->has('TenLienKet2_edit') || $errors->has('LienKet2_edit') || $errors->has('ThuTuHienThi_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection