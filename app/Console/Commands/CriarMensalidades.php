<?php

namespace App\Console\Commands;

use App\Repositories\DividaRepository;
use App\Repositories\MembroRepository;
use App\Repositories\RegistroDividaRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CriarMensalidades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:criar-mensalidades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar Meensalidade Automaticamente todo dia 01 do mes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $membros = MembroRepository::findByStatus(true);
        $date = Carbon::now();

        if($date->month != 1) 
        {
            foreach($membros as $membro)
            {
                if(($membro['ocupação'] == 'Jogador' or $membro['ocupação'] == 'Diretor e Jogador') and $membro['acordo'] == false)
                {
                    $data = ['id_membro' => $membro['id'], 'referente' => 'Mensalidade', 'valor' => 40, 'data' => $date];
                    DividaRepository::create($data);
                    RegistroDividaRepository::atualizar($membro['id']);
                }
                else
                {
                    $data = ['id_membro' => $membro['id'], 'referente' => 'Mensalidade', 'valor' => 20, 'data' => $date];
                    DividaRepository::create($data);
                    RegistroDividaRepository::atualizar($membro['id']);
                }
            }
    
            $this->info('Mensalidades Criada com Sucesso!');
        }
    }
}
