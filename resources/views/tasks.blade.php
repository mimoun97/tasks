@extends('layout')

@section('title', 'Tasques')

@section('content')
    <h1>Tasques</h1>

    <ul>
        @foreach($tasks as $task)
            <li>{{ $task }}</li>
        @endforeach
    </ul>
@endsection
