<div class="container-modal-add-jogador">
    <section class="btn-tabela">
        <section class="btn-color"></section>
        <button id="btnAzul">Azul</button>
        <button id="btnVermelho">Vermelho</button>
    </section>

    @if ($LoginAuth)
        <button class="add-jogador" wire:click="abrirModalAddJogador"><img class="icone" src="{{ asset('img/icones/icons8-adicionar-usuário-96.png') }}" alt="Adicionar Usuario"></button>
    @endif

    @if($showModalAddJogador)
    <section class="modal-fade">
        <section class="modal-add-jogador modal">
            <header class="header-modal">
                <h2>Adicionar Jogador</h2>
                <button wire:click="fecharModalAddJogador">&times;</button>
            </header>
            

            <form action="{{ route('adicionarJogador') }}" method="POST">
                @csrf
                <section class="container-checkbox">
                    @if (!empty($dadosJogadores))
                        @foreach ($dadosJogadores as $dadoJogador)
                            <label for="jogador{{ $dadoJogador['id'] }}">
                                <input type="checkbox" id="jogador{{ $dadoJogador['id'] }}" name="Jogador[]" value="{{ $dadoJogador['id'] }}">
                                {{ $dadoJogador['nome'] }} @if (!empty($dadoJogador['apelido'])) ({{ $dadoJogador['apelido'] }}) @endif
                            </label>
                        @endforeach
                    @endif
                </section>
                
                <select name="time" id="time">
                    <option value="1">Time Azul</option>
                    <option value="2">Time Vermelho</option>
                </select>

                <input type="submit" name="adicionar" value="ADICIONAR">
            </form>
        </section>
    </section>
@endif
</div>
