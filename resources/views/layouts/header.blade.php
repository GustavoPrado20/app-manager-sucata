<header>
    <h2 class="logo">Su<span>cata</span></h2>

    <nav class="navLinks" id="nav">
        <button id="btn-nav" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
            <span id="hamburguer"></span>
        </button>

        <ul id="menu" role="Menu">
            <li id="btn-menu-1"><a href="{{ route('home') }}">Regras</a></li>
            <li id="btn-menu-2"><a href="{{ route('membros') }}">Membros</a></li>
            <li id="btn-menu-3"><a href="{{ route('jogos') }}">Jogo</a></li>
            <li id="btn-menu-4"><a href="{{ route('financas') }}">Finanças</a></li>
            @if ($LoginAuth)
                <li id="btn-menu-5"><a href="{{ route('deslogar') }}">Deslogar</a></li>
            @else
                <li id="btn-menu-5"><a href="{{ route('login') }}">Logar</a></li>
            @endif
        </ul>
    </nav>
</header>