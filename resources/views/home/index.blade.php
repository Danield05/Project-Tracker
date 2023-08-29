
    @extends('layouts.app-master')

    @section('content')

    <h1>Home</h1>

    @auth 
        <p>Bienvenido {{auth()->user()->name ?? auth()->user()->username }}, estas autenticado a la pagina</p>
        <p>
            <a href="/logout">logout</a>
            
        </p>
    @endauth

    @guest
        <p>Para ver el contenido <a href="/login">inicia sesion</p>
    @endguest

    @endsection

