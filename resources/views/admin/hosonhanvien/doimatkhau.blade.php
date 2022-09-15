@extends('layouts.admin')

@section('pagetitle')
	Đổi mật khẩu
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Đổi mật khẩu</div>
					<div class="card-body">
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
								<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> {{ session('success') }}</span>
							</div>
						@endif
						@if(session('warning'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
								<span class="font-weight-bold text-danger"><i class="fal fa-exclamation-triangle"></i> {{ session('warning') }}</span>
							</div>
						@endif
						<form role="form" method="post" action="{{ route('admin.hosonhanvien.doimatkhau') }}">
							@csrf
							<div class="form-group">
								<label for="old_password"><span class="badge badge-info">1</span> Mật khẩu cũ <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required />
								@error('old_password')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group">
								<label for="new_password"><span class="badge badge-info">2</span> Mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required />
								@error('new_password')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							<div class="form-group">
								<label for="new_password_confirmation"><span class="badge badge-info">3</span> Xác nhận mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required />
								@error('new_password_confirmation')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
								@enderror
							</div>
							
							<button type="submit" class="btn btn-primary"><i class="fal fa-edit"></i> Đổi mật khẩu</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection