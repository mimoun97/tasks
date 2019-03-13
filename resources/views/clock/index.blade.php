@extends('layouts.app')

@section('title', 'Clock')

@section('content')

<v-container fluid fill-height>
    <v-layout align-center justify-center column fill-height>
        <v-flex xs12>
            <clock />
        </v-flex>
    </v-layout>
</v-container>

@endsection