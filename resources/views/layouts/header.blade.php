<header>
    <h2 class="logo">Su<span>cata</span></h2>

    <nav class="navLinks" id="nav">
        <button id="btn-nav" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
            <span id="hamburguer"></span>
        </button>

        <ul id="menu" role="Menu">
            <li id="btn-menu-1" data-href="{{ route('home') }}"><a href="{{ route('home') }}">Regras</a></li>
            <li id="btn-menu-2" data-href="{{ route('membros') }}"><a href="{{ route('membros') }}">Membros</a></li>
            <li id="btn-menu-3" data-href="{{ route('jogos') }}"><a href="{{ route('jogos') }}">Jogo</a></li>
            <li id="btn-menu-4" data-href="{{ route('financas') }}"><a href="{{ route('financas') }}">Finanças</a></li>
            @if ($LoginAuth)
                <li id="btn-menu-5" data-href="{{ route('deslogar') }}"><a href="{{ route('deslogar') }}">Deslogar</a></li>
            @else
                <li id="btn-menu-5" data-href="{{ route('login') }}"><a href="{{ route('login') }}">Logar</a></li>
            @endif
        </ul>
    </nav>
</header>