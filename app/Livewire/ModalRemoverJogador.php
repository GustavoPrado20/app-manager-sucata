<?php

namespace App\Livewire;

use App\Models\Membro;
use Livewire\Component;

class ModalRemoverJogador extends Component
{
    public $showModalRemoverJogador = false;
    public $id_jogador;

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
        Membro::updateId($this->id_jogador, ['id_time' => null]);

        return redirect(route('jogos'));    
    }

    public function render()
    {
        return view('livewire.modal-remover-jogador');
    }
}
