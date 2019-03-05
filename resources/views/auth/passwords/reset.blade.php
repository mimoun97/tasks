@extends('layouts.login')

@section('title', 'Reset Password')

@section('content')
<v-container fluid fill-height>
    <v-layout row align-center justify-center>
        <v-flex class="col-md-8">
            <v-card>
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
                    @if ($errors->has('email'))
                        <v-alert :value="true" type="error" outline>
                            <strong>{{ $errors->first('email') }}</strong>
                        </v-alert>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <v-flex row>

                            <v-flex xs12>
                                <v-text-field
                                    class="ml-3"
                                    id="email"
                                    prepend-icon="mail"
                                    hint="Introduïu el vostre email"
                                    name="email"
                                    label="E-Mail Address"
                                    type="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"        
                                ></v-text-field>

                                
                            </v-flex>
                        </v-flex>

                        <v-flex row>
                            <v-flex xs12>

                                <v-text-field
                                    class="ml-3"
                                    id="password"
                                    prepend-icon="lock"
                                    :append-icon="show1 ? 'visibility' : 'visibility_off'"
                                    name="password"
                                    hint="Introduïu el vostre email"
                                    label="Password"
                                    :type="show1 ? 'text' : 'password'"
                                    @click:append="show1 = !show1"
                                    error-messages="{{$errors->first('password')}}"
                                    autocomplete="new-password"
                                    value="{{ old('password') }}"
                                ></v-text-field>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </v-flex>
                        </v-flex>

                        <v-layout row mb-0>
                            <v-flex xs12>
                                <v-text-field
                                    class="mx-3 mr-4"
                                    id="password-confirmation"
                                    prepend-icon="lock"
                                    :append-icon="show2 ? 'visibility' : 'visibility_off'"
                                    name="password_confirmation"
                                    label="{{ __('Confirm Password') }}"
                                    :type="show2 ? 'text' : 'password'"
                                    @click:append="show2 = !show2"
                                    error-messages="{{$errors->first('password')}}"
                                    autocomplete="new-password"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-layout row mb-0>
                            <v-flex md6 offset-md4>
                                <v-btn type="submit" dark class="primary flat">
                                    {{ __('Reset Password') }}
                                </v-btn>
                            </v-flex>
                        </v-layout>
                    </form>
                </div>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection
