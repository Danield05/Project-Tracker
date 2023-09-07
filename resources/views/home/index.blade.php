@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="text-center mt-5">
        
        @auth
            <p>Welcome, {{ auth()->user()->name ?? auth()->user()->username }}!</p>
            <p>You are authenticated to our Expenses Tracker App.</p>
            <a href="/logout" class="btn btn-danger">Logout</a>
        @endauth

        @guest
            <p>To view the content, please <a href="/login">log in</a>.</p>
        @endguest
    </div>
</div>
@endsection
