@extends('layouts.login')

@section('title', 'Verify')

@section('content')
<v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex md8>
                    <v-toolbar dark color="primary">
                            <v-toolbar-title>{{ __('Verify Your Email Address') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-toolbar-items class="hidden-xs-and-down">
                                <v-btn href="{{ URL::previous() }}" icon>
                                    <v-icon>arrow_back</v-icon>
                                </v-btn>
                            </v-toolbar-items>
                    </v-toolbar>
                    <v-card class="elevation-12">
                        <v-card-title v-show="false" class="title">{{ __('Verify Your Email Address') }}</v-card-title>
                        <v-card-text>
                            @if (session('resent'))
                                <v-alert :value="true" 
                                    color="success"
                                    icon="check_circle"
                                    outline
                                >
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                </v-alert>
                            @endif
                        </v-card-text>
                        <v-card-text>
                            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p>{{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.</p>       
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
</v-content>
@endsection
