<div class="card mb-4">
	<div class="card-body">
		<form method="POST" action="{{ route('guestbook.store') }}" enctype="multipart/form-data">
			@csrf

			<!-- Guestbook -->
			<div class="form-group row">
				<label for="text" class="col-sm-2 col-form-label">{{ __('Guestbook') }}</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="guestbook-text" name="text" rows="6">{{ old('text') }}</textarea>
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