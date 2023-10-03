@extends('layouts.templates.default')

@section('content')
<div class="container">

    <vue-shopping_list api_token="{{ $api_token }}" url_index="{{ $url_index }}" url_store="{{ $url_store }}">
    
</div>
@endsection