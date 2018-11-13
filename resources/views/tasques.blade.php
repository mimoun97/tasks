@extends('layout')

@section('content')
    <v-container fluid>
      <v-layout>
        <v-flex>
          <tasques></tasques>
        </v-flex>
      </v-layout>
    </v-container>
@endsection
{{-- :tasks={{ $tasks }} --}}