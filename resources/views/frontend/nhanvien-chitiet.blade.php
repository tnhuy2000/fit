@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="{{ $hrm_nhanvien->HoVaTen }}" />
	<meta property="og:description" content="Hồ sơ khoa học của cán bộ giảng viên {{ $hrm_nhanvien->HoVaTen }}." />
	<meta name="description" content="Hồ sơ khoa học của cán bộ giảng viên {{ $hrm_nhanvien->HoVaTen }}." />
@endsection

@section('title', $hrm_nhanvien->HoVaTen)

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li class="active"><a href="{{ route('nhansu') }}"><i class="fal fa-users"></i> Cán bộ giảng viên</a></li>
				</ul>
			</div>
			<div class="page-title">
				<h1>{{ $hrm_nhanvien->HoVaTen }}</h1>
			</div>
		</div>
	</section>
	
	<section id="section-staff" class="p-t-30 p-b-0">
		<div class="container">
			<div class="staff">
				<div class="row">
					<div class="col-sm-4 col-md-3">
						<div class="staff-image">
							@if(!empty($hrm_nhanvien->HinhAnh))
								<img src="{{ $staffs_path . strstr($hrm_nhanvien->Email, '@', true) . '/' . $hrm_nhanvien->HinhAnh }}" class="rounded" />
							@else
								<img src="{{ $no_photo }}" class="rounded" />
							@endif
						</div>
					</div>
					<div class="col-sm-8 col-md-9">
						<div class="staff-description">
							<div class="staff-category">{{ $hrm_nhanvien->HocVi }}</div>
							<div class="staff-title"><h3>{{ $hrm_nhanvien->HoVaTen }}</h3></div>
							<div class="seperator m-t-0 m-b-10"></div>
							<div class="staff-meta">
								<ul class="list-icon list-icon-colored">
									@if(!empty($hrm_nhanvien->ChuyenNganh))
										<li><i class="fal fa-fw fa-book-alt"></i>Chuyên ngành: {{ $hrm_nhanvien->ChuyenNganh }}</li>
									@endif
									@if(!empty($hrm_nhanvien->Email))
										<li><i class="fal fa-fw fa-envelope"></i>Email: {{ str_replace("@", "[at]", $hrm_nhanvien->Email) }}</li>
									@endif
									@if(!empty($hrm_nhanvien->TrangWeb))
										<li><i class="fal fa-fw fa-external-link"></i>Trang web: <a href="{{ $hrm_nhanvien->TrangWeb }}" target="_blank">{{ $hrm_nhanvien->TrangWeb }}</a></li>
									@endif
									@if(!empty($hrm_nhanvien->LuotXem))
										<li><i class="fal fa-fw fa-eye"></i>Lượt truy cập: {{ $hrm_nhanvien->LuotXem }}</li>
									@endif
									@if($hrm_nhanvien->TrangThai == 0)
										<li><i class="fal fa-fw fa-info-circle"></i>Thông tin khác: <span class="text-danger font-weight-bold">Đã chuyển công tác</span>.</li>
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			@if(!$hrm_quatrinhcongtac->isEmpty())
				<div class="heading-text heading-section text-center heading-line">
					<h4>Quá trình công tác</h4>
				</div>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:20%;">Thời gian</th>
							<th style="width:80%;">Nội dung công việc</th>
						</tr>
					</thead>
					<tbody>
						@foreach($hrm_quatrinhcongtac as $value)
							<tr>
								<td>{{ $value->ThoiGian }}</td>
								<td>{{ $value->NoiDungCongViec }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
			
			@if(!$hrm_baibaokhoahoc->isEmpty())
				<div class="heading-text heading-section text-center heading-line">
					<h4>Bài báo khoa học</h4>
				</div>
				<div class="card shadow-none">
					<div class="card-body pb-0">
						<ul class="timeline-customize">
							@foreach($hrm_baibaokhoahoc as $value)
								<li class="timeline-item">
									<div class="timeline-icon">{{ $loop->iteration }}</div>
									<h4>{{ $value->TenBaiBao }}</h4>
									<div class="timeline-item-date">{{ $value->NamXuatBan }} - {{ $value->LoaiBaiBao }}</div>
									<p>
										Tác giả: {{ $value->TacGiaNhomTacGia }}; Nơi đăng: {{ $value->NoiDang }}; Mã số: {{ $value->So }};
										@if(!empty($value->LienKet))
											Trang: {{ $value->TuTrangDenTrang }}; Liên kết: {{ $value->LienKet }}.
										@else
											Trang: {{ $value->TuTrangDenTrang }}.
										@endif
									</p>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
			
			@if(!$hrm_detaikhoahoc->isEmpty())
				<div class="heading-text heading-section text-center heading-line">
					<h4>Đề tài khoa học</h4>
				</div>
				<div class="card shadow-none">
					<div class="card-body pb-0">
						<ul class="timeline-customize">
							@foreach($hrm_detaikhoahoc as $value)
								<li class="timeline-item">
									<div class="timeline-icon">{{ $loop->iteration }}</div>
									<h4>{{ $value->TenCongTrinh }}</h4>
									<div class="timeline-item-date">{{ $value->NamNghiemThu }} - {{ $value->CapQuanLy }}</div>
									<p>
										@php
											$thongTin = array();
											$thongTin[] = 'Chủ nhiệm: ' . $value->ChuNhiem;
											if(!empty($value->ThanhVienThamGia)) $thongTin[] = 'Thành viên: ' . $value->ThanhVienThamGia;
											if(!empty($value->LienKet)) $thongTin[] = 'Liên kết: ' . $value->LienKet;
											$thongTinDeTaiStr = implode('; ', $thongTin);
										@endphp
										{{ $thongTinDeTaiStr }}.
									</p>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
			
			@if(!$hrm_sachgiaotrinhtailieu->isEmpty())
				<div class="heading-text heading-section text-center heading-line">
					<h4>Sách - Giáo trình - Tài liệu</h4>
				</div>
				<div class="card shadow-none">
					<div class="card-body pb-0">
						<ul class="timeline-customize">
							@foreach($hrm_sachgiaotrinhtailieu as $value)
								<li class="timeline-item">
									<div class="timeline-icon">{{ $loop->iteration }}</div>
									<h4>{{ $value->Ten }}</h4>
									<div class="timeline-item-date">{{ $value->NamXuatBan }} - {{ $value->PhanLoai }}</div>
									<p>
										@php
											$thongTin = array();
											$thongTin[] = 'Tác giả: ' . $value->TacGiaNhomTacGia;
											if(!empty($value->NhaXuatBan)) $thongTin[] = 'Nhà xuất bản: ' . $value->NhaXuatBan;
											if(!empty($value->ISBN)) $thongTin[] = 'ISBN: ' . $value->ISBN;
											if(!empty($value->LienKet)) $thongTin[] = 'Liên kết: ' . $value->LienKet;
											$thongTinSanPhamStr = implode('; ', $thongTin);
										@endphp
										{{ $thongTinSanPhamStr }}.
									</p>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
			
			@if(!$hrm_huongdansaudaihoc->isEmpty())
				<div class="heading-text heading-section text-center heading-line">
					<h4>Hướng dẫn sau đại học</h4>
				</div>
				<div class="card shadow-none">
					<div class="card-body pb-0">
						<ul class="timeline-customize">
							@foreach($hrm_huongdansaudaihoc as $value)
								<li class="timeline-item">
									<div class="timeline-icon">{{ $loop->iteration }}</div>
									<h4>{{ $value->TenDeTai }}</h4>
									<div class="timeline-item-date">{{ $value->NamHuongDan }} - {{ $value->NamBaoVe }}</div>
									<p>
										Họ tên học viên: {{ $value->HoTenHocVien }}; Trình độ: {{ $value->TrinhDo }}; Cơ sở đào tạo: {{ $value->CoSoDaoTao }}.
									</p>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_STAFF') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_STAFF') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection