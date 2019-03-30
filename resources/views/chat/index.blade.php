@extends('layouts.app')

@section('title', 'Chat')

@section('content')
    <chat :channels="{{ $channels }}"></chat>
@endsection