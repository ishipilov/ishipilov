@extends('layouts.templates.default')

@section('content')
<div class="container">
    <nav class="nav mb-2">
    <a class="nav-link" href="{{ route('invitations.create') }}">{{ __('Create') }}</a>
    </nav>
    @if ($invitations->isEmpty())
        {{ __('Empty') }}
    @else
        <ul class="list-group">
            @foreach ($invitations as $invitation)
                @can('view', $invitation)
                    <li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <span>{{ $invitation->name }}</span>
                            <span class="text-muted">{{ $invitation->email }}</span>
                        </h5>
                        @if ($invitation->target_user)
                            <i class="fa-solid fa-fw fa-check ml-1"></i>
                        @else
                            <i class="fa-regular fa-fw fa-clock"></i>
                        @endif
                        </div>
                        <p class="mb-1">{{ $invitation->text }}</p>
                        <small class="text-muted">
                            {{ DateHelper::isoFormat($invitation->updated_at) }}
                            &mdash;
                            {{ $invitation->user->name }}
                        </small>
                        @if ($invitation->target_user)
                            <hr>
                            <dl class="row mb-0">
                                <dt class="col-sm-2">{{ __('ID') }}</dt>
                                <dd class="col-sm-10">{{ $invitation->target_user->id }}</dd>
                                <dt class="col-sm-2">{{ __('Name') }}</dt>
                                <dd class="col-sm-10">{{ $invitation->target_user->name }}</dd>
                                <dt class="col-sm-2">{{ __('Email') }}</dt>
                                <dd class="col-sm-10">{{ $invitation->target_user->email }}</dd>
                                <dt class="col-sm-2">{{ __('Created at') }}</dt>
                                <dd class="col-sm-10">{{ DateHelper::isoFormat($invitation->target_user->created_at) }}</dd>
                            </dl>
                        @endif
                    </li>
                @endcan
            @endforeach
        </ul>
    @endif
</div>
@endsection