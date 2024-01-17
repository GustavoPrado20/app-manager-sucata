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
        <section class="modal-add-membro modal">
            <header class="header-modal">
                <h2>Adicionar Jogador</h2>
                <button wire:click="fecharModalAddJogador">&times;</button>
            </header>
            

            <form action="{{ route('registrar-membros') }}" method="POST">
                @csrf
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name ="nome" placeholder="Ex. Eduardo da Silva" required>

                <label for="apelido">Apelido:</label>
                <input type="text" id="apelido" name ="apelido" placeholder="Ex. Buiu">

                <label for="ocupacao">Ocupação:</label>
                <select name="ocupação" id="ocupacao" required>
                    <option value="Jogador">Jogador</option>
                    <option value="Sócio">Sócio</option>
                    <option value="Diretor e Jogador">Diretor e Jogador</option>
                </select>

                <input type="submit" name="registrar" value="REGISTRAR">
            </form>
        </section>
    </section>
@endif
</div>
