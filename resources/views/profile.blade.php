@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<v-container fluid>
    <v-layout>
        <v-flex>
            <user-profile :user="{{ $user }}"></user-profile>
        </v-flex>
    </v-layout>
</v-container>

@endsection
