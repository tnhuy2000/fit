@extends('layouts.admin')

@section('pagetitle')
	Danh sách nhân viên
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('public/vendor/datepicker/1.9.0/css/bootstrap-datepicker.min.css') }}" />
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách nhân viên</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Hình ảnh</th>
						<th width="15%">Mã cán bộ</th>
						<th width="50%">Thông tin nhân viên</th>
						<th width="5%">O/F</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hrm_nhanvien as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td class="text-center">
								@if(!empty($value->HinhAnh))
									<img class="rounded" src="{{ $path . strstr($value->Email, '@', true). '/' . $value->HinhAnh }}" width="100" />
								@else
									<img class="rounded" src="{{ $path . 'noimage.png' }}" width="100" />
								@endif
							</td>
							<td>
								{{ $value->MaCanBo }}
								@if($value->TrangThai == 0)
									<span class="d-block small text-danger font-weight-bold">Đã chuyển công tác</span>
								@endif
							</td>
							<td>
								<span class="text-primary font-weight-bold">{{ $value->HoVaTen }}</span>
								<span class="small">
									@if(!empty($value->NamSinh))
										<br />Năm sinh: {{ $value->NamSinh }}
									@endif
									@php $ngayVaoLam = null; @endphp
									@if(!empty($value->NgayVaoLam))
										@php $ngayVaoLam = Carbon\Carbon::createFromFormat('Y-m-d', $value->NgayVaoLam)->format('d/m/Y'); @endphp
										<br />Ngày vào làm: {{ $ngayVaoLam }}
									@endif
									@if(!empty($value->ChuyenNganh))
										<br />Chuyên ngành: {{ $value->ChuyenNganh }}
									@endif
									@if(!empty($value->HocVi))
										<br />Học vị: {{ $value->HocVi }}
										@if(!empty($value->NamNhanHocVi))
											({{ $value->NamNhanHocVi }})
										@endif
									@endif
									@if(!empty($value->HocHam))
										<br />Học hàm: {{ $value->HocHam }}
										@if(!empty($value->NamNhanHocHam))
											({{ $value->NamNhanHocHam }})
										@endif
									@endif
									@if(!empty($value->Email))
										<br />Email: {{ $value->Email }}
									@endif
									@if(!empty($value->DienThoai))
										<br />Điện thoại: {{ $value->DienThoai }}
									@endif
									@if(!empty($value->TrangWeb))
										<br />Trang web: {{ $value->TrangWeb }}
									@endif
									@if(!empty($value->ThongTinThem))
										<br />Thông tin khác: {{ $value->ThongTinThem }}
									@endif
								</span>
							</td>
							<td class="text-center">
								@if($value->TrangThai == 1)
									<a href="{{ route('admin.danhmuc.nhanvien.trangthai', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang hoạt động"></i></a>
								@else
									<a href="{{ route('admin.danhmuc.nhanvien.trangthai', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Đã chuyển công tác"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->ID }}, '{{ $value->MaCanBo }}', '{{ $value->HoVaTen }}', '{{ $value->NamSinh }}', '{{ $ngayVaoLam }}', '{{ $value->ChuyenNganh }}', '{{ $value->HocVi }}', '{{ $value->NamNhanHocVi }}', '{{ $value->HocHam }}', '{{ $value->NamNhanHocHam }}', '{{ $value->Email }}', '{{ $value->DienThoai }}', '{{ $value->TrangWeb }}', '{{ $value->HinhAnh }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.nhanvien.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm nhân viên</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="MaCanBo"><span class="badge badge-secondary">1</span> Mã cán bộ</label>
								<input type="text" class="form-control @error('MaCanBo') is-invalid @enderror" id="MaCanBo" name="MaCanBo" value="{{ old('MaCanBo') }}" placeholder="Ví dụ: T50-15111-0531" />
								@error('MaCanBo')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="HoVaTen"><span class="badge badge-info">2</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('HoVaTen') is-invalid @enderror" id="HoVaTen" name="HoVaTen" value="{{ old('HoVaTen') }}" required />
								@error('HoVaTen')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-2">
								<label for="NamSinh"><span class="badge badge-secondary">3</span> Năm sinh</label>
								<input type="text" class="form-control @error('NamSinh') is-invalid @enderror" id="NamSinh" name="NamSinh" value="{{ old('NamSinh') }}" placeholder="yyyy" />
								@error('NamSinh')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Email"><span class="badge badge-info">4</span> Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" value="{{ old('Email') }}" required />
								@error('Email')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="DienThoai"><span class="badge badge-secondary">5</span> Điện thoại</label>
								<input type="text" class="form-control @error('DienThoai') is-invalid @enderror" id="DienThoai" name="DienThoai" value="{{ old('DienThoai') }}" />
								@error('DienThoai')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="NgayVaoLam"><span class="badge badge-secondary">6</span> Ngày vào làm</label>
								<div class="input-group">
									<input type="text" class="form-control DatePicker" id="NgayVaoLam" name="NgayVaoLam" value="{{ old('NgayVaoLam') }}" placeholder="dd/mm/yyyy" />
									<div class="input-group-append">
										<div class="input-group-text"><i class="fal fa-calendar"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="ChuyenNganh"><span class="badge badge-secondary">7</span> Chuyên ngành</label>
								<input type="text" class="form-control" id="ChuyenNganh" name="ChuyenNganh" value="{{ old('ChuyenNganh') }}" list="DSChuyenNganh" />
								<datalist id="DSChuyenNganh">
									<option value="Công nghệ phần mềm" />
									<option value="Công nghệ tri thức" />
									<option value="Hệ thống thông tin" />
									<option value="Khoa học máy tính" />
									<option value="Mạng máy tính và viễn thông" />
									<option value="Tin học" />
								</datalist>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocVi"><span class="badge badge-secondary">8</span> Học vị</label>
								<select class="custom-select" id="HocVi" name="HocVi">
									<option value="">-- Chọn học vị --</option>
									<option>Trung cấp</option>
									<option>Cao đẳng</option>
									<option>Cử nhân</option>
									<option>Cử nhân (Cao học)</option>
									<option>Kỹ sư</option>
									<option>Kỹ sư (Cao học)</option>
									<option>Thạc sĩ</option>
									<option>Thạc sĩ (Nghiên cứu sinh)</option>
									<option>Tiến sĩ</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocVi"><span class="badge badge-secondary">9</span> Năm nhận học vị</label>
								<input type="text" class="form-control" id="NamNhanHocVi" name="NamNhanHocVi" value="{{ old('NamNhanHocVi') }}" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocHam"><span class="badge badge-secondary">10</span> Học hàm</label>
								<select class="custom-select" id="HocHam" name="HocHam">
									<option value="">-- Chọn học hàm --</option>
									<option>Phó Giáo sư</option>
									<option>Giáo sư</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocHam"><span class="badge badge-secondary">11</span> Năm nhận học hàm</label>
								<input type="text" class="form-control" id="NamNhanHocHam" name="NamNhanHocHam" value="{{ old('NamNhanHocHam') }}" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="HinhAnh"><span class="badge badge-secondary">12</span> Hình ảnh đại diện</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="ChonHinh"><a href="#hinhanh">Chọn hình</a></div>
									</div>
									<input type="text" class="form-control" id="HinhAnh" name="HinhAnh" value="{{ old('HinhAnh') }}" readonly />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="TrangWeb"><span class="badge badge-secondary">13</span> Trang web cá nhân</label>
								<input type="text" class="form-control" id="TrangWeb" name="TrangWeb" value="{{ old('TrangWeb') }}" placeholder="http://www.demo.com" />
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
	
	<form action="{{ route('admin.danhmuc.nhanvien.sua') }}" method="post">
		@csrf
		<input type="hidden" id="ID_edit" name="ID_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật nhân viên</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="MaCanBo_edit"><span class="badge badge-secondary">1</span> Mã cán bộ</label>
								<input type="text" class="form-control @error('MaCanBo_edit') is-invalid @enderror" id="MaCanBo_edit" name="MaCanBo_edit" value="{{ old('MaCanBo_edit') }}" placeholder="Ví dụ: T50-15111-0531" />
								@error('MaCanBo_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="HoVaTen_edit"><span class="badge badge-info">2</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('HoVaTen_edit') is-invalid @enderror" id="HoVaTen_edit" name="HoVaTen_edit" value="{{ old('HoVaTen_edit') }}" required />
								@error('HoVaTen_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-2">
								<label for="NamSinh_edit"><span class="badge badge-secondary">3</span> Năm sinh</label>
								<input type="text" class="form-control @error('NamSinh_edit') is-invalid @enderror" id="NamSinh_edit" name="NamSinh_edit" value="{{ old('NamSinh_edit') }}" placeholder="yyyy" />
								@error('NamSinh_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Email_edit"><span class="badge badge-info">4</span> Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('Email_edit') is-invalid @enderror" id="Email_edit" name="Email_edit" value="{{ old('Email_edit') }}" required />
								@error('Email_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="DienThoai_edit"><span class="badge badge-secondary">5</span> Điện thoại</label>
								<input type="text" class="form-control @error('DienThoai_edit') is-invalid @enderror" id="DienThoai_edit" name="DienThoai_edit" value="{{ old('DienThoai_edit') }}" />
								@error('DienThoai_edit')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="NgayVaoLam_edit"><span class="badge badge-secondary">6</span> Ngày vào làm</label>
								<div class="input-group">
									<input type="text" class="form-control DatePicker" id="NgayVaoLam_edit" name="NgayVaoLam_edit" value="{{ old('NgayVaoLam_edit') }}" placeholder="dd/mm/yyyy" />
									<div class="input-group-append">
										<div class="input-group-text"><i class="fal fa-calendar"></i></div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="ChuyenNganh_edit"><span class="badge badge-secondary">7</span> Chuyên ngành</label>
								<input type="text" class="form-control" id="ChuyenNganh_edit" name="ChuyenNganh_edit" value="{{ old('ChuyenNganh_edit') }}" list="DSChuyenNganh_edit" />
								<datalist id="DSChuyenNganh_edit">
									<option value="Công nghệ phần mềm" />
									<option value="Công nghệ tri thức" />
									<option value="Hệ thống thông tin" />
									<option value="Khoa học máy tính" />
									<option value="Mạng máy tính và viễn thông" />
									<option value="Tin học" />
								</datalist>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocVi_edit"><span class="badge badge-secondary">8</span> Học vị</label>
								<select class="custom-select" id="HocVi_edit" name="HocVi_edit">
									<option value="">-- Chọn học vị --</option>
									<option>Trung cấp</option>
									<option>Cao đẳng</option>
									<option>Cử nhân</option>
									<option>Cử nhân (Cao học)</option>
									<option>Kỹ sư</option>
									<option>Kỹ sư (Cao học)</option>
									<option>Thạc sĩ</option>
									<option>Thạc sĩ (Nghiên cứu sinh)</option>
									<option>Tiến sĩ</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocVi_edit"><span class="badge badge-secondary">9</span> Năm nhận học vị</label>
								<input type="text" class="form-control" id="NamNhanHocVi_edit" name="NamNhanHocVi_edit" value="{{ old('NamNhanHocVi_edit') }}" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label for="HocHam_edit"><span class="badge badge-secondary">10</span> Học hàm</label>
								<select class="custom-select" id="HocHam_edit" name="HocHam_edit">
									<option value="">-- Chọn học hàm --</option>
									<option>Phó Giáo sư</option>
									<option>Giáo sư</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="NamNhanHocHam_edit"><span class="badge badge-secondary">11</span> Năm nhận học hàm</label>
								<input type="text" class="form-control" id="NamNhanHocHam_edit" name="NamNhanHocHam_edit" value="{{ old('NamNhanHocHam_edit') }}" placeholder="yyyy" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="HinhAnh_edit"><span class="badge badge-secondary">12</span> Hình ảnh đại diện</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text" id="ChonHinh_edit"><a href="#hinhanh">Chọn hình</a></div>
									</div>
									<input type="text" class="form-control" id="HinhAnh_edit" name="HinhAnh_edit" value="{{ old('HinhAnh_edit') }}" readonly />
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="TrangWeb_edit"><span class="badge badge-secondary">13</span> Trang web cá nhân</label>
								<input type="text" class="form-control" id="TrangWeb_edit" name="TrangWeb_edit" value="{{ old('TrangWeb_edit') }}" placeholder="http://www.demo.com" />
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
	
	<form action="{{ route('admin.danhmuc.nhanvien.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa nhân viên</h5>
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
	<script src="{{ asset('public/vendor/datepicker/1.9.0/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('public/vendor/datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js') }}"></script>
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		$('.DatePicker').datepicker({
			format: "dd/mm/yyyy",
			weekStart: 1,
			startDate: "1/1/1960",
			endDate: "31/12/2040",
			startView: 2,
			maxViewMode: 2,
			clearBtn: true,
			language: "vi",
			todayHighlight: true
		});
		
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
		
		function getCapNhat(id, maCanBo, hoVaTen, namSinh, ngayVaoLam, chuyenNganh, hocVi, namNhanHocVi, hocHam, namNhanHocHam, email, dienThoai, trangWeb, hinhAnh) {
			$('#ID_edit').val(id);
			$('#MaCanBo_edit').val(maCanBo);
			$('#HoVaTen_edit').val(hoVaTen);
			$('#NamSinh_edit').val(namSinh);
			$('#NgayVaoLam_edit').val(ngayVaoLam);
			$('#ChuyenNganh_edit').val(chuyenNganh);
			$('#HocVi_edit').val(hocVi);
			$('#NamNhanHocVi_edit').val(namNhanHocVi);
			$('#HocHam_edit').val(hocHam);
			$('#NamNhanHocHam_edit').val(namNhanHocHam);
			$('#Email_edit').val(email);
			$('#DienThoai_edit').val(dienThoai);
			$('#TrangWeb_edit').val(trangWeb);
			$('#HinhAnh_edit').val(hinhAnh);
		}
		
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
		
		@if($errors->has('MaCanBo') || $errors->has('HoVaTen') || $errors->has('NamSinh') ||  $errors->has('Email') || $errors->has('DienThoai'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('MaCanBo_edit') || $errors->has('HoVaTen_edit') || $errors->has('NamSinh_edit') || $errors->has('Email_edit') || $errors->has('DienThoai_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection