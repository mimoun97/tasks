@extends('layouts.app')

@section('title', 'Newsletter')

@section('content')
    <newsletters :newsletter="{{ $newsletter }}"></newsletters>
@endsection