<?php

namespace App\Actions;

use App\Models\Divida;
use App\Models\Membro;
use Carbon\Carbon;

class CalculateTotalForecastForDecemberAction
{
    public static function execute()
    {
        $dividas = Divida::query()->where('referente', '!=', 'Mensalidade')->get();
        $totalDivida = 0;

        foreach ($dividas as $divida)
        {
            $totalDivida = $divida['valor'] + $totalDivida;
        }

        $jogadoresEntradaJaneiro = Membro::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->whereMonth('data-entrada-time', 1)
        ->get()
        ->count();

        $jogadores = Membro::query()->where('status', '=', true)
        ->where('acordo', '=', false)->where('isento', '=', false)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->get();

        $totalJogadores = 0;

        foreach($jogadores as $jogador)
        {
            $date = Carbon::parse($jogador['data-entrada-time'])->month;

            $mesesRestantes = 11 - $date + 1;

            $totalJogadores = ($mesesRestantes * 40) + $totalJogadores;
        }

        
        $socios = Membro::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Sócio')
            ->orWhere('acordo', '=', true);
        })->get();

        $totalSocio = 0;

        foreach($socios as $socio)
        {
            $date = Carbon::parse($socio['data-entrada-time'])->month;

            $mesesRestantes = 11 - $date + 1;

            $totalSocio = ($mesesRestantes * 20) + $totalSocio;
        }

        $total = $totalDivida + $totalJogadores + $totalSocio + ($jogadoresEntradaJaneiro * 10);

        return $total;
    }
}