@component('mail::message')
# Tasca actualitzada

S'ha actualitzat la tasca {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Veure tasca
@endcomponent

Gràcies,<br>
{{ config('app.name') }}
@endcomponent


{{-- TODO link tasca email --}}