<div>
    @if ($LoginAuth)
        <button class="btn-add-despesa" wire:click="abrirModalAddDespesa"><img class="icone" src="{{ asset('img/icones/icons8-adicionar-usuário-96.png') }}" alt="Adicionar Usuario"></button>
    @endif
    
    @if ($showModalAddDespesa)
        <section class="modal-fade">
            <section class="modal-add-receita modal">
                <header class="header-modal">
                    <h2>Adicionar Despesas</h2>
                    <button wire:click="fecharModalAddDespesa">&times;</button>
                </header>
                

                <form action="{{ route('adicionarDespesas') }}" method="POST">
                    @csrf
                    <label for="membro">Referente:</label>
                    <input type="text" name="referencia" value="" placeholder="Ex. Juiz, Bola...." required>

                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name ="valor" placeholder="Ex. R$ 2.500,00" autocomplete="off" required>

                    <button type="submit">Adicionar</button>
                </form>
            </section>
        </section>
    @endif
</div>
