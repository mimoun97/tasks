@extends('layouts.chat')

@section('title', 'Chat')

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection