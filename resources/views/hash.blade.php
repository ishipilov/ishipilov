@extends('layouts.templates.default')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Hash maker</h5>
            <h6 class="card-subtitle mb-3 text-muted">?q={{ $text }}</h6>
            <dl class="row">
                <dt class="col-sm-2">text</dt>
                <dd class="col-sm-10">{{ $text }}</dd>
                <dt class="col-sm-2">hash</dt>
                <dd class="col-sm-10">
                    @foreach ($hashes as $hash)
                        <div>{{ $hash }}</div>
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection