@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex xs12>
                <v-card>
                    <h1>Logat com: <b>{{ Auth::user()->name }}</b></h1>
                </v-card>
            </v-flex>
        </v-layout>
    </container>
@endsection
