@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex xs12>
                {{-- <v-card>
                    <v-toolbar dark color="primary">User</v-toolbar>
                    <v-card-title>{{ Auth::user()->name }}</v-card-title>
                </v-card> --}}
                <empty-state 
                    label="Crea la teva primera tasca" 
                    icon="done" 
                    description="Si creeu una tasca, podreu afegir etiquetes i col·laborar amb les persones."
                    button="no!">
                </empty-state>
            </v-flex>
            
        </v-layout>
    </container>
@endsection
