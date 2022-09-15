@extends('layouts.admin')

@section('pagetitle')
	Bài báo khoa học
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hosonhanvien.home') }}">Hồ sơ nhân viên</a> <i class="fal fa-angle-double-right"></i> Bài báo khoa học</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="65%">Thông tin bài báo</th>
						<th width="10%">Năm xuất bản</th>
						<th width="10%">Hiện công khai</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_baibaokhoahoc as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<span class="text-primary font-weight-bold d-block">{{ $value->TenBaiBao }}</span>
								<span class="d-block">Phân loại: <strong>{{ $value->LoaiBaiBao }}</strong></span>
								<span class="d-block">Tác giả: <strong>{{ $value->TacGiaNhomTacGia }}</strong></span>
								<span class="d-block">Nơi đăng: <strong>{{ $value->NoiDang }}</strong></span>
								<span class="d-block">Số xuất bản/ISSN/ISBN: <strong>{{ $value->So }}</strong>, trang: <strong>{{ $value->TuTrangDenTrang }}</strong></span>
								@if(!empty($value->LienKet))
									<span class="d-block">Xem chi tiết: <strong>{{ $value->LienKet }}</strong></span>
								@endif
							</td>
							<td>{{ $value->NamXuatBan }}</td>
							<td class="text-center">
								@if($value->HienThiCongKhai == 1)
									<a href="{{ route('admin.hosonhanvien.baibaokhoahoc.congbo', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Hiển thị công khai trong mục NCKH"></i></a>
								@else
									<a href="{{ route('admin.hosonhanvien.baibaokhoahoc.congbo', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Không hiển thị"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->LoaiBaiBao }}', '{{ addslashes($value->TenBaiBao) }}', '{{ addslashes($value->TacGiaNhomTacGia) }}', '{{ addslashes($value->NoiDang) }}', '{{ $value->So }}', '{{ $value->TuTrangDenTrang }}', '{{ $value->NamXuatBan }}', '{{ $value->LienKet }}', {{ $value->HienThiCongKhai }}); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.hosonhanvien.baibaokhoahoc.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm bài báo khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="LoaiBaiBao"><span class="badge badge-info">1</span> Loại bài báo <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('LoaiBaiBao') is-invalid @enderror" id="LoaiBaiBao" name="LoaiBaiBao" required>
									<option value="">-- Chọn --</option>
									<option>Bài báo đăng trên Tạp chí khoa học quốc tế</option>
									<option>Bài báo đăng trên Tạp chí khoa học chuyên ngành quốc tế</option>
									<option>Bài báo đăng trên Tạp chí khoa học trong nước</option>
									<option>Bài báo đăng trên Tạp chí khoa học chuyên ngành trong nước</option>
									<option>Bài báo đăng trên Tạp chí chuyên ngành quốc tế (SCI, ISI, Scopus)</option>
								</select>
								@error('LoaiBaiBao')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TenBaiBao"><span class="badge badge-info">2</span> Tên bài báo <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TenBaiBao') is-invalid @enderror" id="TenBaiBao" name="TenBaiBao" value="{{ old('TenBaiBao') }}" required />
								@error('TenBaiBao')
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
							<div class="form-group col-md-6">
								<label for="NoiDang"><span class="badge badge-info">4</span> Nơi đăng <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NoiDang') is-invalid @enderror" id="NoiDang" name="NoiDang" value="{{ old('NoiDang') }}" required />
								@error('NoiDang')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="So"><span class="badge badge-info">5</span> Số xuất bản/ISSN/ISBN <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('So') is-invalid @enderror" id="So" name="So" value="{{ old('So') }}" required />
								@error('So')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="TuTrangDenTrang"><span class="badge badge-info">6</span> Trang <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TuTrangDenTrang') is-invalid @enderror" id="TuTrangDenTrang" name="TuTrangDenTrang" value="{{ old('TuTrangDenTrang') }}" placeholder="Từ trang - đến trang" required />
								@error('TuTrangDenTrang')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="NamXuatBan"><span class="badge badge-info">7</span> Năm xuất bản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamXuatBan') is-invalid @enderror" id="NamXuatBan" name="NamXuatBan" value="{{ old('NamXuatBan') }}" required />
								@error('NamXuatBan')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="LienKet"><span class="badge badge-secondary">8</span> Liên kết</label>
							<input type="text" class="form-control" id="LienKet" name="LienKet" value="{{ old('LienKet') }}" />
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
	
	<form action="{{ route('admin.hosonhanvien.baibaokhoahoc.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật bài báo khoa học</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="LoaiBaiBao_edit"><span class="badge badge-info">1</span> Loại bài báo <span class="text-danger font-weight-bold">*</span></label>
								<select class="custom-select @error('LoaiBaiBao_edit') is-invalid @enderror" id="LoaiBaiBao_edit" name="LoaiBaiBao_edit" required>
									<option value="">-- Chọn --</option>
									<option>Bài báo đăng trên Tạp chí khoa học quốc tế</option>
									<option>Bài báo đăng trên Tạp chí khoa học chuyên ngành quốc tế</option>
									<option>Bài báo đăng trên Tạp chí khoa học trong nước</option>
									<option>Bài báo đăng trên Tạp chí khoa học chuyên ngành trong nước</option>
									<option>Bài báo đăng trên Tạp chí chuyên ngành quốc tế (SCI, ISI, Scopus)</option>
								</select>
								@error('LoaiBaiBao_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-8">
								<label for="TenBaiBao_edit"><span class="badge badge-info">2</span> Tên bài báo <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TenBaiBao_edit') is-invalid @enderror" id="TenBaiBao_edit" name="TenBaiBao_edit" value="{{ old('TenBaiBao_edit') }}" required />
								@error('TenBaiBao_edit')
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
							<div class="form-group col-md-6">
								<label for="NoiDang_edit"><span class="badge badge-info">4</span> Nơi đăng <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NoiDang_edit') is-invalid @enderror" id="NoiDang_edit" name="NoiDang_edit" value="{{ old('NoiDang_edit') }}" required />
								@error('NoiDang_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="So_edit"><span class="badge badge-info">5</span> Số xuất bản/ISSN/ISBN <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('So_edit') is-invalid @enderror" id="So_edit" name="So_edit" value="{{ old('So_edit') }}" required />
								@error('So_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="TuTrangDenTrang_edit"><span class="badge badge-info">6</span> Trang <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('TuTrangDenTrang_edit') is-invalid @enderror" id="TuTrangDenTrang_edit" name="TuTrangDenTrang_edit" value="{{ old('TuTrangDenTrang_edit') }}" placeholder="Từ trang - đến trang" required />
								@error('TuTrangDenTrang_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="NamXuatBan_edit"><span class="badge badge-info">7</span> Năm xuất bản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('NamXuatBan_edit') is-invalid @enderror" id="NamXuatBan_edit" name="NamXuatBan_edit" value="{{ old('NamXuatBan_edit') }}" required />
								@error('NamXuatBan_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="LienKet_edit"><span class="badge badge-secondary">8</span> Liên kết</label>
							<input type="text" class="form-control" id="LienKet_edit" name="LienKet_edit" value="{{ old('LienKet_edit') }}" />
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
	
	<form action="{{ route('admin.hosonhanvien.baibaokhoahoc.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa bài báo khoa học</h5>
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
		function getCapNhat(id, loai, ten, tacGia, noiDang, so, trang, nam, lienKet, congKhai) {
			$('#ID_edit').val(id);
			$('#LoaiBaiBao_edit').val(loai);
			$('#TenBaiBao_edit').val(ten);
			$('#TacGiaNhomTacGia_edit').val(tacGia);
			$('#NoiDang_edit').val(noiDang);
			$('#So_edit').val(so);
			$('#TuTrangDenTrang_edit').val(trang);
			$('#NamXuatBan_edit').val(nam);
			$('#LienKet_edit').val(lienKet);
			$('#HienThiCongKhai_edit').prop('checked', congKhai);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('LoaiBaiBao') || $errors->has('TenBaiBao') || $errors->has('TacGiaNhomTacGia') || $errors->has('NoiDang') || $errors->has('So') || $errors->has('TuTrangDenTrang') || $errors->has('NamXuatBan'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('LoaiBaiBao_edit') || $errors->has('TenBaiBao_edit') || $errors->has('TacGiaNhomTacGia_edit') || $errors->has('NoiDang_edit') || $errors->has('So_edit') || $errors->has('TuTrangDenTrang_edit') || $errors->has('NamXuatBan_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection