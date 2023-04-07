@extends('layouts.templates.default')

@section('page-title', $article->titleSub)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if ($article->title)
                <h5 class="card-title">{{ $article->title }}</h5>
            @endif
            <article>
                {!! $article->text !!}
            </article>
            <div>
                <hr>
                <small class="text-muted">
                    {{ DateHelper::isoFormat($article->updated_at) }}
                    &mdash;
                    {{ $article->user->name }}
                </small>
            </div>
        </div>
        @canany(['update'], $article)
            <div class="card-body">
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="card-link">{{ __('Edit') }}</a>
                @endcan
            </div>
        @endcanany
        @if ($article->isPublished)
            <div class="card-footer text-muted small">
                <i class="fa-solid fa-eye mr-1"></i>
                {{ $article->publishedDate }}
            </div>
        @endif
    </div>
</div>
@endsection