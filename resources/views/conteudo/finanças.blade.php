@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/financas.css') }}">
@endsection

@section('conteudo')
    <main>
        <section class="container-principal-1">
            <section class="container-card-finanças">
                <section class="card-finanças">
                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-saldo-de-vendas-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Saldo Atual</h3>
                            <p>2.000,00 R$</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-receita-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Receitas</h3>
                            <p>2.000,00 R$</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-despesa-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Despesas</h3>
                            <p>2.000,00 R$</p>
                        </section>
                    </section>

                    <section class="card">
                        <section>
                            <img src="{{ asset('img/icones/icons8-futuro-50.png') }}" alt="">
                        </section>

                        <section class="titulo-card">
                            <h3>Saldo Prev. Dez</h3>
                            <p>2.000,00 R$</p>
                        </section>
                    </section>
                </section>
            </section>
            
            <section class="container-duplo">
                <section class="container-card">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-receitas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-lucro-50.png') }}" alt="">
                                    <h1>Receitas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas></canvas>
                            </section>
                        </section>
                   </section>
                </section>

                <section class="container-card">
                    <section class="container-receitasDespesas">
                        <section class="card-receitasDespesas">
                            <section class="card-header-despesas">
                                <section class="titulo-card-receitasDespesas">
                                    <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                                    <h1>Despesas do Mês</h1>
                                </section>
                            </section>
                            
                            <section class="card-body-receitas">
                                <canvas></canvas>
                            </section>
                        </section>
                   </section>
                </section>
            </section>
        </section>
    </main>
@endsection