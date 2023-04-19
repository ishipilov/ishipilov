<x-mail::message>
# Dear {{ $name }}

{{ $text }}

<x-mail::button :url="$link">
Go to register form
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
