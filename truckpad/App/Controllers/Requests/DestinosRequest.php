<?php

namespace App\Controllers\Requests;

use App\Controllers\Requests\Request;

class DestinosRequest extends Request
{

    public $json;

    public function __construct()
    {
        $this->json =  self::requestPost();
    }

    public function requestParamBody()
    {

        $destinos = new \App\Models\Entidades\Destinos();

        $destinos->setLatDestino($this->json['lat_destino']);
        $destinos->setLongDestino($this->json['long_destino']);
        $destinos->setCarregado($this->json['carregado']);
        $destinos->setCaminhoneiro($this->json['caminhoneiro']);
       
        return $destinos;

    }

  


}

?>