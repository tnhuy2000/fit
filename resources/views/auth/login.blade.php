@extends('layouts.admin')

@section('pagetitle')
	Đăng nhập
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Đăng nhập</div>
					<div class="card-body">
						@if(session('warning'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
								<span class="font-weight-bold text-danger"><i class="fal fa-exclamation-triangle"></i> {{ session('warning') }}</span>
							</div>
						@endif
						<a class="btn btn-lg btn-warning d-block mb-3" href="{{ route('google.login') }}" role="button"><i class="fab fa-google"></i> Đăng nhập bằng AGU email</a>
						<a class="btn btn-lg btn-primary d-block" href="#login-form" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="login-form"><i class="fal fa-user-circle"></i> Đăng nhập bằng tài khoản FIT</a>
						<form method="post" action="{{ route('login') }}" class="collapse mt-3" id="login-form">
							@csrf
							<div class="form-group">
								<label for="email"><span class="badge badge-info">1</span> Tài khoản <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Email hoặc Tên đăng nhập" required />
								@if ($errors->has('email') || $errors->has('username'))
									<span class="invalid-feedback" role="alert"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></span>
								@endif
							</div>
							<div class="form-group">
								<label for="password"><span class="badge badge-info">2</span> Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="feedback-recaptcha"><span class="badge badge-info">3</span> Xác thực đăng nhập <span class="text-danger font-weight-bold">*</span></label>
								<div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-size="normal" data-theme="light"></div>
								@error('g-recaptcha-response')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
									<label class="custom-control-label" for="remember">Duy trì đăng nhập</label>
								</div>
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-info"><i class="fal fa-sign-in-alt"></i> Đăng nhập</button>
								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	<script src="https://www.google.com/recaptcha/api.js?hl=vi" async defer></script>
@endsection