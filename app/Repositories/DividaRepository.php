<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Divida;

class DividaRepository extends AbstractRepository
{
    protected static $model = Divida::class;

    public static function findById(int $id){
        return self::loadModel()::query()->where( ['id' => $id])->first();  
    }

    public static function dividasPendentes(int $id_membro)
    {
        return self::loadModel()::query()->where('id_membro', '=', $id_membro)->where('situação', '=', 'Pendente')->get();
    }

    public static function FaltasPagaMes($mes)
    {
        $faltas = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Falta')
        ->get()->count();

        $total = $faltas * 30;

        return $total;
    }

    public static function mensalidadesPagasMes($mes)
    {
        $pagasDeJaneiro = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 10)
        ->get()->count();

        $pagasJogadores = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 40)
        ->get()->count();

        $pagasSocios = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 20)
        ->get()->count();

        $total = ($pagasDeJaneiro * 10) + ($pagasJogadores * 40) + ($pagasSocios * 20);
        
        return $total;
    }

    public static function cartoesPagosMes($mes)
    {
        $amarelos = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Cartão Amarelo')
        ->get()->count();

        $vermelhos = self::loadModel()::query()->where('situação', '=', 'Paga')
        ->whereMonth('data', $mes)
        ->where('referente', '=', 'Cartão Vermelho')
        ->get()->count();

        $total = ($amarelos * 20) + ($vermelhos * 25);

        return $total;
    }

    public static function receitaTotal()
    {
        $receitas = self::loadModel()::query()->where('situação', '=', 'Paga')->get();

        $total = 0;

        foreach($receitas as $receita)
        {
            $total = $receita['valor'] + $total;
        }
        
        return $total;
    }

    public static function totalPrevsDez()
    {
        $dividas = self::loadModel()::query()->where('referente', '!=', 'Mensalidade')->get();
        $totalDivida = 0;

        foreach ($dividas as $divida)
        {
            $totalDivida = $divida['valor'] + $totalDivida;
        }

        $socios = MembroRepository::sociosEAcordo()->count();

        $jogadores = MembroRepository::jogadoresSemAcordo()->count();

        $total = $totalDivida + ($socios * 11 * 20) + ($jogadores * 11 * 40) + ($jogadores * 10);

        return $total;
    }

    public static function totalRecebidoNosMeses()
    {
        $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $totalMeses = [];

        for($count = 0; $count < 12; $count ++)
        {
            $faltasPagas = DividaRepository::FaltasPagaMes($meses[$count]);
            $mensalidadesPagas = DividaRepository::mensalidadesPagasMes($meses[$count]);
            $cartoesPagos = DividaRepository::cartoesPagosMes($meses[$count]);

            $totalMeses[$count] = htmlspecialchars(strval($faltasPagas + $mensalidadesPagas + $cartoesPagos), ENT_QUOTES, 'UTF-8');
        }

        return $totalMeses;
    }
}