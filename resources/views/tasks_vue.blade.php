@extends('layouts.app')

@section('title', 'Tasques Vue i Vuetify')

@section('content')
    <v-container fluid fill-height>
      <v-layout row align-center justify-center>
        <v-flex>
          <tasks :tasks="{{ $tasks }}"/>
        </v-flex>
      </v-layout>
    </v-container>

@endsection
