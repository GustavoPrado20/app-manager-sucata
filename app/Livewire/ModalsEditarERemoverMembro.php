<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalsEditarERemoverMembro extends Component
{
    public $showModalEditarMembro = false;
    public $showModalRemoverMembro = false;

    public function abrirModalEditarMembro()
    {
        $this->showModalEditarMembro =  true;
    }

    public function fecharModalEditarMembro()
    {
        $this->showModalEditarMembro =  false;
    }

    public function abrirModalRemoverMembro()
    {
        $this->showModalRemoverMembro =  true;
    }

    public function fecharModalRemoverMembro()
    {
        $this->showModalRemoverMembro =  false;
    }

    public function render()
    {
        return view('livewire.modals-editar-e-remover-membro');
    }
}
