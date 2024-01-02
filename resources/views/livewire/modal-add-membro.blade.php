<div>
    <button class="buscar-tarefa" href = "#"><i class="fas fa-search iSearch"></i></button>
    <button class="add-membro" wire:click="abrirModalAddMembro">Add New Membro</button>

    @if($showModalAddMembro)
        <section class="modal-fade">
            <section class="modal-add-membro">
                <header id="header-modal">
                    <h2>Registro Membro</h2>
                    <button wire:click="fecharModalAddMembro">&times;</button>
                </header>
                

                <form action="">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name ="nome" placeholder="Ex. Eduardo da Silva" required>

                    <label for="ocupacao">Ocupação:</label>
                    <select name="ocupação" id="ocupacao" required>
                        <option value="jogador">Jogador</option>
                        <option value="socio">Sócio</option>
                        <option value="diretor_e_jogador">Diretor e Jogador</option>
                    </select>

                    <input type="submit" name="registrar" value="Registrar">
                </form>
            </section>
        </section>
    @endif
    
</div>
