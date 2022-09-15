@extends('layouts.admin')

@section('pagetitle')
	Confirm password
@endsection

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">{{ __('Confirm password') }}</div>
					<div class="card-body">
						{{ __('Please confirm your password before continuing.') }}
						<form method="post" action="{{ route('password.confirm') }}">
							@csrf
							<div class="form-group">
								<label for="password"><span class="badge badge-info">1</span> {{ __('Password') }} <span class="text-danger font-weight-bold">*</span></label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary"><i class="fal fa-check-circle"></i> {{ __('Confirm password') }}</button>
								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection