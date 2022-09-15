@extends('layouts.admin')

@section('pagetitle')
	Hướng dẫn sau đại học
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hosonhanvien.home') }}">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Hướng dẫn sau đại học</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="60%">Thông tin hướng dẫn</th>
						<th width="15%">Năm hướng dẫn</th>
						<th width="10%">Năm bảo vệ</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_huongdansaudaihoc as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<span class="text-primary font-weight-bold d-block">{{ $value->HoTenHocVien }}</span>
								<span class="d-block">Đề tài: <strong>{{ $value->TenDeTai }}</strong></span>
								@if(!empty($value->TrinhDo))
									<span class="d-block">Trình độ: <strong>{{ $value->TrinhDo }}</strong></span>
								@endif
								@if(!empty($value->CoSoDaoTao))
									<span class="d-block">Cơ sở đào tạo: <strong>{{ $value->CoSoDaoTao }}</strong></span>
								@endif
							</td>
							<td>{{ $value->NamHuongDan }}</td>
							<td>{{ $value->NamBaoVe }}</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->HoTenHocVien }}', '{{ addslashes($value->TenDeTai) }}', '{{ $value->TrinhDo }}', '{{ addslashes($value->CoSoDaoTao) }}', '{{ $value->NamHuongDan }}', '{{ $value->NamBaoVe }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.hosonhanvien.huongdansaudaihoc.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm thông tin hướng dẫn</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="HoTenHocVien"><span class="badge badge-info">1</span> Họ và tên học viên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('HoTenHocVien') is-invalid @enderror" id="HoTenHocVien" name="HoTenHocVien" value="{{ old('HoTenHocVien') }}" required />
							@error('HoTenHocVien')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="TenDeTai"><span class="badge badge-info">2</span> Tên đề tài hướng dẫn <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenDeTai') is-invalid @enderror" id="TenDeTai" name="TenDeTai" value="{{ old('TenDeTai') }}" required />
							@error('TenDeTai')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="TrinhDo"><span class="badge badge-info">3</span> Trình độ <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select @error('TrinhDo') is-invalid @enderror" id="TrinhDo" name="TrinhDo" required>
								<option value="">-- Chọn trình độ --</option>
								<option selected>Thạc sĩ</option>
								<option>Tiến sĩ</option>
							</select>
							@error('TrinhDo')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="CoSoDaoTao"><span class="badge badge-info">4</span> Cơ sở đào tạo <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('CoSoDaoTao') is-invalid @enderror" id="CoSoDaoTao" name="CoSoDaoTao" value="{{ old('CoSoDaoTao') }}" required />
							@error('CoSoDaoTao')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="NamHuongDan"><span class="badge badge-info">5</span> Năm hướng dẫn <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamHuongDan') is-invalid @enderror" id="NamHuongDan" name="NamHuongDan" value="{{ old('NamHuongDan') }}" placeholder="YYYY" required />
								@error('NamHuongDan')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="NamBaoVe"><span class="badge badge-secondary">6</span> Năm bảo vệ</label>
								<input type="text" class="form-control" id="NamBaoVe" name="NamBaoVe" value="{{ old('NamBaoVe') }}" placeholder="YYYY" />
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
	
	<form action="{{ route('admin.hosonhanvien.huongdansaudaihoc.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin hướng dẫn</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="HoTenHocVien_edit"><span class="badge badge-info">1</span> Họ và tên học viên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('HoTenHocVien_edit') is-invalid @enderror" id="HoTenHocVien_edit" name="HoTenHocVien_edit" value="{{ old('HoTenHocVien_edit') }}" required />
							@error('HoTenHocVien_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="TenDeTai_edit"><span class="badge badge-info">2</span> Tên đề tài hướng dẫn <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenDeTai_edit') is-invalid @enderror" id="TenDeTai_edit" name="TenDeTai_edit" value="{{ old('TenDeTai_edit') }}" required />
							@error('TenDeTai_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="TrinhDo_edit"><span class="badge badge-info">3</span> Trình độ <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select @error('TrinhDo_edit') is-invalid @enderror" id="TrinhDo_edit" name="TrinhDo_edit" required>
								<option value="">-- Chọn trình độ --</option>
								<option>Thạc sĩ</option>
								<option>Tiến sĩ</option>
							</select>
							@error('TrinhDo_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="CoSoDaoTao_edit"><span class="badge badge-info">4</span> Cơ sở đào tạo <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('CoSoDaoTao_edit') is-invalid @enderror" id="CoSoDaoTao_edit" name="CoSoDaoTao_edit" value="{{ old('CoSoDaoTao_edit') }}" required />
							@error('CoSoDaoTao_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="NamHuongDan_edit"><span class="badge badge-info">5</span> Năm hướng dẫn <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamHuongDan_edit') is-invalid @enderror" id="NamHuongDan_edit" name="NamHuongDan_edit" value="{{ old('NamHuongDan_edit') }}" placeholder="YYYY" required />
								@error('NamHuongDan_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="NamBaoVe_edit"><span class="badge badge-secondary">6</span> Năm bảo vệ</label>
								<input type="text" class="form-control" id="NamBaoVe_edit" name="NamBaoVe_edit" value="{{ old('NamBaoVe_edit') }}" placeholder="YYYY" />
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
	
	<form action="{{ route('admin.hosonhanvien.huongdansaudaihoc.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa thông tin hướng dẫn</h5>
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
		function getCapNhat(id, tenHocVien, deTai, trinhDo, coSo, namHD, namBV) {
			$('#ID_edit').val(id);
			$('#HoTenHocVien_edit').val(tenHocVien);
			$('#TenDeTai_edit').val(deTai);
			$('#TrinhDo_edit').val(trinhDo);
			$('#CoSoDaoTao_edit').val(coSo);
			$('#NamHuongDan_edit').val(namHD);
			$('#NamBaoVe_edit').val(namBV);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('HoTenHocVien') || $errors->has('TenDeTai') || $errors->has('TrinhDo') || $errors->has('CoSoDaoTao') || $errors->has('NamHuongDan'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('HoTenHocVien_edit') || $errors->has('TenDeTai_edit') || $errors->has('TrinhDo_edit') || $errors->has('CoSoDaoTao_edit') || $errors->has('NamHuongDan_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection