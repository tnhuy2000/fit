@extends('layouts.admin')

@section('pagetitle')
	Quá trình công tác
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hosonhanvien.home') }}">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Quá trình công tác</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="20%">Thời gian</th>
						<th width="65%">Nội dung công việc</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_quatrinhcongtac as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->ThoiGian }}</td>
							<td>{{ $value->NoiDungCongViec }}</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->ThoiGian }}', '{{ addslashes($value->NoiDungCongViec) }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.hosonhanvien.quatrinhcongtac.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm quá trình công tác</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="ThoiGian"><span class="badge badge-info">1</span> Thời gian <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('ThoiGian') is-invalid @enderror" id="ThoiGian" name="ThoiGian" value="{{ old('ThoiGian') }}" required />
							@error('ThoiGian')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="NoiDungCongViec"><span class="badge badge-info">2</span> Nội dung công việc <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('NoiDungCongViec') is-invalid @enderror" id="NoiDungCongViec" name="NoiDungCongViec" value="{{ old('NoiDungCongViec') }}" required />
							@error('NoiDungCongViec')
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
	
	<form action="{{ route('admin.hosonhanvien.quatrinhcongtac.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật quá trình công tác</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="ThoiGian_edit"><span class="badge badge-info">1</span> Thời gian <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('ThoiGian_edit') is-invalid @enderror" id="ThoiGian_edit" name="ThoiGian_edit" value="{{ old('ThoiGian_edit') }}" required />
							@error('ThoiGian_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="NoiDungCongViec_edit"><span class="badge badge-info">2</span> Nội dung công việc <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('NoiDungCongViec_edit') is-invalid @enderror" id="NoiDungCongViec_edit" name="NoiDungCongViec_edit" value="{{ old('NoiDungCongViec_edit') }}" required />
							@error('NoiDungCongViec_edit')
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
	
	<form action="{{ route('admin.hosonhanvien.quatrinhcongtac.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa quá trình công tác</h5>
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
		function getCapNhat(id, thoiGian, noiDungCongViec) {
			$('#ID_edit').val(id);
			$('#ThoiGian_edit').val(thoiGian);
			$('#NoiDungCongViec_edit').val(noiDungCongViec);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('ThoiGian') || $errors->has('NoiDungCongViec'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('ThoiGian_edit') || $errors->has('NoiDungCongViec_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection