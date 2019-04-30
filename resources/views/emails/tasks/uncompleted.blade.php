@component('mail::message')
# Tasca pendent

S'ha marcat com a pendent la tasca {{ $task->name  }}

@component('mail::button', ['url' => url('/tasques/' . $task->id)])
Veure tasca
@endcomponent

Gràcies,<br>
{{ config('app.name') }}
@endcomponent
