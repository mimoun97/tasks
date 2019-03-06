@extends('layouts.login')

@section('title', 'Reset Password')

@section('content')
<v-container fluid fill-height>
    <v-layout row align-center justify-center>
        <div class="col-md-8">
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>{{ __('Reset Password') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items class="hidden-xs">
                        <v-btn href="{{ url()->previous() }}" icon>
                            <v-icon>arrow_back</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <v-card-text>
                    @if (session('status'))
                        <v-alert :value="true" type="success" outline>{{ session('status') }}</v-alert>
                    @endif

                    @if($errors->any())
                        <v-alert :value="true" type="error" outline>
                            @foreach ($errors->all() as $error)
                                {{ $error}}
                            @endforeach
                        </v-alert>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <v-flex row>
                            <v-flex xs12 class="text-xs-center">
                                {{-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required> --}}
                                <v-text-field
                                    class="ml-3"
                                    id="email"
                                    append-icon="mail"
                                    hint="Introduïu el vostre email"
                                    name="email"
                                    label="E-Mail Address"
                                    type="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"        
                                ></v-text-field>
                            </v-flex>
                        </v-flex>

                        <v-layout row mb-0>
                            <v-flex md6 offset-md4>
                                <v-btn type="submit" dark class="primary flat">
                                    {{ __('Send Password Reset Link') }}
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </form>
                </v-card-text>
            </div>
        </div>
    </v-layout>
</v-container>
@endsection
