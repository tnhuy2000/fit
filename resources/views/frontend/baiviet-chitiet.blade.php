@extends('layouts.frontend')

@section('meta')
	<meta property="og:image" content="{{ asset('public/frontend/images/share.png') }}" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="150" />
	<meta property="og:image:height" content="150" />
	<meta property="og:title" content="{{ $cms_baiviet->TieuDe }}" />
	<meta property="og:description" content="Nhấn vào để xem thông tin chi tiết về bài viết {{ $cms_baiviet->TieuDe }}." />
	<meta name="description" content="Nhấn vào để xem thông tin chi tiết về bài viết {{ $cms_baiviet->TieuDe }}." />
@endsection

@section('title', $cms_baiviet->TieuDe)

@section('content')
	<section id="page-title" class="page-title-left p-t-10 p-b-10">
		<div class="container">
			<div class="breadcrumb">
				<ul>
					<li><a href="{{ route('home') }}"><i class="fal fa-home"></i> Trang chủ</a></li>
					<li><a href="{{ route('baiviet') }}"><i class="fal fa-newspaper"></i> Bài viết</a></li>
					<li class="active"><a href="{{ route('baiviet.chude',['chuDe' => $cms_baiviet->CMS_ChuDe->TenChuDeKhongDau]) }}"><i class="fal fa-tag"></i> {{ $cms_baiviet->CMS_ChuDe->TenChuDe }}</a></li>
				</ul>
			</div>
			<div class="page-title-small">
				<h1 class="text-justify">{{ $cms_baiviet->TieuDe }}</h1>
			</div>
		</div>
	</section>
	
	<section id="page-content" class="sidebar-right p-t-10 p-b-30">
		<div class="container">
			<div class="row">
				<div class="content col-lg-9">
					<div id="blog" class="single-post">
						<div class="post-item">
							<div class="post-item-wrap">
								<div class="post-item-description">
									<div class="post-meta">
										<span class="post-meta-date"><i class="fal fa-calendar-alt"></i>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cms_baiviet->created_at)->format('d/m/Y') }}</span>
										<span class="post-meta-comments"><i class="fal fa-eye"></i>{{ $cms_baiviet->LuotXem }} lượt xem</span>
									</div>
									@if(!empty($cms_baiviet->TomTat))
										<p class="text-justify"><strong>{!! $cms_baiviet->TomTat !!}</strong></p>
									@endif
									{!! $cms_baiviet->NoiDung !!}
									@if($cms_baiviet_vanban && count($cms_baiviet_vanban) > 0)
										<p><strong>Tập tin đính kèm bài viết:</strong></p>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-sm">
												<thead>
													<tr>
														<th width="5%">#</th>
														<th width="70%">Tên tài liệu</th>
														<th width="15%">Lượt tải</th>
														<th width="10%">Tải về</th>
													</tr>
												</thead>
												<tbody>
													@foreach($cms_baiviet_vanban as $value)
														<tr>
															<td>{{ $loop->iteration }}</td>
															<td>{{ $value->TenVanBan }}</td>
															<td class="text-center">{{ $value->LuotDownload }}</td>
															<td class="text-center">
																<a href="{{ route('vanban.taive') }}" onclick="event.preventDefault();document.getElementById('download-form-{{ $value->ID }}').submit();"><i class="fal fa-save fa-lg"></i></a>
																<form id="download-form-{{ $value->ID }}" action="{{ route('vanban.taive') }}" method="post" style="display:none;">
																	@csrf
																	<input type="hidden" name="id" value="{{ $value->ID }}" />
																</form>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									@endif
									@if($cms_baiviet_nhanvien && count($cms_baiviet_nhanvien) > 0)
										<p><strong>Nhân sự trực thuộc {{ $cms_baiviet->TieuDe }}:</strong></p>
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-sm">
												<thead>
													<tr>
														<th width="5%">#</th>
														<th width="35%">Họ và tên</th>
														<th width="30%">Chức vụ</th>
														<th width="30%">Chuyên ngành</th>
													</tr>
												</thead>
												<tbody>
													@php $stt = 1; @endphp
													@foreach($cms_baiviet_nhanvien as $value)
														@if($value->HRM_NhanVien->TrangThai == 1)
															<tr>
																<td>{{ $stt }}</td>
																<td><a href="{{ route('nhansu.chitiet', ['hoVaTenSlug' => $value->HRM_NhanVien->HoVaTenKhongDau]) }}">{{ $value->HRM_NhanVien->HoVaTen }}</a></td>
																<td>{{ $value->HRM_ChucVu->TenChucVu }}</td>
																<td>{{ $value->HRM_NhanVien->ChuyenNganh }}</td>
															</tr>
															@php $stt++; @endphp
														@endif
													@endforeach
												</tbody>
											</table>
										</div>
									@endif
								</div>
								<div class="post-navigation">
									@if($cms_baiviet_truoc)
										<a href="{{ route('baiviet.chitiet', ['chuDe' => $cms_baiviet_truoc->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_baiviet_truoc->TieuDeKhongDau . '-' . $cms_baiviet_truoc->ID . '.html']) }}" class="post-prev">
											<div class="post-prev-title"><span>Bài trước</span>{{ Str::limit($cms_baiviet_truoc->TieuDe, 30) }}</div>
										</a>
									@endif
									<a href="{{ route('baiviet.chude',['chuDe' => $cms_baiviet->CMS_ChuDe->TenChuDeKhongDau]) }}" class="post-all">
										<i class="icon-grid"></i>
									</a>
									@if($cms_baiviet_sau)
										<a href="{{ route('baiviet.chitiet', ['chuDe' => $cms_baiviet_sau->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $cms_baiviet_sau->TieuDeKhongDau . '-' . $cms_baiviet_sau->ID . '.html']) }}" class="post-next">
											<div class="post-next-title"><span>Bài sau</span>{{ Str::limit($cms_baiviet_sau->TieuDe, 30) }}</div>
										</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar sticky-sidebar col-lg-3">
					<div class="widget widget-categories">
						<h4 class="widget-title">Chuyên mục</h4>
						<ul class="list list-arrow-icons">
							@foreach($cms_chude_thongke as $value)
								<li><a href="{{ route('baiviet.chude', ['chuDe' => $value->TenChuDeKhongDau]) }}"><i class="fal fa-tag"></i> {{ $value->TenChuDe }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="widget">
						<h4 class="widget-title">Tin liên quan</h4>
						<div class="post-thumbnail-list">
							@foreach($cms_baiviet_lq as $value)
								<div class="post-thumbnail-entry">
									<img src="{{ $cms_baiviet_lq_first_file[$value->ID] }}" />
									<div class="post-thumbnail-content">
										<a class="text-justify" href="{{ route('baiviet.chitiet', ['chuDe' => $value->CMS_ChuDe->TenChuDeKhongDau, 'titleWithID' => $value->TieuDeKhongDau . '-' . $value->ID . '.html']) }}">{{ $value->TieuDe }}</a>
										<span class="post-date"><i class="fal fa-calendar-alt"></i> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</span>
										<span class="post-category"><i class="fal fa-eye"></i> {{ $value->LuotXem }} lượt xem</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('javascript')
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ARTICLE') }}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '{{ env('GOOGLE_ANALYTICS_ARTICLE') }}', { cookie_domain: 'fit.agu.edu.vn', cookie_flags: 'SameSite=None;Secure' });
	</script>
@endsection