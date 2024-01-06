@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/membros.css') }}">
@endsection

@section('conteudo')
    <main>
        <section class="container-1">
            <section class="table">
                <section class="table-header">
                    <h1>Membros</h1>
                    <section>
                        @livewire('ModalAddMembro', ['LoginAuth' => $LoginAuth])
                    </section>
                </section>
                
                <section class="table-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ocupação</th>
                                <th>Ano de Entrada</th>
                                @if ($LoginAuth)
                                    <th>Ações</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Gustavo Prado</td>
                                <td>Jogador</td>
                                <td>2021</td>
                                @if ($LoginAuth)
                                    <td>
                                        @livewire('ModalsEditarERemoverMembro')
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </main>
@endsection