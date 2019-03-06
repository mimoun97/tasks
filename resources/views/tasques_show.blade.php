@extends('layouts.app')

@section('title', 'Tasca')

@section('content')
<v-container fluid fill-height>
<v-layout>
<v-flex>
    {{--  <v-card>
        <v-card-title>{{$task->name}}</v-card-title>
        <v-card-text>
            Completed? {{$task->completed}}
        </v-card-text>
    </v-card>  --}}
        <task-card
            class="mx-2"
            slot="item"
            slot-scope="{item:task}"
            :task="{{ $task }}"
            :users="{{ $users }}"
            uri="{{ $uri  }}"
        ></task-card>
</v-flex>
</v-layout>
</v-container>

@endsection