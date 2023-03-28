@extends('layouts.templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <p class="card-text">{{ $article->text }}</p>
            <small>{{ $article->user->name }}</small>
        </div>
    </div>
</div>
@endsection