@extends('layouts.templates.default')

@section('content')
<div class="container">
  <ul class="list-group">
    @foreach ($users as $user)
      <li class="list-group-item">
        <div class="mb-2">
          <span class="text-muted mr-1">{{ $user->id }}</span>
          <span class="mr-1">{{ $user->name }}</span>
          <a href="mailto:{{ $user->email }}" class="text-decoration-none mr-1">{{ $user->email }}</a>
        </div>
        <div class="btn-group btn-group-sm">
          <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ __('Actions') }}</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('admin.users.login_as', $user) }}">{{ __('Login as') }}</a>
            <a class="dropdown-item" href="{{ route('admin.users.generate_api_token', $user) }}">{{ __('Generate Api token') }}</a>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>
@endsection