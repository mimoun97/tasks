@extends('layouts.login')

@section('title', 'Chat')

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection