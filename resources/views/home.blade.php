@extends('layouts.templates.default')

@section('content')
<div class="container">

    @component('articles.partials.list', [ 'articles' => $articles ])
    @endcomponent

</div>
@endsection

@push('script')
<script type="text/javascript">
window.addEventListener('load', function() { $( document ).ready(function() {

    //

});});
</script>
@endpush

@push('head')
<style>
    
</style>
@endpush
