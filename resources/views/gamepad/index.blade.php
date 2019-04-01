@extends('layouts.app')

@section('title', 'Gamepad')

@section('content')

<v-container fluid>
    <v-layout>
        <v-flex>
            <game-pad></game-pad>
        </v-flex>
    </v-layout>
</v-container>

@endsection