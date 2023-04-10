@extends('layouts.templates.default')

@section('page-title', $invitation->id)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">{{ __('Name') }}</dt>
                <dd class="col-sm-10">{{ $invitation->name }}</dd>
                <dt class="col-sm-2">{{ __('Email') }}</dt>
                <dd class="col-sm-10">{{ $invitation->email }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">{{ __('Next') }}</dt>
                <dd class="col-sm-10">{{ $invitation->text }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">{{ __('Link') }}</dt>
                <dd class="col-sm-10"></dd>
            </dl>
            <div>
                <hr>
                <small class="text-muted">
                    {{ DateHelper::isoFormat($invitation->updated_at) }}
                    &mdash;
                    {{ $invitation->user->name }}
                </small>
            </div>
        </div>
        @canany(['update'], $invitation)
            <div class="card-body">
                @can('update', $invitation)
                    <a href="{{ route('invitations.edit', $invitation) }}" class="card-link">{{ __('Edit') }}</a>
                @endcan
            </div>
        @endcanany
    </div>
</div>
@endsection