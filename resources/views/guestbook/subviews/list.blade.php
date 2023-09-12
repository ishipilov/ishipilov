@if ($guestbook->isEmpty())
    <div class="p-3">{{ __('Empty') }}</div>
@else
    <ul class="list-group">
        @foreach ($guestbook as $item)
            @can('view', $item)
                <li class="list-group-item">
                    {{ $item->text }}
                </li>
            @endcan
        @endforeach
    </ul>
@endif