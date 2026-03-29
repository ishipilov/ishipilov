@extends('layouts.templates.default')

@section('content')
<div class="container">

  <nav class="nav mb-3">
    <a class="nav-link" href="{{ route('admin.roles.create') }}">{{ __('routes.web.admin.roles.create') }}</a>
  </nav>

  <div class="card mb-3">
    <div class="list-group list-group-flush">
      @foreach ($roles as $role)
        <a href="{{ route('admin.roles.edit', $role) }}" class="list-group-item list-group-item-action">
          <span class="badge badge-primary">{{ $role->name }}</span>
          @foreach($role->getPermissionNames() as $permission_name)
            <span class="badge badge-secondary">{{ $permission_name }}</span>
          @endforeach
        </a>
      @endforeach
    </div>
  </div>

</div>
@endsection