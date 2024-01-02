<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalsEditarERemoverMembro extends Component
{
    public $showModalEditarMembro = false;
    public $showModalRemoverMembro = false;
    public $showModalLoginAuth  = false;

    public function abrirModalEditarMembro()
    {
        if(Auth::check()){
            $this->showModalEditarMembro =  true;
        }
        else {
            $this->showModalLoginAuth =true;
        }
        
    }

    public function fecharModalEditarMembro()
    {
        $this->showModalEditarMembro =  false;
    }

    public function abrirModalRemoverMembro()
    {
        if(Auth::check()){
            $this->showModalRemoverMembro =  true;
        }
        else {
            $this->showModalLoginAuth =true;
        }
        
    }

    public function fecharModalRemoverMembro()
    {
        $this->showModalRemoverMembro =  false;
    }

    public function fecharModalLoginAuth(){
        $this->showModalLoginAuth = false;
    }

    public function render()
    {
        return view('livewire.modals-editar-e-remover-membro');
    }
}
