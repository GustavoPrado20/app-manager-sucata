<?php

namespace App\Livewire;

use Livewire\Component;

class ModalAddJogador extends Component
{
    public $LoginAuth;
    public $dadosJogadores;
    public $showModalAddJogador = false;

    public function abrirModalAddJogador(){
         $this->showModalAddJogador = true;
    }
    public function fecharModalAddJogador(){
        $this->showModalAddJogador = false;
   }

    public function render()
    {
        return view('livewire.modal-add-jogador');
    }
}
