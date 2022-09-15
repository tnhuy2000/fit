@extends('layouts.admin')

@section('pagetitle')
	Cập nhật đính kèm cho {{ $cms_baiviet->TieuDe }}
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.danhsach') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Cập nhật đính kèm cho {{ $cms_baiviet->TieuDe }}</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="35%">Tên văn bản</th>
						<th width="35%">Tập tin</th>
						<th width="10%">Lượt tải</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms_vanban as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								{{ $value->TenVanBan }}<br />
								<span class="small"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $value->TenVanBanKhongDau }}</span></span>
							</td>
							<td><i class="fal fa-file"></i> {{ $value->DuongDan }}</td>
							<td>{{ $value->LuotDownload }}</td>
							<td class="text-center">
								@if($value->KichHoat == 1)
									<a href="{{ route('admin.baiviet.vanban.kichhoat', ['idBaiViet' => $cms_baiviet->ID, 'id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								@else
									<a href="{{ route('admin.baiviet.vanban.kichhoat', ['idBaiViet' => $cms_baiviet->ID, 'id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TenVanBan }}', '{{ $value->DuongDan }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.baiviet.vanban.them') }}" method="post">
		@csrf
		<input type="hidden" id="MaBaiViet" name="MaBaiViet" value="{{ $cms_baiviet->ID }}" />
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm văn bản</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenVanBan"><span class="badge badge-info">1</span> Tên văn bản <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenVanBan') is-invalid @enderror" id="TenVanBan" name="TenVanBan" value="{{ old('TenVanBan') }}" required />
							@error('TenVanBan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="DuongDan"><span class="badge badge-info">2</span> Đường dẫn <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" id="ChonTapTin"><a href="#taptin">Chọn tập tin</a></div>
								</div>
								<input type="text" class="form-control @error('DuongDan') is-invalid @enderror" id="DuongDan" name="DuongDan" readonly required />
							</div>
							@error('DuongDan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.baiviet.vanban.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<input type="hidden" id="MaBaiViet_edit" name="MaBaiViet_edit" value="{{ $cms_baiviet->ID }}" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật văn bản</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenVanBan_edit"><span class="badge badge-info">1</span> Tên văn bản <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenVanBan_edit') is-invalid @enderror" id="TenVanBan_edit" name="TenVanBan_edit" required />
							@error('TenVanBan_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="DuongDan_edit"><span class="badge badge-info">2</span> Đường dẫn <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" id="ChonTapTin_edit"><a href="#taptin">Chọn tập tin</a></div>
								</div>
								<input type="text" class="form-control @error('DuongDan_edit') is-invalid @enderror" id="DuongDan_edit" name="DuongDan_edit" readonly required />
							</div>
							@error('DuongDan_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.baiviet.vanban.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<input type="hidden" id="MaBaiViet_delete" name="MaBaiViet_delete" value="{{ $cms_baiviet->ID }}" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa văn bản</h5>
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
		function escapeHtml(unsafe)
		{
			return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		var chonTapTin = document.getElementById('ChonTapTin');
		chonTapTin.onclick = function() { selectFileWithCKFinder('DuongDan'); };
		
		var chonTapTinEdit = document.getElementById('ChonTapTin_edit');
		chonTapTinEdit.onclick = function() { selectFileWithCKFinder('DuongDan_edit'); };
		
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
		
		function getCapNhat(id, tenVanVan, duongDan) {
			$('#ID_edit').val(id);
			$('#TenVanBan_edit').val(tenVanVan);
			$('#DuongDan_edit').val(duongDan);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('TenVanBan') || $errors->has('DuongDan'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('TenVanBan_edit') || $errors->has('DuongDan_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection