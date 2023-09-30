@extends('layouts.templates.default')

@section('content')
<div class="container">

    @if ($shoppingList->isEmpty())
        <div class="p-3">{{ __('Empty') }}</div>
    @else
        <div class="list-group mb-3">
            @foreach ($shoppingList as $item)
                @can('view', $item)
                    <a href="{{ route('shoppinglist.toggle', $item) }}" class="list-group-item list-group-item-action @if($item->options['active']) active @endif">
                        {{ $item->text }}
                    </a>
                @endcan
            @endforeach
        </div>
    @endif
	<form method="POST" action="{{ route('shoppinglist.store') }}">
		@csrf
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" id="text" name="text" class="form-control form-control-lg">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">{{ __('Store') }}</button>
                </div>
            </div>
        </div>
    </form>
    
</div>
@endsection