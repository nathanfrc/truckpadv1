<?php

namespace App\Libs;

class Paginate {



    public function paginates($dados,$contador)
    {
           
        $inicio = ($dados['page'] * $dados['size']) - $dados['size']; //Variável para LIMIT da sql
            
        $paginas = ceil($contador/$dados['size']);	//Quantidade de páginas	

        if($dados['page'] > $paginas)
        {
            $retorno['status'] = 'false';
            $retorno['erro'] = 'Não há mais buscas de paginação';

            return $retorno;
        }
        
        if($inicio == 0)
        {
            ++$inicio;
        }

        return ['inicio' => $inicio, 'paginas' => $paginas];
    }




}