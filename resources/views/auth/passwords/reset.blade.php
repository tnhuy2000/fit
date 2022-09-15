@extends('layouts.admin')

@section('pagetitle')
	Khôi phục mật khẩu
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Khôi phục mật khẩu</div>
					<div class="card-body">
						<form method="post" action="{{ route('password.update') }}">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}" />
							<div class="form-group">
								<label for="email"><span class="badge badge-info">1</span> Địa chỉ Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email ?? old('email') }}" required />
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="password"><span class="badge badge-info">2</span> Mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="password-confirm"><span class="badge badge-info">2</span> Xác nhận mật khẩu mới <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control" id="password-confirm" name="password_confirmation" required />
								@error('password_confirmation')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary"><i class="fal fa-exchange-alt"></i> Đổi mật khẩu</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection