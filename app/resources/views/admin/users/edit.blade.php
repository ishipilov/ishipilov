@extends('layouts.templates.default')

@section('content')
  <div class="container">

    <nav class="nav mb-3">
      @can('delete', $user)
        <a href="{{ route('admin.users.destroy', $user) }}" class="nav-link text-danger"
          onclick="event.preventDefault(); let confirmed = confirm('Delete?'); if (confirmed) { document.getElementById('delete-user-{{ $user->id }}').submit(); }">
          {{ __('routes.web.admin.users.destroy') }}
        </a>
        <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-none">
          @method('DELETE')
          @csrf
        </form>
      @endcan
    </nav>

    <div class="card mb-3">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
          @method('PATCH')
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-sm-right">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-sm-right">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">{{ __('routes.web.admin.users.update') }}</button>
        </form>
      </div>
    </div>
    
    <div class="card mb-3">
      <div class="card-body">

        @can('assign role')
          <form method="POST" action="{{ route('admin.users.roles.assign', $user) }}" class="mb-4">
            @method('POST')
            @csrf
            <div class="input-group">
              <select class="custom-select" id="role" name="role">
                @foreach(\Spatie\Permission\Models\Role::all()->pluck('name') as $role)
                  <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">{{ __('Assign role') }}</button>
              </div>
            </div>
          </form>
        @endcan

        @if ($user->roles->count())
          <dl class="row mb-0">
            <dt class="col-sm-3">{{ __('Roles with permissions') }}</dt>
            <dd class="col-sm-9">
              @foreach($user->roles as $role)
                <dl class="row mb-0">
                  <dt class="col-sm-2">
                    <span class="badge badge-primary">{{ $role->name }}</span>
                  </dt>
                  <dd class="col-sm-6">
                    @foreach($role->getPermissionNames() as $permission_name)
                      <span class="badge badge-secondary">{{ $permission_name }}</span>
                    @endforeach
                  </dd>
                  @can('remove role')
                    <dd class="col-sm-4">
                      <a href="{{ route('admin.users.roles.remove', [$user, $role]) }}" class="text-decoration-none text-danger">
                        {{ __('Remove role') }}
                      </a>
                    </dd>
                  @endcan
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