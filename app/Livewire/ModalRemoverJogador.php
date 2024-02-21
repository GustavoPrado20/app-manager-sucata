<?php

namespace App\Livewire;

use App\Models\Membro;
use Livewire\Component;

class ModalRemoverJogador extends Component
{
    public $showModalRemoverJogador = false;
    protected $id_membro;

    public function abrirModalRemoverJogador()
    {
        $this->showModalRemoverJogador = true;
    }

    public function fecharModalRemoverJogador()
    {
        $this->showModalRemoverJogador = false;
    }

    public function removerJogador()
    {
        Membro::updateId($this->id_membro, ['id_time' => null]);
    }

    public function render()
    {
        return view('livewire.modal-remover-jogador');
    }
}
