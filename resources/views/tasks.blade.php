@extends('layouts.app')

@section('title', 'Tasques PHP')

@section('content')
<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg font-sans">
    <div class="mb-4">
        <h1 class="text-grey-darkest">Tasques ({{$tasks->count()}})</h1>
            <form class="flex mt-4" action="/tasks" method="POST">
                {{--label--}}
                @csrf
                <input name="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" placeholder="Afegir tasca..." required>
                <button class="flex-no-shrink p-2 border-2 rounded text-green border-green bg-transparent hover:text-white hover:bg-green">Afegir</button>
            </form>
    </div>

    <div>
        @foreach($tasks as $task)
        <div class="flex mb-4 items-center">
            @if ($task->completed)

                <p class="w-full line-through text-green">{{ $task->name }}</p>
            @else
                <p class="w-full text-grey-darkest">{{ $task->name }}</p>
            @endif
                <a href="/task_edit/{{ $task->id }}">
                    <button class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded hover:text-white text-green border-green hover:bg-teal">Modificar</button></a>
                <form action="/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="flex-no-shrink p-2 ml-2 border-2 rounded text-red border-red hover:text-white hover:bg-red">Eliminar</button>
                </form>

            </div>
        @endforeach
    </div>
</div>
@endsection
