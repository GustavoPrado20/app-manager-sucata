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
            

            <form action="" method="POST">
                @csrf
                <section class="container-checkbox">
                    <label for="checkbox">
                        <input type="checkbox" id="checkox" name="">
                        Exemplo
                    </label>
                </section>

                <section class="container-radio-time">
                    <label for="timeAzul">
                        <input type="radio" name="time" value="">
                        Time Azul
                    </label>

                    <label for="timeVermelho">
                        <input type="radio" name="time" value="">
                        Time Vermelho
                    </label>
                </section>

                <input type="submit" name="adicionar" value="ADICIONAR">
            </form>
        </section>
    </section>
@endif
</div>
