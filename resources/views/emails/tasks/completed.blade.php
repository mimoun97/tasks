@component('mail::message')
# Tasca completada

S'ha marcat com a completada la tasca {{ $task->name }}

@component('mail::button', ['url' => url('/tasques/' . $task->id)])
Veure tasca
@endcomponent

Gràcies,<br>
{{ config('app.name') }}
@endcomponent
