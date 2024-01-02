<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class ModalAddMembro extends Component
{
    public $showModalAddMembro = false;
    public $showModalBuscarMembro = false;
    public $showModalLoginAuth  = false;

    public function abrirModalAddMembro(){
        if(Auth::check()){
            $this->showModalAddMembro = true;
        }
        else {
            $this->showModalLoginAuth =true;
        }
        
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

    public function fecharModalLoginAuth(){
        $this->showModalLoginAuth = false;
    }

    public function render()
    {
        return view('livewire.modal-add-membro');
    }
}
