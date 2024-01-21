<div>
    <button class="btns-opcoes" wire:click="abrirModalEditarMembro"><img src="{{ asset('img/icones/icons8-editar-96.png') }}" alt="Editar Membro" class="icone"></button>
    <button class="btns-opcoes btn-op-2" wire:click="abrirModalRemoverMembro"><img src="{{ asset('img/icones/icons8-remover-usuário-masculino-96.png') }}" alt="Remover Membro" class="icone"></button>
    
    @if($showModalEditarMembro)
        <section class="modal-fade">
            <section class="modal-edit-membro modal">
                <header class="header-modal">
                    <h2>Editar Membro</h2>
                    <button wire:click="fecharModalEditarMembro">&times;</button>
                </header>
                

                <form action="{{ route('atualizar-membros') }}" method="POST">
                    @csrf
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name ="nome" placeholder="Ex. Eduardo da Silva" value="{{ $dadoMembro['nome'] }}" required>

                    <label for="apelido">Apelido:</label>
                    <input type="text" id="apelido" name ="apelido" placeholder="Ex. Buiu" value="{{ $dadoMembro['apelido'] }}">

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
                    
                    <input type="hidden" name="idMembro" value="{{ $idMembro }}">
                    <input type="submit" name="editar" value="EDITAR">
                </form>
            </section>
        </section>
    @endif

    @if($showModalRemoverMembro)
        <section class="modal-fade">
            <section class="modal-remover-membro modal">
                <header class="header-modal header-modal-remover">
                    <h2>Remover Membro</h2>
                </header>
                
                <section class="container-1-modal-remover">
                    <p>Tem certeza que deseja remover este Membro ??</p>
                </section>

                <section class="container-2-modal-remover">
                    <button wire:click="fecharModalRemoverMembro" class="btn-1">CANCELAR</button>
                    <button wire:click="removerMembro" class="btn-2">CONFIRMAR</button>
                </section>
            </section>  
        </section>
    @endif
</div>
