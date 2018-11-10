@extends('layout')

@section('title', 'Tasques')

@section('content')
    <h1>Tasques</h1>

	<ul>
        @foreach($tasks as $task)
            <li>{{ $task->name }}</li>Completed:
        @if ( $task->completed )
            <input name="completed" type="checkbox" checked>
        @else
            <input name="completed" type="checkbox">
        @endif
            </li>
        @endforeach
    </ul> 
    <form action="/tasks" method="POST">
        {{--label--}}
        @csrf
        <input name="name" type="text" placeholder="Nova tasca">
        <button>Afegir</button>
    </form>
@endsection
