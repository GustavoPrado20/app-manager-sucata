<div class="container-principal">
    <form action="{{ route('buscar-membros') }}" class="search-box">
        <input type="text" placeholder="Buscar Membro" name="nomeApelido" autocomplete="off">
        <button type="submit"><img src="{{ asset('img/icones/icons8-pesquisar-50.png') }}" alt="Pesquisar"></button>
    </form>

    <button class="btn-search" wire:click="abrirModalSearchMembro"><img class="icone" src="{{ asset('img/icones/icons8-pesquisar-20.png') }}" alt="Adicionar Usuario"></button>
    
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
                

                <form action="{{ route('registrar-membros') }}" method="POST">
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

                    <section class="checkbox-container">
                        <label for="acordo">
                            <input type="checkbox" id="acordo" value="{{ true }}" name="acordo">
                            Acordo
                        </label>
                    </section>

                    <input type="submit" name="registrar" value="REGISTRAR">
                </form>
            </section>
        </section>
    @endif

   @if ($showModalSearchMembro)
        <section class="modal-fade">
            <section class="modal-add-membro modal">
                <header class="header-modal">
                    <h2>Buscar Membro</h2>
                    <button wire:click="fecharModalSearchMembro">&times;</button>
                </header>
                

                <form action="{{ route('buscar-membros') }}" method="GET">
                    @csrf
                    <label for="nome">Nome ou Apelido:</label>
                    <input type="text" id="nome" name="nomeApelido" placeholder="Ex. Eduardo da Silva" autocomplete="off">

                    <input type="submit" name="buscar" value="BUSCAR">
                </form>
            </section>
        </section>
   @endif
    
</div>
