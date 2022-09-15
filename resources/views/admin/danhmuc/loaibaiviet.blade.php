@extends('layouts.admin')

@section('pagetitle')
	Danh sách loại bài viết
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách loại bài viết</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="85%">Loại bài viết</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms_loaibaiviet as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->TenLoai }}</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->TenLoai }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.loaibaiviet.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm loại bài viết</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenLoai"><span class="badge badge-info">1</span> Tên loại bài viết <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenLoai') is-invalid @enderror" id="TenLoai" name="TenLoai" value="{{ old('TenLoai') }}" required />
							@error('TenLoai')
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
	
	<form action="{{ route('admin.danhmuc.loaibaiviet.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật loại bài viết</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="TenLoai_edit"><span class="badge badge-info">1</span> Tên loại bài viết <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenLoai_edit') is-invalid @enderror" id="TenLoai_edit" name="TenLoai_edit" value="{{ old('TenLoai_edit') }}" required />
							@error('TenLoai_edit')
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
	
	<form action="{{ route('admin.danhmuc.loaibaiviet.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa loại bài viết</h5>
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
		function getCapNhat(id, tenChuDe) {
			$('#ID_edit').val(id);
			$('#TenLoai_edit').val(tenChuDe);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@error('TenLoai')
			$('#myModal').modal('show');
		@enderror
		
		@error('TenLoai_edit')
			$('#myModalEdit').modal('show');
		@enderror
	</script>
@endsection