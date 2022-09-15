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
						@if(session('status'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
								<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> {{ session('status') }}</span>
							</div>
						@endif
						<form method="post" action="{{ route('password.email') }}">
							@csrf
							<div class="form-group">
								<label for="email"><span class="badge badge-info">1</span> Địa chỉ Email <span class="text-danger font-weight-bold">*</span></label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group">
								<label for="feedback-recaptcha"><span class="badge badge-info">2</span> Xác thực người dùng <span class="text-danger font-weight-bold">*</span></label>
								<div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-size="normal" data-theme="light"></div>
								@error('g-recaptcha-response')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary"><i class="fal fa-paper-plane"></i> Gởi liên kết khôi phục mật khẩu</button>
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