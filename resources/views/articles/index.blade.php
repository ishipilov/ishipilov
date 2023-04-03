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
                        <a class="text-decoration-none" href="{{ route('articles.show', $article) }}">{{ $article->titleSub }}</a>
                    </li>
                @endcan
            @endforeach
        </ul>
    @endif
</div>
@endsection