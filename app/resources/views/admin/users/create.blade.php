@extends('layouts.templates.default')

@section('content')
  <div class="container">

    <form method="POST" action="{{ route('admin.users.store') }}" class="mb-3">
      @csrf
      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
      </div>

      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
      </div>

      <button type="submit" class="btn btn-primary">{{ __('routes.web.admin.users.store') }}</button>
    </form>
    
  </div>
@endsection