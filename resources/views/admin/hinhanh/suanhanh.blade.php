@extends('layouts.admin')

@section('pagetitle')
	Sửa hình ảnh
@endsection

@section('content')
	@if(!$cms_hinhanh->isEmpty())
		<form role="form" method="post" action="{{ route('admin.hinhanh.suanhanh') }}">
			@csrf
			@foreach($cms_hinhanh as $hinhanh)
				<div class="card mb-3">
					<div class="card-header"><a href="{{ route('admin.home') }}"><i class="fad fa-home-alt"></i></a> <i class="fal fa-angle-double-right"></i> {{ $hinhanh->CMS_ChuDe->TenChuDe }} <i class="fal fa-angle-double-right"></i> <a href="#collapseHinhAnh-{{ $hinhanh->ID }}" data-toggle="collapse" aria-expanded="false" aria-controls="collapseHinhAnh-{{ $hinhanh->ID }}">{{ $hinhanh->MoTa }}</a></div>
					<div class="card-body collapse" id="collapseHinhAnh-{{ $hinhanh->ID }}">
						<input type="hidden" id="ID" name="ID[]" value="{{ $hinhanh->ID }}" />
						<div class="form-group">
							<label for="MoTa"><span class="badge badge-info">1</span> Mô tả album ảnh <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('MoTa') is-invalid @enderror" id="MoTa" name="MoTa[{{ $hinhanh->ID }}]" value="{{ $hinhanh->MoTa }}" required />
							<small class="form-text text-muted"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $hinhanh->MoTaKhongDau }}</span></small>
							@error('MoTa')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
						<div class="form-group mb-0">
							<label for="ThuMuc"><span class="badge badge-info">2</span> Hình ảnh đính kèm <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><a href="#hinhanh" onclick="getXemHinh({{ $hinhanh->ID }})">Chỉnh sửa ảnh</a></div>
								</div>
								<input type="text" class="form-control" id="ThuMuc" name="ThuMuc[{{ $hinhanh->ID }}]" value="{{ $hinhanh->ThuMuc }}" readonly required />
							</div>
						</div>
					</div>
				</div>
			@endforeach
			
			<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật nhanh hình ảnh</button>
		</form>
	@else
		<div class="card">
			<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.hinhanh.home') }}">Quản lý hình ảnh</a> <i class="fal fa-angle-double-right"></i> Sửa hình ảnh</div>
			<div class="card-body">
				<div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
					<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> Các hình ảnh đã được cập nhật!</span>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		function getXemHinh(id) {
			$.ajax({
				url: '{{ route("admin.hinhanh.ajax") }}',
				method: 'POST',
				data: { _token: '{{ csrf_token() }}', id: id },
				dataType: 'text',
				success: function(data) {
					CKFinder.modal(
					{
						displayFoldersPanel: false,
						width: 800,
						height: 500
					});
				}
			});
		}
	</script>
@endsection