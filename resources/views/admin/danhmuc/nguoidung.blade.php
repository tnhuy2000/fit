@extends('layouts.admin')

@section('pagetitle')
	Danh sách người dùng
@endsection

@section('content')
	<div class="card">
		<div class="card-header"><a href="{{ route('admin.home') }}">Trang chủ quản trị</a> <i class="fal fa-angle-double-right"></i> <a href="{{ route('admin.danhmuc.home') }}">Quản lý danh mục</a> <i class="fal fa-angle-double-right"></i> Danh sách người dùng</div>
		<div class="card-body">
			<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button></p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Họ và tên</th>
						<th width="10%">Tên đăng nhập</th>
						<th width="20%">Email</th>
						<th width="10%">Quyền hạn</th>
						<th width="15%">Ngày tạo</th>
						<th width="15%">Ngày cập nhật</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sys_nguoidung as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->username }}</td>
							<td>{{ $value->email }}</td>
							<td>
								@if($value->privilege == "superadmin")
									<span class="badge badge-pill badge-danger">Toàn quyền</span>
								@elseif($value->privilege == "qldanhmuc")
									<span class="badge badge-pill badge-primary">QL Danh mục</span>
								@elseif($value->privilege == "qlbaiviet")
									<span class="badge badge-pill badge-success">QL Bài viết</span>
								@else
									<span class="badge badge-pill badge-warning">Cán bộ nhân viên</span>
								@endif
							</td>
							<td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}</td>
							<td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->format('d/m/Y H:i:s') }}</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{ $value->id }}, '{{ $value->name }}', '{{ $value->username }}', '{{ $value->email }}', '{{ $value->privilege }}'); return false;"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" onclick="getXoa({{ $value->id }}); return false;"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="{{ route('admin.danhmuc.nguoidung.them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm người dùng</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name"><span class="badge badge-info">1</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
							@error('name')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="username"><span class="badge badge-info">2</span> Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required />
							@error('username')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="email"><span class="badge badge-info">3</span> Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
							@error('email')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="password"><span class="badge badge-info">4</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
							@error('password')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="password_confirmation"><span class="badge badge-info">5</span> Xác nhận mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
							@error('password_confirmation')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="privilege"><span class="badge badge-info">6</span> Quyền hạn người dùng <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select @error('privilege') is-invalid @enderror" id="privilege" name="privilege" required>
								<option value="">-- Quyền hạn --</option>
								<option value="superadmin">Toàn quyền</option>
								<option value="qldanhmuc">Quản lý danh mục</option>
								<option value="qlbaiviet" selected>Quản lý bài viết</option>
								<option value="nhanvien">Cán bộ nhân viên</option>
							</select>
							@error('privilege')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.danhmuc.nguoidung.sua') }}" method="post">
		@csrf
		<input type="hidden" id="id_edit" name="id_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelEdit">Cập nhật thông tin người dùng</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="name_edit"><span class="badge badge-info">1</span> Họ và tên <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('name_edit') is-invalid @enderror" id="name_edit" name="name_edit" value="{{ old('name_edit') }}" required />
							@error('name_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="username_edit"><span class="badge badge-info">2</span> Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control @error('username_edit') is-invalid @enderror" id="username_edit" name="username_edit" value="{{ old('username_edit') }}" required />
							@error('username_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="email_edit"><span class="badge badge-info">3</span> Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="email" class="form-control @error('email_edit') is-invalid @enderror" id="email_edit" name="email_edit" value="{{ old('email_edit') }}" required />
							@error('email_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="password_edit"><span class="badge badge-info">4</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control @error('password_edit') is-invalid @enderror" id="password_edit" name="password_edit" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							@error('password_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="password_edit_confirmation"><span class="badge badge-info">5</span> Xác nhận mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control @error('password_edit_confirmation') is-invalid @enderror" id="password_edit_confirmation" name="password_edit_confirmation" placeholder="Bỏ trống sẽ giữ nguyên mật khẩu cũ" />
							@error('password_edit_confirmation')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="privilege_edit"><span class="badge badge-info">6</span> Quyền hạn người dùng <span class="text-danger font-weight-bold">*</span></label>
							<select class="custom-select @error('privilege_edit') is-invalid @enderror" id="privilege_edit" name="privilege_edit" required>
								<option value="">-- Quyền hạn --</option>
								<option value="superadmin">Toàn quyền</option>
								<option value="qldanhmuc">Quản lý danh mục</option>
								<option value="qlbaiviet">Quản lý bài viết</option>
								<option value="nhanvien">Cán bộ nhân viên</option>
							</select>
							@error('privilege_edit')
								<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<form action="{{ route('admin.danhmuc.nguoidung.xoa') }}" method="post">
		@csrf
		<input type="hidden" id="id_delete" name="id_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabelDelete">Xóa người dùng</h5>
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
		function getCapNhat(id, name, username, email, privilege) {
			$('#id_edit').val(id);
			$('#name_edit').val(name);
			$('#username_edit').val(username);
			$('#email_edit').val(email);
			$('#privilege_edit').val(privilege);
		}
		
		function getXoa(id) {
			$('#id_delete').val(id);
		}
		
		@if($errors->has('email') || $errors->has('name') || $errors->has('username') || $errors->has('password') || $errors->has('password_confirmation') || $errors->has('privilege'))
			$('#myModal').modal('show');
		@endif
		
		@if($errors->has('email_edit') || $errors->has('name_edit') || $errors->has('username_edit') || $errors->has('password_edit') || $errors->has('password_edit_confirmation') || $errors->has('privilege_edit'))
			$('#myModalEdit').modal('show');
		@endif
	</script>
@endsection