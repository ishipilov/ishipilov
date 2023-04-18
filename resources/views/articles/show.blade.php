@extends('layouts.templates.default')

@section('page-title', $article->titleSub)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if ($article->title)
                <h5 class="card-title">
                    <span class="mr-1">
                        {{ $article->title }}
                    </span>
                    @if (! $article->isPublished)
                        <i class="fa-regular fa-fw fa-eye-slash text-muted"></i>
                    @endif
                </h5>
            @endif
            <article>{!! $article->text !!}</article>
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
    </div>
</div>
@endsection

@push('head')
<style>
    article iframe.note-video-clip {
        max-width: 100%;
    }
</style>
@endpush