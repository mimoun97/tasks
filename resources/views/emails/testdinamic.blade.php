@component('mail::message')
# Introduction

Hola {{ $user->name  }},

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi architecto assumenda at beatae error est explicabo labore pariatur
provident quo sed, sint, sunt, veniam? Blanditiis inventore nostrum pariatur quisquam voluptate!

@component('mail::button', ['url' => ''])

@endcomponent


@component('mail::panel')
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam at cumque dolore est facere maxime optio quibusdam
    sint tempore vero. Cumque cupiditate dolore magni minus non. Aliquid delectus temporibus veniam.

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
