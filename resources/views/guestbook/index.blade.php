@extends('layouts.templates.default')

@section('content')
<div class="container">
    
    @include('guestbook.subviews.list', [ 'guestbook' => $guestbook ])
    
</div>
@endsection