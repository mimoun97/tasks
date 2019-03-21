@extends('layouts.app')

@section('title', 'Chat')

@section('content')

<v-container fluid fill-height>
    <chat :channels="{{ $channels }}"></chat>
</v-container>

@endsection