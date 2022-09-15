@extends('layouts.admin')

@section('pagetitle')
	Liên kết ngoài
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Liên kết ngoài</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="40%">Tiêu đề</th>
						<th width="35%">Liên kết</th>
						<th width="5%" title="Thứ tự hiển thị">TT</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms_lienketngoai as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->TenLienKet }}</td>
							<td>{{ $value->LienKet }}</td>
							<td>{{ $value->ThuTuHienThi }}</td>
							<td class="text-center">
								@if($value->KichHoat == 1)
									<a href="{{ route('admin.danhmuc.lienketngoai.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								@else
									<a href="{{ route('admin.danhmuc.lienketngoai.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TenLienKet }}', '{{ $value->LienKet }}', {{ $value->ThuTuHienThi }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.lienketngoai.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm liên kết ngoài</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenLienKet"><span class="badge badge-info">1</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label></label>
							<input type="text" class="form-control @error('TenLienKet') is-invalid @enderror" id="TenLienKet" name="TenLienKet" value="{{ old('TenLienKet') }}" required />
							@error('TenLienKet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="LienKet"><span class="badge badge-info">2</span> Liên kết <span class="text-danger font-weight-bold">*</span></label></label>
							<input type="text" class="form-control @error('LienKet') is-invalid @enderror" id="LienKet" name="LienKet" value="{{ old('LienKet') }}" required />
							@error('LienKet')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi"><span class="badge badge-secondary">3</span> Thứ tự hiển thị</label>
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
	
	<form action="{{ route('admin.danhmuc.lienketngoai.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật liên kết ngoài</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenLienKet_edit"><span class="badge badge-info">1</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label></label>
							<input type="text" class="form-control @error('TenLienKet_edit') is-invalid @enderror" id="TenLienKet_edit" name="TenLienKet_edit" value="{{ old('TenLienKet_edit') }}" required />
							@error('TenLienKet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="LienKet_edit"><span class="badge badge-info">2</span> Liên kết <span class="text-danger font-weight-bold">*</span></label></label>
							<input type="text" class="form-control @error('LienKet_edit') is-invalid @enderror" id="LienKet_edit" name="LienKet_edit" value="{{ old('LienKet_edit') }}" required />
							@error('LienKet_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="ThuTuHienThi_edit"><span class="badge badge-secondary">3</span> Thứ tự hiển thị</label>
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
	
	<form action="{{ route('admin.danhmuc.lienketngoai.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa liên kết ngoài</h5>
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
	<script>
		function getCapNhat(id, tieuDe, lienKet, thuTuHienThi) {
			$('#ID_edit').val(id);
			$('#TenLienKet_edit').val(tieuDe);
			$('#LienKet_edit').val(lienKet);
			$('#ThuTuHienThi_edit').val(thuTuHienThi);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('TenLienKet') || $errors->has('LienKet') || $errors->has('ThuTuHienThi'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('TenLienKet_edit') || $errors->has('LienKet_edit') || $errors->has('ThuTuHienThi_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection