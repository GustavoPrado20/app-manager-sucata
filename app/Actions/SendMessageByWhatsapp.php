<?php

namespace App\Actions;

// require_once(__DIR__ . '../../vendor/autoload.php');

use ApiGratis\ApiBrasil;

class SendMessageByWhatsapp
{
    public static function enviarTeste()
    {
        return ApiBrasil::WhatsAppService("start", [
            "serverhost" => "https://whatsapp2.contrateumdev.com.br", //required
            "method" => "POST", //optional
            "apitoken" => "ApiGratisToken2021", //required
            "session" => "teste123", //required
            "sessionkey" => "teste123", //required
            "wh_status" => "", //optional
            "wh_message" => "", //optional
            "wh_connect" => "", //optional
            "wh_qrcode" => "", //optional
        ]);
    }
    
}

