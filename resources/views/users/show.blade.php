@extends('layouts.templates.default')

@section('page-title', $user->name)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">{{ $user->name }}</h5>
            <h6 class="card-subtitle text-muted">{{ __('Articles') }}</h6>
        </div>
        @if ($articles->isEmpty())
            <div class="m-1 p-3">{{ __('Empty') }}</div>
        @else
            <ul class="list-group list-group-flush">
                @foreach ($articles as $article)
                    @can('view', $article)
                        <li class="list-group-item">
                            <a class="text-decoration-none" href="{{ route('articles.show', $article) }}">
                                @if ($article->user == Auth::user())
                                    <span class="font-weight-bold mr-1">{{ $article->titleSub }}</span>
                                    @if (! $article->isPublished)
                                    <i class="fa-regular fa-fw fa-eye-slash"></i>
                                    @endif
                                @else
                                    {{ $article->titleSub }}
                                @endif
                            </a>
                        </li>
                    @endcan
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection

@push('script')
<script type="text/javascript">
window.addEventListener('load', function() { $( document ).ready(function() {

    //

});});
</script>
@endpush

@push('head')
<style>
    
</style>
@endpush
