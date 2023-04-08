@extends('layouts.templates.default')

@section('content')
<div class="container">
	<div class="card mb-4">
		<div class="card-body">
			<form method="POST" action="{{ route('invitations.store') }}" enctype="multipart/form-data">
				@csrf

				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="invitation-name" name="name" value="{{ old('name') }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
					<div class="col-sm-4">
						<input type="email" class="form-control" id="invitation-email" name="email" value="{{ old('email') }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="text" class="col-sm-2 col-form-label">{{ __('Text') }}</label>
					<div class="col-sm-4">
						<textarea class="form-control" id="invitation-text" name="text" rows="3">{{ old('text') }}</textarea>
					</div>
				</div>

				<!-- Buttons -->
				<div class="form-group row mb-0">
					<div class="offset-sm-2 col-sm-10">
						<button type="submit" class="btn btn-primary">{{ __('Store') }}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection