@extends('layouts.app')

@section('title', 'Clock')

@section('content')

<v-container fluid>
    <v-layout>
        <v-flex>
            <clock />
        </v-flex>
    </v-layout>
</v-container>

@endsection