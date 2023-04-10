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
                            <span>
                                id {{ $invitation->target_user->id }}
                                <i class="fa-solid fa-fw fa-check ml-1"></i>
                            </span>
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
                    </li>
                @endcan
            @endforeach
        </ul>
    @endif
</div>
@endsection