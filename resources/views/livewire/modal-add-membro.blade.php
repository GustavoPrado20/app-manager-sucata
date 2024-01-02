<div>
    <button class="buscar-tarefa" href = "#"><i class="fas fa-search iSearch"></i></button>
    <button class="add-membro" wire:click="abrirModalAddMembro">Add New Membro</button>

    @if($showModalAddMembro)
        <x-jet-button wire:click="openModal">
            Abrir Modal
        </x-jet-button>

        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Modal de Formulário
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <x-jet-label for="name" value="Nome" />
                        <x-jet-input type="text" wire:model="name" id="name" />
                        <x-jet-input-error for="name" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label for="email" value="Email" />
                        <x-jet-input type="email" wire:model="email" id="email"/>
                        <x-jet-input-error for="email" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-secondary-button wire:click="closeModal">
                            Fechar
                        </x-jet-secondary-button>

                        <x-jet-button class="ml-2">
                            Enviar
                        </x-jet-button>
                    </div>
                </form>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
    
</div>
