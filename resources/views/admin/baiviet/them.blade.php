@extends('layouts.admin')

@section('pagetitle')
	Đăng bài viết
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.danhsach') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Đăng bài viết</div>
		<div class="card-body">
			<form role="form" method="post" action="{{ route('admin.baiviet.them') }}">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="MaLoai"><span class="badge badge-info">1</span> Loại bài viết <span class="text-danger font-weight-bold">*</span></label>
						<select class="custom-select @error('MaLoai') is-invalid @enderror" id="MaLoai" name="MaLoai" required>
							<option value="">-- Chọn loại --</option>
							@foreach($cms_loaibaiviet as $value)
								<option value="{{ $value->ID }}">{{ $value->TenLoai }}</option>
							@endforeach
						</select>
						@error('MaLoai')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label for="MaChuDe"><span class="badge badge-info">2</span> Chủ đề <span class="text-danger font-weight-bold">*</span></label>
						<select class="custom-select @error('MaChuDe') is-invalid @enderror" id="MaChuDe" name="MaChuDe" required>
							<option value="">-- Chọn chủ đề --</option>
							@foreach($cms_chude as $value)
								<option value="{{ $value->ID }}">{{ $value->TenChuDe }}</option>
							@endforeach
						</select>
						@error('MaChuDe')
							<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
						@enderror
					</div>
				</div>
				<div class="form-group">
					<label for="TieuDe"><span class="badge badge-info">3</span> Tiêu đề <span class="text-danger font-weight-bold">*</span></label>
					<input type="text" class="form-control @error('TieuDe') is-invalid @enderror" id="TieuDe" name="TieuDe" required />
					@error('TieuDe')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="form-group">
					<label for="TomTat"><span class="badge badge-secondary">4</span> Tóm tắt bài viết</label>
					<textarea class="form-control" id="TomTat" name="TomTat"></textarea>
				</div>
				<div class="form-group">
					<label for="NoiDung"><span class="badge badge-info">5</span> Nội dung bài viết <span class="text-danger font-weight-bold">*</span></label>
					<textarea class="form-control @error('NoiDung') is-invalid @enderror ckeditor" id="NoiDung" name="NoiDung" required></textarea>
					@error('NoiDung')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="form-group" id="divDonVi">
					<label for="MaDonVi"><span class="badge badge-info">6</span> Nhân sự trực thuộc <span class="text-danger font-weight-bold">*</span></label>
					<select class="custom-select @error('MaDonVi') is-invalid @enderror" id="MaDonVi" name="MaDonVi">
						<option value="">-- Chọn đơn vị --</option>
						@foreach($hrm_donvi as $value)
							<option value="{{ $value->ID }}">{{ $value->TenDonVi }}</option>
						@endforeach
					</select>
					@error('MaDonVi')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="form-group" id="divDinhKem">
					<label for="DinhKem"><span class="badge badge-info">6</span> Văn bản đính kèm <span class="text-danger font-weight-bold">*</span></label>
					<div class="form-row add-more-after">
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><a href="#taptin" onclick="BrowseServer(1);">Chọn tập tin</a></div>
								</div>
								<input type="text" class="form-control" id="DinhKem1" name="DinhKem[]" value="" readonly />
								<div class="input-group-append">
									<button class="btn btn-primary btn-add-more" type="button"><i class="fal fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<input type="text" class="form-control" id="TenVanBan1" name="TenVanBan[]" value="" placeholder="Tên văn bản (bắt buộc)" />
						</div>
					</div>
					<div class="copy d-none">
						<div class="form-row">
							<div class="form-group col-md-6">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><a href="#taptin" onclick="">Chọn tập tin</a></div>
									</div>
									<input type="text" class="form-control" id="" name="DinhKem[]" value="" readonly />
									<div class="input-group-append">
										<button class="btn btn-danger btn-remover" type="button"><i class="fal fa-times"></i></button>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" id="" name="TenVanBan[]" value="" placeholder="Tên văn bản (bắt buộc)" />
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox" id="QuanTrong" name="QuanTrong" value="1" />
						<label class="custom-control-label" for="QuanTrong">Ghim bài viết lên trên cùng</label>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Đăng bài viết</button>
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
			
			var index = 2;
			$(".btn-add-more").click(function() {
				$(".copy input[name^='DinhKem']").attr("id", "DinhKem" + index);
				$(".copy input[name^='TenVanBan']").attr("id", "TenVanBan" + index);
				$(".copy a").attr("onclick", "BrowseServer(" + index + ");");
				index++;
				
				var html = $(".copy").html();
				$(".add-more-after").after(html);
			});
			$("body").on("click", ".btn-remover", function() {
				$(this).parents(".form-row").remove();
			});
		});
		
		function escapeHtml(unsafe)
		{
			return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		function BrowseServer(index)
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
						var output = document.getElementById("DinhKem" + index);
						output.value = escapeHtml(file.get('name'));
					});
					finder.on('file:choose:resizedImage', function(evt) {
						var output = document.getElementById("DinhKem" + index);
						output.value = escapeHtml(evt.data.file.get('name'));
					});
				}
			});
		}
	</script>
@endsection