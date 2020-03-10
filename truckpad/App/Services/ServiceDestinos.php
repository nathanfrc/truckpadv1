<?php

namespace App\Services;

use App\Models\DAO\DestinosDAO;
use App\Models\Entidades\Destinos;

class ServiceDestinos{


    public function listar($id)
    {
        $destinosDAO = new DestinosDAO();
        $destinos = $destinosDAO->listar($id);

      
        $dados = [];
        $y=0;

        if(count($destinos) > 1)
        {
            foreach($destinos as $r)
            {
               
                $dados[$y]['id'] = $r->getId();
                $dados[$y]['lat_destino'] = $r->getLatDestino();
                $dados[$y]['long_destino'] = $r->getLongDestino();
                $dados[$y]['carregado'] = $r->getCarregado();
                $dados[$y]['caminhoneiro'] = $r->getCaminhoneiro();
                $dados[$y]['adicionado'] = $r->getAdiciona();
                
                ++$y;
    
               
            }

        }else{

                $dados['id'] = $destinos[0]->getId();
                $dados['lat_destino'] = $destinos[0]->getLatDestino();
                $dados['long_destino'] = $destinos[0]->getLongDestino();
                $dados['carregado'] = $destinos[0]->getCarregado();
                $dados['caminhoneiro'] = $destinos[0]->getCaminhoneiro();
                $dados['adicionado'] = $destinos[0]->getAdiciona();
        
        }

       
       return(json_encode($dados));

         

    }


  


}