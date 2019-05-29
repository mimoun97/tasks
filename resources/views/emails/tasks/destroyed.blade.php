@component('mail::message')
# Tasca eliminada

S'ha eliminat la tasca {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Anar a tasques
@endcomponent

Gràcies,<br>
{{ config('app.name') }}
@endcomponent


{{-- TODO link tasca email --}}