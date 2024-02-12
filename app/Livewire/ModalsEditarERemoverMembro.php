<?php

namespace App\Livewire;

use App\Models\Membro;
use Livewire\Component;


class ModalsEditarERemoverMembro extends Component
{
    public $showModalEditarMembro = false;
    public $showModalRemoverMembro = false;

    public $idMembro;
    public $dadoMembro;

    public function abrirModalEditarMembro()
    {
        $this->dadoMembro = Membro::findById($this->idMembro);

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

    public function removerMembro(){
        $this->dadoMembro = Membro::findById($this->idMembro);
        
        $status = ['status' => !$this->dadoMembro['status'], 'id_time' => null];
        $remover = Membro::updateId($this->idMembro,$status);

        if($remover)
        {
            return redirect(route('membros'));
        }    
    }

    public function render()
    {
        return view('livewire.modals-editar-e-remover-membro');
    }
}
