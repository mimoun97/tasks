@extends('layout')

@section('content')
    <h1>Edita una tasca</h1>
    <form action="/tasks/{{$task->id}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        Name: <input name="name" type="text" value="{{$task->name}}" >
        {{--// CHECKBOX--}}
        Completed:
        @if ( $task->completed )
            <input name="completed" type="checkbox" checked>
        @else
            <input name="completed" type="checkbox">
        @endif
        <button>Editar</button>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
@endsection