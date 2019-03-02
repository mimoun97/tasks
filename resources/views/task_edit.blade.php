@extends('layouts.app')

@section('title', 'Edita Tasca PHP')

@section('content')
<div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg font-sans" >
    <div class="mb-4">
        <h1 class="text-grey-darkest">Edita una tasca</h1>
        <div >
        <form class="flex mt-4" action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <input name="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" value="{{$task->name}}" required>

            <button class="flex-no-shrink p-2 border-2 rounded text-blue border-blue hover:text-white hover:bg-blue" name="completed" value="{{$task->completed ? false : true}}">{{ $task->completed ? 'Descompletar' : 'Completar' }}</button>

            <button class="flex-no-shrink p-2 border-2 rounded-full text-green border-green hover:text-white bg-green-lightest hover:bg-green" type="submit">OK</button>
        </form>
        </div>
    </div>
    @if ($errors->any())
        <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-3 rounded relative" role="alert">
            @foreach ($errors->all() as $error)
                <strong class="font-bold">Error! </strong>
                <span class="block sm:inline">{{ $error }}</span>
                <span class="absolute pin-t pin-b pin-r px-4 py-3"></span>
            @endforeach
        </div>
    @endif
    <div class="mb-2">
        <div class="flex mt-2">
            <a href="/tasks" >
                <button class="flex-no-shrink p-2 ml-4 mr-2 border-2 rounded hover:text-white text-green border-green hover:bg-teal">Atras</button>
            </a>
        </div>
    </div>
</div>
@endsection
