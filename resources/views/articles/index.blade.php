@extends('layouts.templates.default')

@section('content')
<div class="container">
    <nav class="nav">
        @can('create', \App\Models\Article::class)
            <a class="nav-link" href="{{ route('articles.create') }}">{{ __('Create') }}</a>
        @endcan
    </nav>

    @include('articles.subviews.list', [ 'articles' => $articles ])
    
</div>
@endsection