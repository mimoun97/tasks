@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex xs12>
                <v-card>
                    <v-card-title>{{ Auth::user()->name }}</v-card-title>
                </v-card>
            </v-flex>
        </v-layout>
    </container>
@endsection
