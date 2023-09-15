@extends('layouts.app-master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<div class="container">
    <div class="text-center mt-5">
        
        @auth
            <p>Welcome, {{ auth()->user()->name ?? auth()->user()->username }}!</p>
            <p>You are authenticated to our Expenses Tracker App.</p>
            <p>To start tracking your expenses, please choose one of the options on the navbar</p>
            <a href="/logout" class="btn btn-danger">Logout</a>
        @endauth

        @guest
            <p>To view the content, please <a href="/login">log in</a>.</p>
        @endguest
    </div>
</div>
@endsection