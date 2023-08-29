
    @extends('layouts.app-master')

    @section('content')

    <h1>Home</h1>

    @auth 
        <p>Welcome {{auth()->user()->name ?? auth()->user()->username }}, you are authenticated to our Expenses Tracker App.</p>
        <p>
            <a href="/logout">logout</a>
            
        </p>
    @endauth

    @guest
        <p>Para ver el contenido <a href="/login">inicia sesion</p>
    @endguest

    @endsection

