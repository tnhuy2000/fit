@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Cấm truy xuất</div>
		<div class="card-body">
			@if (session('error_message'))
				<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fal fa-exclamation-triangle"></i> Lỗi 403 - {{ session('error_message') }}
				</div>
			@endif
		</div>
	</div>
@endsection