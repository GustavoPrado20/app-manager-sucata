<?php

namespace App\Livewire;

use Livewire\Component;

class ModalAddDispesa extends Component
{
    public $showModalAddDespesa = false;
    public $LoginAuth;

    public function abrirModalAddDespesa(){
        $this->showModalAddDespesa = true;
    }
    public function fecharModalAddDespesa(){
        $this->showModalAddDespesa = false;
    }

    public function render()
    {
        return view('livewire.modal-add-dispesa');
    }
}
