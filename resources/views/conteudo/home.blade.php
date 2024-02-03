@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('conteudo')
    <main>
        <section class="container-1">
            <h1>Estatuto e Regulamento Sucata F.C (2024)</h1>
            <section class="container-grid">
                <section class="container-box">
                    <h2>Art. 1 - Sobre o jogo</h2>
                    <ul>
                        <li>
                            <p>
                                Os jogos da equipe serão realizados aos domingos das 8:00 às 10:00 no
                                estádio municipal de Igaratá (Campo A e B). obs: de preferência chegar
                                com 15min de antecedência.
                            </p>
                        </li>
                        <br>
                        <ul>
                            <li>
                                <p>
                                    Só poderá participar do jogo o associado que estiverem em dia com as suas
                                    obrigações de clube.
                                </p>
                            </li> 
                        </ul>
                    </ul>
                </section>
                    
                <section>
                    <figure>
                        <img src="{{ asset('img/figuras/Soccer.gif') }}" alt="Figura 1">
                    </figure>
                </section>
            </section>
        </section>
    </main>
@endsection