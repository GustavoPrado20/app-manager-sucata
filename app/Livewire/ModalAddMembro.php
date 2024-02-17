<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class ModalAddMembro extends Component
{
    public $showModalAddMembro = false;
    public $showModalSearchMembro = false;
    public $LoginAuth;
 
    public function abrirModalAddMembro(){
        $this->showModalAddMembro = true;
    }

    public function fecharModalAddMembro(){
        $this->showModalAddMembro = false;
    }

    public function abrirModalSearchMembro(){
        $this->showModalSearchMembro = true;
    }

    public function fecharModalSearchMembro(){
        $this->showModalSearchMembro = false;
    }

    public function render()
    {
        return view('livewire.modal-add-membro');
    }
}
