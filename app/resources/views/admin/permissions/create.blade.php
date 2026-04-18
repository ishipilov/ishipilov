@extends('layouts.templates.default')

@section('content')
<div class="container">

    <div class="card mb-3">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.permissions.store') }}">
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-sm-right">{{ __('Name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">{{ __('routes.web.admin.permissions.store') }}</button>
        </form>
      </div>
    </div>

</div>
@endsection