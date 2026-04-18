@extends('layouts.templates.default')

@section('content')
<div class="container">

    <nav class="nav mb-3">
      <a href="{{ route('admin.permissions.destroy', $permission) }}" class="nav-link text-danger"
        onclick="event.preventDefault(); let confirmed = confirm('Delete?'); if (confirmed) { document.getElementById('delete-permission-{{ $permission->id }}').submit(); }">
        {{ __('routes.web.admin.permissions.destroy') }}
      </a>
      <form id="delete-permission-{{ $permission->id }}" action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-none">
        @method('DELETE')
        @csrf
      </form>
    </nav>

    <div class="card mb-3">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
          @method('PATCH')
          @csrf
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-sm-right">{{ __('Name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">{{ __('routes.web.admin.permissions.update') }}</button>
        </form>
      </div>
    </div>

</div>
@endsection