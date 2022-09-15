@extends('layouts.admin')

@section('pagetitle')
	Sách - Giáo trình - Tài liệu
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hosonhanvien.home') }}">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Sách - Giáo trình - Tài liệu</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="65%">Sách - Giáo trình - Tài liệu</th>
						<th width="10%">Năm xuất bản</th>
						<th width="10%">Hiện công khai</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_sachgiaotrinhtailieu as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<span class="text-primary font-weight-bold d-block">{{ $value->Ten }}</span>
								<span class="d-block">Phân loại: <strong>{{ $value->PhanLoai }}</strong></span>
								<span class="d-block">Tác giả: <strong>{{ $value->TacGiaNhomTacGia }}</strong></span>
								@if(!empty($value->ISBN))
									<span class="d-block">Mã số ISBN: <strong>{{ $value->ISBN }}</strong></span>
								@endif
								@if(!empty($value->NhaXuatBan))
									<span class="d-block">Nhà xuất bản: <strong>{{ $value->NhaXuatBan }}</strong></span>
								@endif
								@if(!empty($value->LienKet))
									<span class="d-block">Chi tiết: <strong>{{ $value->LienKet }}</strong></span>
								@endif
							</td>
							<td>{{ $value->NamXuatBan }}</td>
							<td class="text-center">
								@if($value->HienThiCongKhai == 1)
									<a href="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu.congbo', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Hiển thị công khai trong mục NCKH"></i></a>
								@else
									<a href="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu.congbo', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Không hiển thị"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ addslashes($value->Ten) }}', '{{ $value->PhanLoai }}', '{{ $value->TacGiaNhomTacGia }}', '{{ addslashes($value->NhaXuatBan) }}', '{{ $value->NamXuatBan }}', '{{ $value->ISBN }}', '{{ $value->LienKet }}', {{ $value->HienThiCongKhai }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm sách - giáo trình - tài liệu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="PhanLoai"><span class="badge badge-info">1</span> Phân loại <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('PhanLoai') is-invalid @enderror" id="PhanLoai" name="PhanLoai" required>
									<option value="">-- Chọn --</option>
									<option>Sách</option>
									<option>Giáo trình</option>
									<option>Tài liệu</option>
								</select>
								@error('PhanLoai')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="Ten"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('Ten') is-invalid @enderror" id="Ten" name="Ten" value="{{ old('Ten') }}" required />
								@error('Ten')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="TacGiaNhomTacGia"><span class="badge badge-info">3</span> Tác giả hoặc nhóm tác giả <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TacGiaNhomTacGia') is-invalid @enderror" id="TacGiaNhomTacGia" name="TacGiaNhomTacGia" value="{{ old('TacGiaNhomTacGia') }}" required />
							@error('TacGiaNhomTacGia')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="NhaXuatBan"><span class="badge badge-secondary">4</span> Nhà xuất bản</label>
								<input type="text" class="form-control" id="NhaXuatBan" name="NhaXuatBan" value="{{ old('NhaXuatBan') }}" />
							</div>
							<div class="form-group col-md-4">
								<label for="NamXuatBan"><span class="badge badge-info">5</span> Năm xuất bản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamXuatBan') is-invalid @enderror" id="NamXuatBan" name="NamXuatBan" value="{{ old('NamXuatBan') }}" placeholder="YYYY" required />
								@error('NamXuatBan')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ISBN"><span class="badge badge-secondary">6</span> Mã số ISBN</label>
								<input type="text" class="form-control" id="ISBN" name="ISBN" value="{{ old('ISBN') }}" />
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet"><span class="badge badge-secondary">7</span> Liên kết</label>
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
	
	<form action="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật sách - giáo trình - tài liệu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="PhanLoai_edit"><span class="badge badge-info">1</span> Phân loại <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('PhanLoai_edit') is-invalid @enderror" id="PhanLoai_edit" name="PhanLoai_edit" required>
									<option value="">-- Chọn --</option>
									<option>Sách</option>
									<option>Giáo trình</option>
									<option>Tài liệu</option>
								</select>
								@error('PhanLoai_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="Ten_edit"><span class="badge badge-info">2</span> Tên công trình <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('Ten_edit') is-invalid @enderror" id="Ten_edit" name="Ten_edit" value="{{ old('Ten_edit') }}" required />
								@error('Ten_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="TacGiaNhomTacGia_edit"><span class="badge badge-info">3</span> Tác giả hoặc nhóm tác giả <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TacGiaNhomTacGia_edit') is-invalid @enderror" id="TacGiaNhomTacGia_edit" name="TacGiaNhomTacGia_edit" value="{{ old('TacGiaNhomTacGia_edit') }}" required />
							@error('TacGiaNhomTacGia_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="NhaXuatBan_edit"><span class="badge badge-secondary">4</span> Nhà xuất bản</label>
								<input type="text" class="form-control" id="NhaXuatBan_edit" name="NhaXuatBan_edit" value="{{ old('NhaXuatBan_edit') }}" />
							</div>
							<div class="form-group col-md-4">
								<label for="NamXuatBan_edit"><span class="badge badge-info">5</span> Năm xuất bản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamXuatBan_edit') is-invalid @enderror" id="NamXuatBan_edit" name="NamXuatBan_edit" value="{{ old('NamXuatBan_edit') }}" placeholder="YYYY" required />
								@error('NamXuatBan_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="ISBN_edit"><span class="badge badge-secondary">6</span> Mã số ISBN</label>
								<input type="text" class="form-control" id="ISBN_edit" name="ISBN_edit" value="{{ old('ISBN_edit') }}" />
							</div>
							<div class="form-group col-md-8">
								<label for="LienKet_edit"><span class="badge badge-secondary">7</span> Liên kết</label>
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
	
	<form action="{{ route('admin.hosonhanvien.sachgiaotrinhtailieu.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa sách - giáo trình - tài liệu</h5>
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
		function getCapNhat(id, ten, phanLoai, tacGia, nhaXuatBan, nam, ISBN, lienKet, congKhai) {
			$('#ID_edit').val(id);
			$('#Ten_edit').val(ten);
			$('#PhanLoai_edit').val(phanLoai);
			$('#TacGiaNhomTacGia_edit').val(tacGia);
			$('#NhaXuatBan_edit').val(nhaXuatBan);
			$('#NamXuatBan_edit').val(nam);
			$('#ISBN_edit').val(ISBN);
			$('#LienKet_edit').val(lienKet);
			$('#HienThiCongKhai_edit').prop('checked', congKhai);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('PhanLoai') || $errors->has('Ten') || $errors->has('TacGiaNhomTacGia') || $errors->has('NamXuatBan'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('PhanLoai_edit') || $errors->has('Ten_edit') || $errors->has('TacGiaNhomTacGia_edit') || $errors->has('NamXuatBan_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection