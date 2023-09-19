@extends('layouts.templates.default')

@section('content')
<div class="container">

    <vue-shopping_list url="{{ route('shoppinglist.index') }}"/>

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
