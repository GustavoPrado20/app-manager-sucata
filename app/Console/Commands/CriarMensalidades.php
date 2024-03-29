<?php

namespace App\Console\Commands;

use App\Actions\CreateMonthlyFeeAction;
use App\Models\Membro;
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
    protected $description = 'Criar Mensalidade Automaticamente todo dia 01 do mes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $membros = Membro::findByStatus(true);

        foreach($membros as $membro)
        {
            CreateMonthlyFeeAction::execute(intval($membro['id']));
        }

        $this->info('Mensalidades Criada com Sucesso!');
    }
}
