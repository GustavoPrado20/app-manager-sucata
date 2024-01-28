<?php

namespace App\Livewire;

use App\Repositories\DividaRepository;
use Livewire\Component;

class ModalAddReceita extends Component
{
    public $membro;
    public $dadosMembros;
    public $showModalAddReceita = false;
    public $LoginAuth;

    public $dadosDividaMembro;

    public function abrirModalAddReceita(){
        $this->showModalAddReceita = true;
    }
    public function fecharModalAddReceita(){
        $this->showModalAddReceita = false;
    }

    public function render()
    {
        $this->dadosDividaMembro = DividaRepository::dividasPendentes(intval($this->membro));
        return view('livewire.modal-add-receita',['membro' => $this->membro, 'dadosDividaMembro' => $this->dadosDividaMembro]);
    }
}
