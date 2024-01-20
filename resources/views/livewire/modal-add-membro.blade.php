<div class="container-principal">
    <form action="{{ route('buscar-membros') }}" class="search-box">
        <input type="text" placeholder="Buscar Membro" name="nomeApelido" autocomplete="off">
        <button type="submit"><img src="{{ asset('img/icones/icons8-pesquisar-50.png') }}" alt="Pesquisar"></button>
    </form>
    
    @if ($LoginAuth)
        <button class="add-membro" wire:click="abrirModalAddMembro"><img class="icone" src="{{ asset('img/icones/icons8-adicionar-usuário-96.png') }}" alt="Adicionar Usuario"></button>
    @endif

    @if($showModalAddMembro)
        <section class="modal-fade">
            <section class="modal-add-membro modal">
                <header class="header-modal">
                    <h2>Registro Membro</h2>
                    <button wire:click="fecharModalAddMembro">&times;</button>
                </header>
                

                <form action="" method="POST">
                    @csrf
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name ="nome" placeholder="Ex. Eduardo da Silva" autocomplete="off" required>

                    <label for="apelido">Apelido:</label>
                    <input type="text" id="apelido" name ="apelido" placeholder="Ex. Buiu" autocomplete="off">

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

    {{-- @if($showModalLoginAuth)
        <section class="modal-fade">
            <section class="modal-remover-membro modal">
                <header class="header-modal header-modal-remover">
                    <h2>Não Autorizado</h2>
                </header>
                
                <section class="container-1-modal-remover">
                    <p>Você precisa estar logado como Diretor para realizar esta função!!</p>
                </section>

                <section class="container-2-modal-remover">
                    <button wire:click="fecharModalLoginAuth" class="btn-2-auth">OK</button>
                </section>
            </section>
        </section>
    @endif --}}
    
</div>
