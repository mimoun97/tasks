@extends('layouts.app')

{{--TODO tags--}}

@section('content')

    bla bla bla
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tags :tags="{{ $tags }}"></tags>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
{{-- :tasks={{ $tasks }} --}}
