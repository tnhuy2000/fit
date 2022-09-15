@extends('layouts.admin')

@section('pagetitle')
	Register
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">{{ __('Register') }}</div>
					<div class="card-body">
						<form method="post" action="{{ route('register') }}">
							@csrf
							<div class="form-group">
								<label for="name"><span class="badge badge-info">1</span> {{ __('Name') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
								@error('name')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="username"><span class="badge badge-info">2</span> {{ __('Username') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required />
								@error('username')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="email"><span class="badge badge-info">3</span> {{ __('E-Mail address') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="password"><span class="badge badge-info">4</span> {{ __('Password') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="password-confirm"><span class="badge badge-info">5</span> {{ __('Confirm password') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" required />
								@error('password_confirmation')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary"><i class="fal fa-user-plus"></i> {{ __('Register') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection