@extends('layouts.templates.default')

@section('content')
<div class="container">

    <nav class="nav mb-3">
      <a href="{{ route('admin.roles.destroy', $role) }}" class="nav-link text-danger"
        onclick="event.preventDefault(); let confirmed = confirm('Delete?'); if (confirmed) { document.getElementById('delete-role-{{ $role->id }}').submit(); }">
        {{ __('routes.web.admin.roles.destroy') }}
      </a>
      <form id="delete-role-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-none">
        @method('DELETE')
        @csrf
      </form>
    </nav>

    <div class="card mb-3">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
          @method('PATCH')
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-sm-right">{{ __('Name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}">
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-sm-right">{{ __('Permissions') }}</label>
            <div class="col-sm-10 ">
              @foreach ($allPermissions as $permission)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="permission{{ $permission->id }}" name="permissions[]" @if ($role->hasPermissionTo($permission)) checked @endif>
                  <label class="form-check-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <button type="submit" class="btn btn-primary">{{ __('routes.web.admin.roles.update') }}</button>
        </form>
      </div>
    </div>

</div>
@endsection