<?php

namespace App\Models\DAO;

use App\Models\Entidades\Caminhoes;
use App\Libs\DataBase\BaseDAO;

class CaminhoesDAO extends BaseDAO
{
    public  function listar($id)
    {
        if(isset($id)) 
        {
            $resultado = $this->select(
                "SELECT * FROM tipo_caminhoes WHERE id = '".$this->secure($id)."'"
            );           
        }
        else
        {
            $resultado = $this->select(
                'SELECT * FROM tipo_caminhoes'
            );            
        }
        
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Caminhoes::class);
    }

    /**
     * validar se existe caminhão cadastrado
     */

    public  function caminhaoExist($id)
    {
        if(isset($id)) 
        {
            $resultado = $this->select(
                "SELECT * FROM tipo_caminhoes WHERE id = '".$this->secure($id)."'"
            );           
        }
        
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Caminhoes::class);
    }



}