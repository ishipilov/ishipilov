@extends('layouts.templates.default')

@section('content')
<div class="container">
	<div class="card mb-4">
		<div class="card-body">
			<form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<!-- Article -->
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="article-title" name="title" value="{{ old('title', $article->title) }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="text" class="col-sm-2 col-form-label">{{ __('Text') }}</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="article-text" name="text" rows="6">{{ old('text', $article->text) }}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10 offset-sm-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{ old('publish', $article->isPublished) ? 'checked' : '' }}>
              <label class="form-check-label" for="publish">{{ __('Publish') }}</label>
            </div>
					</div>
				</div>

				<!-- Buttons -->
				<div class="form-group row mb-0">
					<div class="offset-sm-2 col-sm-10">
						<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
					</div>
				</div>
			</form>
		</div>
        @canany(['delete'], $article)
            <div class="card-body">
                @can('delete', $article)
                    <a href="{{ route('articles.destroy', $article) }}" class="card-link" onclick="event.preventDefault();
                    if (confirm('Delete article?')) { document.getElementById('{{ 'article-delete-' . $article->id }}').submit(); }">{{ __('Delete') }}</a>
                    <form id="{{ 'article-delete-' . $article->id }}" action="{{ route('articles.destroy', $article) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endcan
            </div>
        @endcanany
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