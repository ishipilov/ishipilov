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
      <dl class="row mb-0">
        <dt class="col-sm-3">{{ __('ID') }}</dt>
        <dd class="col-sm-9">{{ $user->id }}</dd>
        <dt class="col-sm-3">{{ __('Name') }}</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>
        <dt class="col-sm-3">{{ __('Email') }}</dt>
        <dd class="col-sm-9"><a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a></dd>
        <dt class="col-sm-3">{{ __('Email verified at') }}</dt>
        <dd class="col-sm-9">{{ DateHelper::isoFormat($user->email_verified_at, "Do MMMM Y HH:mm:ss") }}</dd>
        <dt class="col-sm-3">{{ __('Created at') }}</dt>
        <dd class="col-sm-9">{{ DateHelper::isoFormat($user->created_at, "Do MMMM Y HH:mm:ss") }}</dd>
        <dt class="col-sm-3">{{ __('Updated at') }}</dt>
        <dd class="col-sm-9">{{ DateHelper::isoFormat($user->updated_at, "Do MMMM Y HH:mm:ss") }}</dd>
        @if ($user->deleted_at)
          <dt class="col-sm-3">{{ __('Deleted at') }}</dt>
          <dd class="col-sm-9">{{ DateHelper::isoFormat($user->deleted_at, "Do MMMM Y HH:mm:ss") }}</dd>
        @endif
      </dl>

      @if ($user->roles->count())
        <dl class="row mb-0">
          <dt class="col-sm-3">{{ __('Roles with permissions') }}</dt>
          <dd class="col-sm-9">
            @foreach($user->roles as $role)
              <dl class="row mb-0">
                <dt class="col-sm-3">
                  <span class="badge badge-primary">{{ $role->name }}</span>
                </dt>
                <dd class="col-sm-9">
                  @foreach($role->getPermissionNames() as $permission_name)
                    <span class="badge badge-secondary">{{ $permission_name }}</span>
                  @endforeach
                </dd>
              </dl>
            @endforeach
          </dd>
        </dl>
      @endif

      @if ($user->getDirectPermissions()->count())
        <dl class="row mb-0">
          <dt class="col-sm-3">{{ __('Direct Permissions') }}</dt>
          <dd class="col-sm-9">
            @foreach($user->getDirectPermissions() as $permission)
              <span class="badge badge-secondary">{{ $permission->name }}</span>
            @endforeach
          </dd>
        </dl>
      @endif
    </div>
  </div>

</div>
@endsection