@extends('layouts.admin')

@section('pagetitle')
	Sửa văn bản kèm theo bài viết
@endsection

@section('content')
	@if(!$cms_vanban->isEmpty())
		<form role="form" method="post" action="{{ route('admin.baiviet.vanban.suanhanh') }}">
			@csrf
			@foreach($cms_vanban as $vanban)
				<div class="card mb-3">
					<div class="card-header"><a href="{{ route('admin.home') }}"><i class="fad fa-home-alt"></i></a> <i class="fal fa-angle-double-right"></i> [{{ $vanban->MaBaiViet }}] {{ $vanban->CMS_BaiViet->TieuDe }} <i class="fal fa-angle-double-right"></i> <a href="#collapseBaiViet-{{ $vanban->ID }}" data-toggle="collapse" aria-expanded="false" aria-controls="collapseBaiViet-{{ $vanban->ID }}">{{ $vanban->TenVanBan }}</a></div>
					<div class="card-body collapse" id="collapseBaiViet-{{ $vanban->ID }}">
						<input type="hidden" id="ID" name="ID[]" value="{{ $vanban->ID }}" />
						<div class="form-group">
							<label for="TenVanBan"><span class="badge badge-info">1</span> Tên văn bản <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TenVanBan') is-invalid @enderror" id="TenVanBan" name="TenVanBan[{{ $vanban->ID }}]" value="{{ $vanban->TenVanBan }}" required />
							<small class="form-text text-muted"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $vanban->TenVanBanKhongDau }}</span></small>
							@error('TenVanBan')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
						<div class="form-group mb-0">
							<label for="DuongDan"><span class="badge badge-info">2</span> Đường dẫn <span class="text-danger font-weight-bold">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><a href="#taptin" onclick="getXemVanBan({{ $vanban->MaBaiViet }}, {{ $vanban->ID }})">Sửa tập tin</a></div>
								</div>
								<input type="text" class="form-control" id="DuongDan-{{ $vanban->ID }}" name="DuongDan[{{ $vanban->ID }}]" value="{{ $vanban->DuongDan }}" readonly required />
							</div>
						</div>
					</div>
				</div>
			@endforeach
			
			<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật nhanh văn bản</button>
		</form>
	@else
		<div class="card">
			<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.home') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Sửa văn bản kèm theo bài viết</div>
			<div class="card-body">
				<div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
					<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> Các văn bản đã được cập nhật!</span>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckfinder/3.5.1.1/ckfinder.js') }}"></script>
	<script>
		function escapeHtml(unsafe)
		{
			return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		function getXemVanBan(id, vanBanID) {
			$.ajax({
				url: '{{ route("admin.baiviet.vanban.ajax") }}',
				method: 'POST',
				data: { _token: '{{ csrf_token() }}', id: id },
				dataType: 'text',
				success: function(data) {
					CKFinder.modal(
					{
						chooseFiles: true,
						displayFoldersPanel: false,
						width: 800,
						height: 500,
						onInit: function(finder) {
							finder.on('files:choose', function(evt) {
								var file = evt.data.files.first();
								var output = document.getElementById("DuongDan-" + vanBanID);
								output.value = escapeHtml(file.get('name'));
							});
							finder.on('file:choose:resizedImage', function(evt) {
								var output = document.getElementById("DuongDan-" + vanBanID);
								output.value = escapeHtml(evt.data.file.get('name'));
							});
						}
					});
				}
			});
		}
	</script>
@endsection