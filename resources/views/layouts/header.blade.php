<header>
    <h2 class="logo">Su<span>cata</span></h2>

    <nav class="navLinks">
        <ul>
            <li><a href="{{ route('home') }}">Regras</a></li>
            <li><a href="{{ route('membros') }}">Membros</a></li>
            <li><a href="{{ route('jogos') }}">Jogo</a></li>
            <li><a href="{{ route('financas') }}">Finanças</a></li>
            @if ($LoginAuth)
                <li><a href="{{ route('deslogar') }}">Deslogar</a></li>
            @else
                <li><a href="{{ route('login') }}">Logar</a></li>
            @endif
        </ul>
    </nav>
</header>