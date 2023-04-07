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
                        <a class="text-decoration-none" href="{{ route('articles.show', $article) }}">
                            @if ($article->user == Auth::user())
                                @if (! $article->isPublished)
                                    <i class="fa-solid fa-eye-slash mr-1"></i>
                                @endif
                                <span class="font-weight-bold">{{ $article->titleSub }}</span>
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
@endsection