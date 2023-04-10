@extends('layouts.templates.default')

@section('content')
<div class="container">
  <ul class="list-group">
    @foreach ($users as $user)
      <li class="list-group-item">
        <p>
          <span class="text-muted mr-1">{{ $user->id }}</span>
          <span class="mr-1">{{ $user->name }}</span>
          <a href="mailto:{{ $user->email }}" class="text-decoration-none mr-1">{{ $user->email }}</a>
        </p>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.login_as', $user) }}" role="button">{{ __('Login as') }}</a>
      </li>
    @endforeach
  </ul>
</div>
@endsection