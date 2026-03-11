@extends('layouts.templates.default')

@section('content')
<div class="container">

  <nav class="nav mb-3">
    @can('update', $user)
      <a class="nav-link" href="{{ route('admin.users.edit', $user) }}">{{ __('routes.web.admin.users.edit') }}</a>
    @endcan
    @can('login as')
      <a class="nav-link" href="{{ route('admin.users.login.as', $user) }}">{{ __('Login as') }}</a>
    @endcan
  </nav>
  
  <div class="card">
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">{{ __('ID') }}</dt>
        <dd class="col-sm-9">{{ $user->id }}</dd>
        <dt class="col-sm-3">{{ __('Name') }}</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>
        <dt class="col-sm-3">{{ __('Email') }}</dt>
        <dd class="col-sm-9"><a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a></dd>
      </dl>
    </div>
  </div>

</div>
@endsection