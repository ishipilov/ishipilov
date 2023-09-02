@extends('layouts.templates.default')

@section('content')
<div class="container">

    <div class="list-group">
        @foreach($lotos as $loto)
            <a href="#" class="list-group-item list-group-item-action">
                <div class="lead">
                    @foreach($loto->result as $result)
                        <span class="badge badge-light">{{ $result }}</span>
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>

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
