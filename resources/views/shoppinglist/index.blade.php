@extends('layouts.templates.default')

@section('content')
<div class="container">

    @if ($shoppingList->isEmpty())
        <div class="p-3">{{ __('Empty') }}</div>
    @else
        <ul class="list-group mb-3">
            @foreach ($shoppingList as $item)
                @can('view', $item)
                    <li class="list-group-item">
                        {{ $item->text }}
                    </li>
                @endcan
            @endforeach
        </ul>
    @endif
    <form>
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button">{{ __('Store') }}</button>
                </div>
            </div>
        </div>
    </form>
    
</div>
@endsection