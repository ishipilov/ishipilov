@extends('layouts.templates.default')

@section('content')
<div class="container">
	<div class="card mb-4">
		<div class="card-body">
			<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
				@csrf

				<!-- Article -->
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="article-title" name="title" value="{{ old('title') }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="text" class="col-sm-2 col-form-label">{{ __('Text') }}</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="article-text" name="text" rows="6">{{ old('text') }}</textarea>
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

@push('script')
<script type="text/javascript">
window.addEventListener('load', function() { $( document ).ready(function() {

	$('#article-text').summernote({
		
	});

});});
</script>
@endpush