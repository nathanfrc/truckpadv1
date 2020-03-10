<?php

namespace App\Libs;

class Paginate {



    public function paginates($dados,$contador)
    {
           
        $inicio = ($dados['page'] * $dados['size']) - $dados['size']; //Vari�vel para LIMIT da sql
            
        $paginas = ceil($contador/$dados['size']);	//Quantidade de p�ginas	

        if($dados['page'] > $paginas)
        {
            $retorno['status'] = 'false';
            $retorno['erro'] = 'N�o h� mais buscas de pagina��o';

            return $retorno;
        }
        
        if($inicio == 0)
        {
            ++$inicio;
        }

        return ['inicio' => $inicio, 'paginas' => $paginas];
    }




}