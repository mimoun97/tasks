@extends('layouts.app')

@section('title', 'Tasca')

@section('content')
<v-container fluid fill-height>
<v-layout>
<v-flex>
        <task-card
            class="mx-2"
            :task="{{ $task }}"
            :users="{{ $users }}"
            uri="{{ $uri  }}"
        ></task-card>
</v-flex>
</v-layout>
</v-container>

@endsection