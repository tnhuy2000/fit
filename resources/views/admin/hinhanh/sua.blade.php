@extends('layouts.admin')

@section('pagetitle')
	Sửa hình ảnh
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hinhanh.danhsach') }}">Quản lý hình ảnh</a> <i class="fal fa-angle-double-right"></i> Sửa hình ảnh</div>
		<div class="card-body">
			<form role="form" method="post" action="{{ route('admin.hinhanh.sua', ['id' => $cms_hinhanh->ID]) }}">
				@csrf
				<input type="hidden" id="ID" name="ID" value="{{ $cms_hinhanh->ID }}" />
				<div class="form-group">
					<label for="MaChuDe"><span class="badge badge-info">1</span> Chủ đề <span class="text-danger font-weight-bold">*</span></label>
					<select class="custom-select @error('MaChuDe') is-invalid @enderror" id="MaChuDe" name="MaChuDe" required>
						<option value="">-- Chọn chủ đề --</option>
						@foreach($cms_chude as $value)
							@if($value->ID == $cms_hinhanh->MaChuDe)
								<option value="{{ $value->ID }}" selected>{{ $value->TenChuDe }}</option>
							@else
								<option value="{{ $value->ID }}">{{ $value->TenChuDe }}</option>
							@endif
						@endforeach
					</select>
					@error('MaChuDe')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="form-group">
					<label for="MoTa"><span class="badge badge-info">2</span> Mô tả album ảnh <span class="text-danger font-weight-bold">*</span></label>
					<textarea class="form-control @error('MoTa') is-invalid @enderror" id="MoTa" name="MoTa" required>{{ $cms_hinhanh->MoTa }}</textarea>
					<small class="form-text text-muted"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $cms_hinhanh->MoTaKhongDau }}</span></small>
					@error('MoTa')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="form-group">
					<label for="ThuMuc"><span class="badge badge-info">3</span> Hình ảnh đính kèm <span class="text-danger font-weight-bold">*</span></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text" id="ChonHinh"><a href="#hinhanh">Tải ảnh lên</a></div>
						</div>
						<input type="text" class="form-control" id="ThuMuc" name="ThuMuc" value="{{ $folder }}" readonly required />
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật hình ảnh</button>
			</form>
		</div>
	</div>
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		var chonHinh = document.getElementById('ChonHinh');
		chonHinh.onclick = function() { uploadFileWithCKFinder(); };
		function uploadFileWithCKFinder()
		{
			CKFinder.modal(
			{
				displayFoldersPanel: false,
				width: 800,
				height: 500
			});
		}
	</script>
@endsection