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
                                <th>Data de Entrada</th>
                                @if ($LoginAuth)
                                    <th>Ações</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if (!empty($dadosMembros))
                                @foreach ($dadosMembros as $dadoMembro)
                                    <tr>
                                        <td>{{ $dadoMembro['nome'] }} @if (!empty($dadoMembro['apelido'])) ({{ $dadoMembro['apelido'] }}) @endif</td>
                                        <td>{{ $dadoMembro['ocupação'] }}</td>
                                        <td>{{ $dadoMembro['data-entrada-time'] }}</td>
                                        @if ($LoginAuth)
                                            <td>
                                                @livewire('ModalsEditarERemoverMembro',['idMembro' => $dadoMembro['id']])
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </section>
            </section>
        </section>

        @if ($LoginAuth)
            <section class="container-1">
                <section class="table">
                    <section class="table-header">
                        <h1>Membros Inativos</h1>
                    </section>
                    
                    <section class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Ocupação</th>
                                    <th>Data e hora Saida</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($dadosMembrosInativos))
                                    @foreach ($dadosMembrosInativos as $dadoMembroInativo)
                                        <tr>
                                            <td>{{ $dadoMembroInativo['nome'] }} ({{ $dadoMembroInativo['apelido'] }})</td>
                                            <td>{{ $dadoMembroInativo['ocupação'] }}</td>
                                            <td>{{ $dadoMembroInativo['updated_at'] }}</td>
                                            <td>
                                                @livewire('ModalsEditarERemoverMembro',['idMembro' => $dadoMembroInativo['id']])
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>
                </section>
            </section>
        @endif
    </main>
@endsection