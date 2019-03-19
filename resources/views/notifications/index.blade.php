@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <notifications
            :notifications="{{ $notifications }}"
            :user-notifications="{{ $userNotifications }}"
            :users="{{ $users }}"
    ></notifications>
@endsection
