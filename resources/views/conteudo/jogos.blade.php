@extends('layouts.esqueleto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jogos.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection

@section('conteudo')
    <main>
        <section class="container-principal-1">
            <nav class="menu-jogo">
                <ul>
                    <li><a href="">Tabela</a></li>
                    <li><a href="">Partidas</a></li>
                    <li><a href="#Jogadores">Jogadores</a></li>
                    <li><a href="">Artilharia</a></li>
                    <li><a href="">Rank Cartões</a></li>
                </ul>
           </nav>
           
           <section class="container-1">
                <section class="table">
                    <section class="table-header">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-troféu-40.png') }}" alt="">
                            <h1>Tabela</h1>
                        </section>
                    </section>
                    
                    <section class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Pos</th>                                
                                    <th>Time</th>
                                    <th>Pt</th>
                                    <th>Gm</th>
                                    <th>Gs</th>
                                    <th>Sg</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($times as $time)
                                    <tr>
                                        <td>{{ $posicao++ }}°</td>
                                        <td>{{ $time['nome'] }}</td>
                                        <td>{{ $time['pontos'] }}</td>
                                        <td>{{ $time['gols marcados'] }}</td>
                                        <td>{{ $time['gols sofridos'] }}</td>
                                        <td>{{ ($time['gols marcados'] - $time['gols sofridos']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </section>
           </section>
    
           <section class="container-card-jogos">
                <section class="card-jogos">
                    <section class="card card-box-vermelho">
                        <h5>28/01/2024</h5>
    
                        <p><img src="{{ asset('img/icones/icons8-camisa-de-jogador-50.png') }}" alt="Time Azul" class="time-azul"> 6 X 4 <img src="{{ asset('img/icones/icons8-camisa-de-jogador-20.png') }}" alt="Time Vermelho" class="time-vermelho"></p>
                    </section>
    
                    <section class="card card-box-azul">
                        <h5>28/01/2024</h5>
    
                        <p><img src="{{ asset('img/icones/icons8-camisa-de-jogador-50.png') }}" alt="Time Azul" class="time-azul"> 6 X 4 <img src="{{ asset('img/icones/icons8-camisa-de-jogador-20.png') }}" alt="Time Vermelho" class="time-vermelho"></p>
                    </section>
    
                    <section class="card card-box-vermelho">
                        <h5>28/01/2024</h5>
    
                        <p><img src="{{ asset('img/icones/icons8-camisa-de-jogador-50.png') }}" alt="Time Azul" class="time-azul"> 6 X 4 <img src="{{ asset('img/icones/icons8-camisa-de-jogador-20.png') }}" alt="Time Vermelho" class="time-vermelho"></p>
                    </section>
    
                    <section class="card card-box-azul">
                        <h5>28/01/2024</h5>
    
                        <p><img src="{{ asset('img/icones/icons8-camisa-de-jogador-50.png') }}" alt="Time Azul" class="time-azul"> 6 X 4 <img src="{{ asset('img/icones/icons8-camisa-de-jogador-20.png') }}" alt="Time Vermelho" class="time-vermelho"></p>
                    </section>
                </section>
           </section>
        </section>

        <section class="container-principal-2" id="Jogadores">
            <section class="container-2">
                <section class="table">
                    <section class="table-header-jogadores" id="color-header-table">
                        <section class="titulo-table">
                            <img src="{{ asset('img/icones/icons8-football-player-64.png') }}" alt="">
                            <h1>Jogadores</h1>
                        </section>

                        @livewire('ModalAddJogador', ['LoginAuth' => $LoginAuth])
                    </section>
                    
                    <section class="table-body-jogadores" id="Azul">
                        <table>
                            <thead>
                                <tr>                                
                                    <th>Nome</th>
                                    <th>Gols</th>
                                    <th>Faltas</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($times as $time)
                                    <tr>
                                        <td>{{ $time['nome'] }}</td>
                                        <td>{{ $time['pontos'] }}</td>
                                        <td>{{ $time['gols marcados'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>

                    <section class="table-body-jogadores" id="Vermelho">
                        <table>
                            <thead id="color-thead-vermelho">
                                <tr>                               
                                    <th>Nome</th>
                                    <th>Gols</th>
                                    <th>Faltas</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($times as $time)
                                    <tr>
                                        <td>{{ $time['nome'] }}</td>
                                        <td>{{ $time['pontos'] }}</td>
                                        <td>{{ $time['gols marcados'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </section>
           </section>
        </section>

        <section class="container-principal-3">
            <section class="container-ranks">
                <section class="container-3">
                    <section class="table-artilharia">
                        <section class="table-header-artilharia">
                            <section class="titulo-table-artilharia">
                                <img src="{{ asset('img/icones/icons8-futebol-20.png') }}" alt="">
                                <h1>Artilharia</h1>
                            </section>
                        </section>
                        
                        <section class="table-body-artilharia">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Jogador</th>                                
                                        <th>Gols</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($times as $time)
                                        <tr>
                                            <td>Gustavo</td>
                                            <td>50</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </section>
               </section>
            </section>

            <section class="container-ranks">
                <section class="container-3">
                    <section class="table-artilharia">
                        <section class="table-header-artilharia">
                            <section class="titulo-table-artilharia">
                                <img src="{{ asset('img/icones/icons8-cartão-amarelo-de-futebol-40.png') }}" alt="">
                                <h1>Rank Cartões (Amarelos)</h1>
                            </section>
                        </section>
                        
                        <section class="table-body-artilharia">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Jogador</th>                                
                                        <th>Cartões</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($times as $time)
                                        <tr>
                                            <td>Gustavo</td>
                                            <td>50</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>  
                    </section>
               </section>
            </section>
        </section>

        @if ($LoginAuth)
            <section class="container-principal-4">
                <section class="container-4">
                    <section class="half">
                        <section class="container-registro">
                            <section class="main-registro">
                                <section class="header-registro">
                                    <section class="titulo">
                                        <img src="{{ asset('img/icones/icons8-absence-20 (1).png') }}" alt="">
                                        <h1>Registro Faltas</h1>
                                    </section>
                                </section>
                                
                                <section class="body-registro">
                                    <form action="">
                                        <h3>Jogadores:</h3>
                                        <section id="container-checkbox-registro">
                                           
                                        </section>

                                        <section class="registro-form-data-motivo">
                                            <section>
                                                <label for="data">Data:</label>
                                                <input type="date" name="data" id="data">
                                            </section>
                                        
                                            <section>
                                                <label for="motivo">Motivo:</label>
                                                <select name="motivo" id="motivo">
                                                    <option value="Não Justificado">Não Justificado</option>
                                                    <option value="Atraso">Atraso</option>
                                                    <option value="Trabalho">Trabalho</option>
                                                    <option value="Licença">Licença</option>
                                                </select>
                                            </section>
                                        </section>

                                        <button type="submit">Registrar</button>
                                    </form>
                                </section>
                            </section>
                        </section>
                    </section>

                    <section class="half">
                        <section class="container-registro">
                            <section class="main-registro">
                                <section class="header-registro">
                                    <section class="titulo">
                                        <img src="{{ asset('img/icones/icons8-futebol-de-praia-40.png') }}" alt="">
                                        <h1>Registro Gols</h1>
                                    </section>
                                </section>
                                
                                <section class="body-registro">
                                    <form action="">
                                        <h3>Jogadores:</h3>
                                        <section id="container-checkbox-registro">
                                            
                                        </section>

                                        <label for="gols">Gols:</label>
                                        <input type="number" id="gols" name="gols" min="1" value="1">

                                        <button type="submit">Registrar</button>
                                    </form>
                                </section>
                            </section>
                        </section>
                    </section>

                    <section class="half">
                        <section class="container-registro">
                            <section class="main-registro">
                                <section class="header-registro">
                                    <section class="titulo">
                                        <img src="{{ asset('img/icones/icons8-cartão-amarelo-de-futebol-40.png') }}" alt="">
                                        <h1>Registro Cartões</h1>
                                    </section>
                                </section>
                                
                                <section class="body-registro">
                                    <form action="">
                                        <h3>Jogadores:</h3>
                                        <section id="container-checkbox-registro">
                                            
                                        </section>

                                        <label for="cartao">Cartão:</label>
                                        <select name="motivo" id="cartao">
                                            <option value="Amarelo">Amarelo</option>
                                            <option value="Vermelho">Vermelho</option>
                                        </select>

                                        <button type="submit">Registrar</button>
                                    </form>
                                </section>
                            </section>
                        </section>
                    </section>

                    <section class="half">
                        <section class="container-registro">
                            <section class="main-registro">
                                <section class="header-registro">
                                    <section class="titulo">
                                        <img src="{{ asset('img/icones/icons8-estádio-40.png') }}" alt="">
                                        <h1>Registro Partida</h1>
                                    </section>
                                </section>
                                
                                <section class="body-registro">
                                    <form action="">
                                        <label for="placar">Placar:</label>
                                        <input type="text" id="placar" name="placar" placeholder="Ex: 5 X 3">

                                        <label for="resultado">Resultado</label>
                                        <select name="motivo" id="resultado">
                                            <option value="Time Azul">Time Azul</option>
                                            <option value="Empate">Empate</option>
                                            <option value="Time Vermelho">Time Vermelho</option>
                                        </select>

                                        <label for="data">Data:</label>
                                        <input type="date" name="data" id="data">

                                        <button type="submit">Registrar</button>
                                    </form>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        @endif
    </main>

    <script type="text/javascript" src="{{ asset('js/tabela-jogadores.js') }}"></script>
@endsection