<?php

namespace App\Services;

use App\Models\DAO\CaminhoesDAO;

class ServiceCaminhoes{


	public function listar($id)
    {
        $caminhoesDAO = new CaminhoesDAO();
        $caminhoes = $caminhoesDAO->listar($id);

        $dados = [];
        $y=0;

        foreach($caminhoes as $r)
        {
            $dados[$y]['id'] = $r->getId();
            $dados[$y]['titulo'] = $r->getTitulo();
            $dados[$y]['adicionado'] = $r->getAdicionado();
            ++$y;
        }


        

       return(json_encode($dados));

         

    }

  


}