@component('mail::message')
# Introduction

Hola {{ $user->name  }},
Welcome to tasques.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
