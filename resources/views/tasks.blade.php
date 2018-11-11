@extends('layout')

@section('title', 'Tasques')

@section('content')
    <h1>Tasques</h1>

	<ul>
         @foreach ($tasks as $task)
            <li>{{ $task->name }} 
            	Completed:
        @if ( $task->completed )
            true
        @else
            fasle
        @endif
            	<button>Completar</button>
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
