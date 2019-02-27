@component('mail::message')
# Tasca completada

S'ha marcat com a completada la tasca {{ $task->name }}

@component('mail::button', ['url' => url('/tasques')])
Veure tasca
@endcomponent

Gràcies,<br>
{{ $user->name }}
@endcomponent
