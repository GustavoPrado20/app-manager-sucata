<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class ModalAddMembro extends Component
{
    public $showModalAddMembro = false;
    public $showModalBuscarMembro = false;
    public $LoginAuth;

    public function abrirModalAddMembro(){
        $this->showModalAddMembro = true;
    }

    public function fecharModalAddMembro(){
        $this->showModalAddMembro = false;
    }

    public function abrirModalBuscarMembro(){
        $this->showModalBuscarMembro = true;
    }

    public function fecharModalBuscarMembro(){
        $this->showModalBuscarMembro = false;
    }

    public function render()
    {
        return view('livewire.modal-add-membro');
    }
}
