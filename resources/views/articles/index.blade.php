@extends('layouts.templates.default')

@section('content')
<div class="container">
    @if ($articles->isEmpty())
        {{ __('Empty') }}
    @else
        <ul class="list-group">
            @foreach ($articles as $article)
                @can('view', $article)
                    <li class="list-group-item">
                        <h5>{{ $article->title }}</h5>
                        @canany(['view', 'update', 'delete'], $article)
                            <div class="btn-group btn-group-sm" role="group">
                                @can('view', $article)
                                    <a class="btn btn-primary" href="{{ route('articles.show', $article) }}" role="button">{{ __('Show') }}</a>
                                @endcan
                                @can('update', $article)
                                    <a class="btn btn-warning" href="{{ route('articles.edit', $article) }}" role="button">{{ __('Edit') }}</a>
                                @endcan
                                @can('delete', $article)
                                    <a class="btn btn-danger" href="{{ route('articles.destroy', $article) }}" role="button"
                                    onclick="event.preventDefault();
                                    document.getElementById('{{ 'article-delete-' . $article->id }}').submit();">{{ __('Delete') }}</a>
                                    <form id="{{ 'article-delete-' . $article->id }}" action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endcan
                            </div>
                        @endcanany
                    </li>
                @endcan
            @endforeach
        </ul>
    @endif
</div>
@endsection