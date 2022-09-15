@extends('layouts.admin')

@section('pagetitle')
	Sửa bài viết
@endsection

@section('content')
	@if(!$cms_baiviet->isEmpty())
		<form role="form" method="post" action="{{ route('admin.baiviet.suanhanh') }}">
			@csrf
			@foreach($cms_baiviet as $baiviet)
				<div class="card mb-3">
					<div class="card-header"><a href="{{ route('admin.home') }}"><i class="fad fa-home-alt"></i></a> <i class="fal fa-angle-double-right"></i> {{ $baiviet->CMS_ChuDe->TenChuDe }} <i class="fal fa-angle-double-right"></i> <a href="#collapseBaiViet-{{ $baiviet->ID }}" data-toggle="collapse" aria-expanded="false" aria-controls="collapseBaiViet-{{ $baiviet->ID }}">{{ $baiviet->TieuDe }}</a></div>
					<div class="card-body collapse" id="collapseBaiViet-{{ $baiviet->ID }}">
						<input type="hidden" id="ID" name="ID[]" value="{{ $baiviet->ID }}" />
						<div class="form-group">
							<label for="TieuDe"><span class="badge badge-info">1</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('TieuDe') is-invalid @enderror" id="TieuDe" name="TieuDe[{{ $baiviet->ID }}]" value="{{ $baiviet->TieuDe }}" required />
							<small class="form-text text-muted"><i class="fal fa-external-link-alt"></i> <span class="text-primary">{{ $baiviet->TieuDeKhongDau }}</span></small>
							@error('TieuDe')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="TomTat"><span class="badge badge-secondary">2</span> Tóm tắt bài viết</label>
							<textarea class="form-control" id="TomTat" name="TomTat[{{ $baiviet->ID }}]">{{ $baiviet->TomTat }}</textarea>
						</div>
						<div class="form-group mb-0">
							<label for="NoiDung"><span class="badge badge-info">3</span> Nội dung bài viết <span class="text-danger font-weight-bold">*</span></label>
							<textarea class="form-control @error('NoiDung') is-invalid @enderror ckeditor" id="NoiDung" name="NoiDung[{{ $baiviet->ID }}]" required>{{ $baiviet->NoiDung }}</textarea>
							@error('NoiDung')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@endif
						</div>
					</div>
				</div>
			@endforeach
			
			<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật nhanh bài viết</button>
		</form>
	@else
		<div class="card">
			<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.home') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Sửa bài viết</div>
			<div class="card-body">
				<div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
					<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> Các bài viết đã được cập nhật!</span>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('javascript')
	<script src="{{ asset('public/vendor/ckeditor/4.15.0/ckeditor.js') }}"></script>
@endsection