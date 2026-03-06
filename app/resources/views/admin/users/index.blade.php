@extends('layouts.templates.default')

@section('content')
<div class="container">

  <nav class="nav mb-3">
    @can('create', \App\Models\User::class)
      <a class="nav-link" href="{{ route('admin.users.create') }}">{{ __('routes.web.admin.users.create') }}</a>
    @endcan
  </nav>

  <div class="table-responsive">
    <table class="table table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('Name and Email') }}</th>
          <th scope="col">{{ __('Roles with permissions') }}</th>
          <th scope="col">{{ __('Direct Permissions') }}</th>
          <th scope="col">{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>
              <div>{{ $user->name }}</div>
              <a href="mailto:{{ $user->email }}" class="text-decoration-none small">{{ $user->email }}</a>
            </td>
            <td>
              @foreach($user->roles as $role)
                <span class="badge badge-primary">{{ $role->name }}</span>
              @endforeach
            </td>
            <td>
              @foreach($user->getDirectPermissions() as $permission)
                <span class="badge badge-secondary">{{ $permission->name }}</span>
              @endforeach
            </td>
            <td>
              @can('update', $user)
                <a href="{{ route('admin.users.edit', $user) }}" class="d-block text-decoration-none">{{ __('routes.web.admin.users.edit') }}</a>
              @endcan
              @can('login as')
                <a href="{{ route('admin.users.login.as', $user) }}" class="d-block text-decoration-none">{{ __('Login as') }}</a>
              @endcan
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection