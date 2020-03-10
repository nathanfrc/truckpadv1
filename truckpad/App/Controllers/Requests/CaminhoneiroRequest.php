<?php

namespace App\Controllers\Requests;

use App\Controllers\Requests\Request;

class CaminhoneiroRequest extends Request
{

    public $json;

    public function __construct()
    {
        $this->json =  self::requestPost();
    }

    public function requestParamBody()
    {

        $caminhoneiro = new \App\Models\Entidades\Caminhoneiros();

        $caminhoneiro->setNome($this->json['nome']);
        $caminhoneiro->setDataNascimento($this->json['data_nascimento']);
        $caminhoneiro->setSexo($this->json['sexo']);
        $caminhoneiro->setPossuiVeiculo($this->json['possui_veiculo']);
        $caminhoneiro->setTipoCnh($this->json['tipo_cnh']);
        $caminhoneiro->setLatOrigem($this->json['lat_origem']);
        $caminhoneiro->setLongOrigem($this->json['long_origem']);
        $caminhoneiro->setCaminhoes($this->json['tipo_veiculo']);
        $caminhoneiro->setNumeroCnh($this->json['cnh']);

        return $caminhoneiro;

    }

  


}

?>