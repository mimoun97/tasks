@extends('layouts.login')

@section('title', 'Register')

@section('content')
    <v-content>
        @if ($errors->any())
            <v-alert
                    :value="true"
                    type="error"
            >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </v-alert>
        @endif
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <register-form name="{{ old('name') }}" email="{{ old('email') }}" csrf-token="{{ csrf_token()}}"></register-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection
