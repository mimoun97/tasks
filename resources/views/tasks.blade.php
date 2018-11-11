@extends('layout')

@section('title', 'Tasques')

@section('content')
    <h1>Tasques ({{$tasks->count()}})</h1>
	<ul>
         @foreach ($tasks as $task)
            <li>{{ $task->name }} 
            	|| Completed: <input name="completed" type="checkbox" {{$task->completed ? 'checked' : '' }}>
            	<form action="/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <button>Completar</button>
                </form>
                <a href="/task_edit/{{ $task->id }}">
                    <button>Modificar</button>
                </a>

                <form action="/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button>Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul> 
    <form action="/tasks" method="POST">
        {{--label--}}
        @csrf
        <input name="name" type="text" placeholder="Nova tasca" required>
        <button>Afegir</button>
    </form>
@endsection
