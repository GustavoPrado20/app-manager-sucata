<div>
    @if ($LoginAuth)
        <button class="btn-add-receita" wire:click="abrirModalAddReceita"><img class="icone" src="{{ asset('img/icones/icons8-adicionar-usuário-96.png') }}" alt="Adicionar Usuario"></button>
    @endif
    
    @if ($showModalAddReceita)
        <section class="modal-fade">
            <section class="modal-add-receita modal">
                <header class="header-modal">
                    <h2>Adicionar Receita</h2>
                    <button wire:click="fecharModalAddReceita">&times;</button>
                </header>
                

                <form action="{{ route('adicionarFinanças') }}" method="POST">
                    @csrf
                    <label for="membro">Membro</label>
                    <select name="membro" id="membro" wire:model.live="membro" required>
                        <option value="" selected></option>
                        @foreach ($dadosMembros as $dadoMembro)
                            <option value="{{ $dadoMembro['id'] }}">{{ $dadoMembro['nome'] }}@if(!empty($dadoMembro['apelido'])) ({{ $dadoMembro['apelido'] }}) @endif</option>
                        @endforeach
                    </select>

                    @if (!empty($membro))
                        <section class="container-dividaJogador">
                            <section class="table">
                                <section class="table-header-divida-form">
                                    <section class="titulo-table">
                                        <img src="{{ asset('img/icones/icons8-despesa-40.png') }}" alt="">
                                        <h1>Dividas</h1>
                                    </section>
                                </section>  
                                
                                <section class="table-body-dividas-form">
                                    <table>
                                        <thead class="thead-dividas-form">
                                            <tr>
                                                <th></th>                  
                                                <th>Referencia</th>
                                                <th>Valor</th>
                                                <th>Data</th>  
                                            </tr>
                                        </thead>
            
                                        <tbody class="tbody-dividas-form">
                                            @foreach ($dadosDividaMembro as $dadoDivida)
                                                <tr>
                                                    <td><input type="checkbox" name="divida[]" value="{{ $dadoDivida['id'] }}"></td>
                                                    <td>{{ $dadoDivida['referente'] }}</td>
                                                    <td>{{ $dadoDivida['valor'] }},00</td>
                                                    <td>{{ date('d/m/Y', strtotime($dadoDivida['data'])) }}</td>
                                                </tr>    
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </section>
                        </section>
                    @endif

                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name ="valor" placeholder="Ex. R$ 2.500,00" autocomplete="off" required>

                    <button type="submit">Adicionar</button>
                </form>
            </section>
        </section>
    @endif
</div>
