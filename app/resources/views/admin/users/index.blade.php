@extends('layouts.templates.default')

@section('content')
<div class="container">

  <nav class="nav mb-3">
    @can('create', \App\Models\User::class)
      <a class="nav-link" href="{{ route('admin.users.create') }}">{{ __('routes.web.admin.users.create') }}</a>
    @endcan
  </nav>

  <div class="card mb-3">
    <div class="list-group list-group-flush">
      @foreach ($users as $user)
        <a href="{{ route('admin.users.show', $user) }}" class="list-group-item list-group-item-action">
          <div class="d-sm-flex justify-content-between">
            <div>
              <div><span class="text-muted small">{{ $user->id }}</span></div>
              <div><span>{{ $user->name }}</span></div>
              <div><span class="text-muted small">{{ $user->email }}</span></div>
            </div>
            <div>
              <div>
                @foreach($user->roles as $role)
                  <span class="badge badge-primary">{{ $role->name }}</span>
                @endforeach
              </div>
              <div>
                @foreach($user->getDirectPermissions() as $permission)
                  <span class="badge badge-secondary">{{ $permission->name }}</span>
                @endforeach
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>

</div>
@endsection