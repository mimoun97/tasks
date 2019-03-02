@extends('layouts.app')

@section('title', 'Tasques Vue i Vuetify')

@section('content')
    <v-container fluid>
      <v-layout>
        <v-flex>
         <tasks :tasks="{{ $tasks }}"/>
        </v-flex>
      </v-layout>
    </v-container>

@endsection
