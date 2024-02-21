<div>
    <button class="btns-opcoes btn-op-2" wire:click="abrirModalRemoverJogador"><img src="{{ asset('img/icones/icons8-remover-usuário-masculino-96.png') }}" alt="Remover Membro" class="icone"></button>

    @if ($showModalRemoverJogador)
        <section class="modal-fade">
            <section class="modal-remover-membro modal">
                <header class="header-modal header-modal-remover">
                    <h2>Remover Jogador</h2>
                </header>
                
                <section class="container-1-modal-remover">
                    <p>Tem certeza que deseja remover este Jogador deste Time ??</p>
                </section>

                <section class="container-2-modal-remover">
                    <button wire:click="fecharModalRemoverJogador" class="btn-1">CANCELAR</button>
                    <button wire:click="removerJogador" class="btn-2">CONFIRMAR</button>
                </section>
            </section>  
        </section>
    @endif
</div>
