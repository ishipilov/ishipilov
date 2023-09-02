@extends('layouts.templates.default')

@section('content')
<div class="container">

    <div class="list-group">
        @foreach($lotos as $loto)
            <a href="#" class="list-group-item list-group-item-action">
                {{ $loto->id }}
                <div class="d-flex flex-row">
                    @foreach($loto->result as $result)
                        <div class="lead text-center m-1 p-1 bg-light" style="width: 2rem;">{{ $result }}</div>
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
