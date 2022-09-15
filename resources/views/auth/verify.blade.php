@extends('layouts.admin')

@section('pagetitle')
	Verify your email address
@endsection

@section('content')
	<div class="card">
		<div class="card-header">{{ __('Verify your email address') }}</div>
		<div class="card-body">
			@if (session('resent'))
				<div class="alert alert-success" role="alert">
					<i class="fal fa-info-circle"></i> {{ __('A fresh verification link has been sent to your email address.') }}
				</div>
			@endif
			{{ __('Before proceeding, please check your email for a verification link.') }}
			{{ __('If you did not receive the email') }},
			<form class="d-inline" method="post" action="{{ route('verification.resend') }}">
				@csrf
				<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
			</form>
		</div>
	</div>
@endsection