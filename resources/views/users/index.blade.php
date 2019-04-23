@extends('layouts.app')

@section('title', 'Usuaris')

@section('content')

<v-container fluid fill-height>
    <v-layout align-center justify-center column fill-height>
        <v-flex xs12>
            <!-- TODO users component-->
            <users />
        </v-flex>
    </v-layout>
</v-container>

@endsection