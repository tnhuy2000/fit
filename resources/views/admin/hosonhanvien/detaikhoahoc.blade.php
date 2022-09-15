@extends('layouts.admin')

@section('pagetitle')
	Đề tài khoa học
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hosonhanvien.home') }}">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Đề tài khoa học</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="65%">Thông tin đề tài</th>
						<th width="10%">Nghiệm thu</th>
						<th width="10%">Hiện công khai</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_detaikhoahoc as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<span class="text-primary font-weight-bold d-block">{{ $value->TenCongTrinh }}</span>
								<span class="d-block">Cấp quản lý: <strong>{{ $value->CapQuanLy }}</strong></span>
								<span class="d-block">Chủ nhiệm: <strong>{{ $value->ChuNhiem }}</strong></span>
								@if(!empty($value->ThanhVienThamGia))
									<span class="d-block">Thành viên tham gia: <strong>{{ $value->ThanhVienThamGia }}</strong></span>
								@endif
								@if(!empty($value->LienKet))
									<span class="d-block">Xem chi tiết: <strong>{{ $value->LienKet }}</strong></span>
								@endif
							</td>
							<td>{{ $value->NamNghiemThu }}</td>
							<td class="text-center">
								@if($value->HienThiCongKhai == 1)
									<a href="{{ route('admin.hosonhanvien.detaikhoahoc.congbo', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Hiển thị công khai trong mục NCKH"></i></a>
								@else
									<a href="{{ route('admin.hosonhanvien.detaikhoahoc.congbo', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Không hiển thị"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->CapQuanLy }}', '{{ addslashes($value->TenCongTrinh) }}', '{{ $value->ChuNhiem }}', '{{ $value->ThanhVienThamGia }}', '{{ $value->NamNghiemThu }}', '{{ $value->LienKet }}', {{ $value->HienThiCongKhai }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.hosonhanvien.detaikhoahoc.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm đề tài khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="CapQuanLy"><span class="badge badge-info">1</span> Cấp quản lý <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('CapQuanLy') is-invalid @enderror" id="CapQuanLy" name="CapQuanLy" required>
									<option value="">-- Chọn loại --</option>
									<option>Sinh viên</option>
									<option>Cấp Khoa/Bộ môn/Phòng ban</option>
									<option>Cấp Trường</option>
									<option>Cấp cơ sở</option>
									<option>Cấp tỉnh</option>
									<option>Cấp ĐHQG - Loại A</option>
									<option>Cấp ĐHQG - Loại B</option>
									<option>Cấp ĐHQG - Loại C</option>
									<option>Cấp bộ/Nhà nước</option>
									<option>Dự án Quốc tế</option>
									<option>Dự án Trong nước</option>
								</select>
								@error('CapQuanLy')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TenCongTrinh"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TenCongTrinh') is-invalid @enderror" id="TenCongTrinh" name="TenCongTrinh" value="{{ old('TenCongTrinh') }}" required />
								@error('TenCongTrinh')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ChuNhiem"><span class="badge badge-info">3</span> Chủ nhiệm đề tài <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('ChuNhiem') is-invalid @enderror" id="ChuNhiem" name="ChuNhiem" value="{{ old('ChuNhiem') }}" required />
								@error('ChuNhiem')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="ThanhVienThamGia"><span class="badge badge-secondary">4</span> Thành viên tham gia</label>
								<input type="text" class="form-control" id="ThanhVienThamGia" name="ThanhVienThamGia" value="{{ old('ThanhVienThamGia') }}" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="NamNghiemThu"><span class="badge badge-info">5</span> Năm nghiệm thu <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamNghiemThu') is-invalid @enderror" id="NamNghiemThu" name="NamNghiemThu" value="{{ old('NamNghiemThu') }}" required />
								@error('NamNghiemThu')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet"><span class="badge badge-secondary">6</span> Liên kết</label>
								<input type="text" class="form-control" id="LienKet" name="LienKet" value="{{ old('LienKet') }}" />
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="HienThiCongKhai" name="HienThiCongKhai" value="1" />
								<label class="custom-control-label font-weight-bold text-danger" for="HienThiCongKhai">Cho phép hiển thị công khai trong mục NCKH.</label>
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
	
	<form action="{{ route('admin.hosonhanvien.detaikhoahoc.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật đề tài khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="CapQuanLy_edit"><span class="badge badge-info">1</span> Cấp quản lý <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('CapQuanLy_edit') is-invalid @enderror" id="CapQuanLy_edit" name="CapQuanLy_edit" required>
									<option value="">-- Chọn loại --</option>
									<option>Sinh viên</option>
									<option>Cấp Khoa/Bộ môn/Phòng ban</option>
									<option>Cấp Trường</option>
									<option>Cấp cơ sở</option>
									<option>Cấp tỉnh</option>
									<option>Cấp ĐHQG - Loại A</option>
									<option>Cấp ĐHQG - Loại B</option>
									<option>Cấp ĐHQG - Loại C</option>
									<option>Cấp bộ/Nhà nước</option>
									<option>Dự án Quốc tế</option>
									<option>Dự án Trong nước</option>
								</select>
								@error('CapQuanLy_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TenCongTrinh_edit"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TenCongTrinh_edit') is-invalid @enderror" id="TenCongTrinh_edit" name="TenCongTrinh_edit" value="{{ old('TenCongTrinh_edit') }}" required />
								@error('TenCongTrinh_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ChuNhiem_edit"><span class="badge badge-info">3</span> Chủ nhiệm đề tài <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('ChuNhiem_edit') is-invalid @enderror" id="ChuNhiem_edit" name="ChuNhiem_edit" value="{{ old('ChuNhiem_edit') }}" required />
								@error('ChuNhiem_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="ThanhVienThamGia_edit"><span class="badge badge-secondary">4</span> Thành viên tham gia</label>
								<input type="text" class="form-control" id="ThanhVienThamGia_edit" name="ThanhVienThamGia_edit" value="{{ old('ThanhVienThamGia_edit') }}" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="NamNghiemThu_edit"><span class="badge badge-info">5</span> Năm nghiệm thu <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamNghiemThu_edit') is-invalid @enderror" id="NamNghiemThu_edit" name="NamNghiemThu_edit" value="{{ old('NamNghiemThu_edit') }}" required />
								@error('NamNghiemThu_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet_edit"><span class="badge badge-secondary">6</span> Liên kết</label>
								<input type="text" class="form-control" id="LienKet_edit" name="LienKet_edit" value="{{ old('LienKet_edit') }}" />
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="HienThiCongKhai_edit" name="HienThiCongKhai_edit" value="1" />
								<label class="custom-control-label font-weight-bold text-danger" for="HienThiCongKhai_edit">Cho phép hiển thị công khai trong mục NCKH.</label>
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
	
	<form action="{{ route('admin.hosonhanvien.detaikhoahoc.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa đề tài khoa học</h5>
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
		function getCapNhat(id, capQuanLy, tenCongTrinh, chuNhiem, thanhVien, nam, lienKet, congKhai) {
			$('#ID_edit').val(id);
			$('#CapQuanLy_edit').val(capQuanLy);
			$('#TenCongTrinh_edit').val(tenCongTrinh);
			$('#ChuNhiem_edit').val(chuNhiem);
			$('#ThanhVienThamGia_edit').val(thanhVien);
			$('#NamNghiemThu_edit').val(nam);
			$('#LienKet_edit').val(lienKet);
			$('#HienThiCongKhai_edit').prop('checked', congKhai);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('CapQuanLy') || $errors->has('TenCongTrinh') || $errors->has('ChuNhiem') || $errors->has('NamNghiemThu'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('CapQuanLy_edit') || $errors->has('TenCongTrinh_edit') || $errors->has('ChuNhiem_edit') || $errors->has('NamNghiemThu_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection