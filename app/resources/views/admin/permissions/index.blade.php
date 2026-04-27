@extends('layouts.templates.default')

@section('content')
<div class="container">

  <nav class="nav mb-3">
    <a class="nav-link" href="{{ route('admin.permissions.create') }}">{{ __('routes.web.admin.permissions.create') }}</a>
  </nav>

  <div class="card mb-3">
    <div class="list-group list-group-flush">
      @foreach ($permissions as $permission)
        <a href="{{ route('admin.permissions.edit', $permission) }}" class="list-group-item list-group-item-action">
          <span>{{ $permission->name }}</span>
        </a>
      @endforeach
    </div>
  </div>

</div>
@endsection