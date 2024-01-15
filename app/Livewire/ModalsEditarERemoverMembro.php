<?php

namespace App\Livewire;

use App\Repositories\MembroRepository;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class ModalsEditarERemoverMembro extends Component
{
    public $showModalEditarMembro = false;
    public $showModalRemoverMembro = false;

    public $idMembro;
    public $dadoMembro;

    public function abrirModalEditarMembro()
    {
        $this->dadoMembro = MembroRepository::find($this->idMembro);

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
        $this->dadoMembro = MembroRepository::find($this->idMembro);

        $status = ['status' => !$this->dadoMembro['status']];
        $remover = MembroRepository::update($this->idMembro,$status);

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
