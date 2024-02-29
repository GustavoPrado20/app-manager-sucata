<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="icon" href="{{ asset('img/icones/icons8-bola-de-futebol-2-20.png') }}" type="image/x-icon">

        <title>Sucata</title>
        
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        @yield('styles')

        <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>
    </head>

    <body>
        @include('layouts.header')

        @yield('conteudo')

        @include('layouts.footer')

        <script src="{{ asset('js/header-menu.js') }}"></script>
    </body>
</html>