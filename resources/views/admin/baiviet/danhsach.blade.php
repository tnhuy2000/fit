@extends('layouts.admin')

@section('pagetitle')
	Danh sách bài viết
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.baiviet.home') }}">Quản lý bài viết</a> <i class="fal fa-angle-double-right"></i> Danh sách bài viết</div>
		<div class="card-body">
			<p><a href="{{ route('admin.baiviet.them') }}" class="btn btn-primary"><i class="fal fa-plus"></i> Thêm</a></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="4%">#</th>
						<th width="15%">Chủ đề</th>
						<th width="65%">Thông tin bài viết</th>
						<th width="4%" title="Bài viết quan trọng">Top</th>
						<th width="4%">O/F</th>
						<th width="4%">Sửa</th>
						<th width="4%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms_baiviet as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->CMS_ChuDe->TenChuDe }}</td>
							<td class="text-justify">
								<span class="font-weight-bold text-primary"><a href="{{ route('admin.baiviet.sua', ['id' => $value->ID]) }}">{{ $value->TieuDe }}</a></span>
								<span class="small">
									@if(!empty($value->CMS_LoaiBaiViet->TenLoai))
										<br />Loại bài viết: {{ $value->CMS_LoaiBaiViet->TenLoai }}
										@if($value->MaLoai == 2)
											(<a href="{{ route('admin.baiviet.vanban', ['id' => $value->ID]) }}">Chỉnh sửa văn bản</a>)
										@endif
									@endif
									@if(!empty($value->created_at))
										<br />Ngày đăng: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}
									@endif
									@if(!empty($value->MaNguoiDung))
										<br />Người đăng: {{ $value->SYS_NguoiDung->name }}
									@endif
									@if(!empty($value->LuotXem))
										<br />Có {{ $value->LuotXem }} lượt xem
									@endif
								</span>
							</td>
							<td class="text-center">
								@if($value->QuanTrong == 1)
									<a href="{{ route('admin.baiviet.quantrong', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Bài viết quan trọng"></i></a>
								@else
									<a href="{{ route('admin.baiviet.quantrong', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bài viết bình thường"></i></a>
								@endif
							</td>
							<td class="text-center">
								@if($value->KichHoat == 1)
									<a href="{{ route('admin.baiviet.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-check-circle" title="Đang sử dụng"></i></a>
								@else
									<a href="{{ route('admin.baiviet.kichhoat', ['id' => $value->ID]) }}"><i class="fal fa-ban text-danger" title="Bị khóa"></i></a>
								@endif
							</td>
							<td class="text-center"><a href="{{ route('admin.baiviet.sua', ['id' => $value->ID]) }}"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->ID }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.baiviet.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="ID_delete" name="ID_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa bài viết</h5>
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
		function getXoa(id) {
			$('#ID_delete').val(id);
		}
	</script>
@endsection