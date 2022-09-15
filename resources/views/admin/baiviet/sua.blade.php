@extends('layouts.admin')

@section('pagetitle')
	Sửa bài viết
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.danhsach') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Sửa bài viết</div>
		<div class="card-body">
			<form role="form" method="post" action="{{ route('admin.baiviet.sua', ['id' => $cms_baiviet->ID]) }}">
				@csrf
				<input type="hidden" id="ID" name="ID" value="{{ $cms_baiviet->ID }}" />
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="MaLoai"><span class="badge badge-info">1</span> Loại bài viết <span class="text-danger font-weight-bold">*</span></label>
						<select class="custom-select @error('MaLoai') is-invalid @enderror" id="MaLoai" name="MaLoai" required>
							<option value="">-- Chọn loại --</option>
							@foreach($cms_loaibaiviet as $value)
								@if($value->ID == $cms_baiviet->MaLoai)
									<option value="{{ $value->ID }}" selected>{{ $value->TenLoai }}</option>
								@else
									<option value="{{ $value->ID }}">{{ $value->TenLoai }}</option>
								@endif
							@endforeach
						</select>
						@error('MaLoai')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@endif
					</div>
					<div class="form-group col-md-6">
						<label for="MaChuDe"><span class="badge badge-info">2</span> Chủ đề <span class="text-danger font-weight-bold">*</span></label>
						<select class="custom-select @error('MaChuDe') is-invalid @enderror" id="MaChuDe" name="MaChuDe" required>
							<option value="">-- Chọn chủ đề --</option>
							@foreach($cms_chude as $value)
								@if($value->ID == $cms_baiviet->MaChuDe)
									<option value="{{ $value->ID }}" selected>{{ $value->TenChuDe }}</option>
								@else
									<option value="{{ $value->ID }}">{{ $value->TenChuDe }}</option>
								@endif
							@endforeach
						</select>
						@error('MaChuDe')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="TieuDe"><span class="badge badge-info">3</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" class="form-control @error('TieuDe') is-invalid @enderror" id="TieuDe" name="TieuDe" value="{{ $cms_baiviet->TieuDe }}" required />
					<small class="form-text text-muted"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $cms_baiviet->TieuDeKhongDau }}</span></small>
					@error('TieuDe')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@endif
				</div>
				<div class="form-group">
					<label for="TomTat"><span class="badge badge-secondary">4</span> Tóm tắt bài viết</label>
					<textarea class="form-control" id="TomTat" name="TomTat">{{ $cms_baiviet->TomTat }}</textarea>
				</div>
				<div class="form-group">
					<label for="NoiDung"><span class="badge badge-info">5</span> Nội dung bài viết <span class="text-danger font-weight-bold">*</span></label>
					<textarea class="form-control @error('NoiDung') is-invalid @enderror ckeditor" id="NoiDung" name="NoiDung" required>{{ $cms_baiviet->NoiDung }}</textarea>
					@error('NoiDung')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@endif
				</div>
				<div class="form-group" id="divDonVi">
					<label for="MaDonVi"><span class="badge badge-info">6</span> Nhân sự trực thuộc <span class="text-danger font-weight-bold">*</span></label>
					<select class="custom-select @error('MaDonVi') is-invalid @enderror" id="MaDonVi" name="MaDonVi">
						<option value="">-- Chọn đơn vị --</option>
						@foreach($hrm_donvi as $value)
							@if($value->ID == $cms_baiviet->MaDonVi)
								<option value="{{ $value->ID }}" selected>{{ $value->TenDonVi }}</option>
							@else
								<option value="{{ $value->ID }}">{{ $value->TenDonVi }}</option>
							@endif
						@endforeach
					</select>
					@error('MaDonVi')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@endif
				</div>
				<div class="form-group" id="divDinhKem">
					<span class="text-danger"><i class="fal fa-info-circle"></i> Văn bản đính kèm được cập nhật ở bước tiếp theo.</span>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox" id="QuanTrong" name="QuanTrong" value="1" @if($cms_baiviet->QuanTrong == 1) checked @endif />
						<label class="custom-control-label" for="QuanTrong">Ghim bài viết lên trên cùng</label>
					</div>
				</div>
				
				@if($cms_baiviet->MaLoai == 2)
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Lưu và tiếp tục</button>
				@else
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật bài viết</button>
				@endif
			</form>
		</div>
	</div>
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckeditor/4.15.0/ckeditor.js') }}"></script>
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		$(document).ready(function() {
			if($("#MaLoai").val() == "1") {
				$("#divDinhKem").hide();
				$("#divDonVi").hide();
			} else if($("#MaLoai").val() == "2") {
				$("#divDinhKem").show();
				$("#divDonVi").hide();
			} else if($("#MaLoai").val() == "3") {
				$("#divDinhKem").hide();
				$("#divDonVi").show();
			} else {
				$("#divDinhKem").hide();
				$("#divDonVi").hide();
			}
			$("#MaLoai").change(function() {
				if($("#MaLoai").val() == "1") {
					$("#divDinhKem").hide();
					$("#divDonVi").hide();
				} else if($("#MaLoai").val() == "2") {
					$("#divDinhKem").show();
					$("#divDonVi").hide();
				} else if($("#MaLoai").val() == "3") {
					$("#divDinhKem").hide();
					$("#divDonVi").show();
				} else {
					$("#divDinhKem").hide();
					$("#divDonVi").hide();
				}
			});
		});
	</script>
@endsection