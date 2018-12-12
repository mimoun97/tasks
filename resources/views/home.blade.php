@extends('layouts.app')

@section('content')
<container>
    <v-container fluid>
        <v-layout>
            <v-flex xs12>
                <v-card>
                    <h1>Hola <b>{{ Auth::user()->name }}</b></h1>
                    <h2>Està en mode: {{ config('app.env') }}</h2>
                </v-card>
            </v-flex>
        </v-layout>
    </container>
@endsection
