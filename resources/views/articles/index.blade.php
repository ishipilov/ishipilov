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
@endsection