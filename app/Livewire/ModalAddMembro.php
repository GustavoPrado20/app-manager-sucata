<?php

namespace App\Livewire;

use Livewire\Component;

class ModalAddMembro extends Component
{
    public $showModalAddMembro = false;

    public function abrirModalAddMembro(){
        $this->showModalAddMembro = true;
    }

    public function fecharModalAddMembro(){
        $this->showModalAddMembro = false;
    }

    public function render()
    {
        return view('livewire.modal-add-membro');
    }
}
