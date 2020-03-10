<?php

namespace App\Models\DAO;

use App\Models\Entidades\Destinos;
use App\Libs\DataBase\BaseDAO;

class DestinosDAO extends BaseDAO
{
    public  function listar($id)
    {
        if(isset($id)) 
        {
            $resultado = $this->select(
                "SELECT * FROM destinos WHERE id = $id"
            );           
        }
        else
        {
            $resultado = $this->select(
                'SELECT * FROM destinos'
            );            
        }
        
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Destinos::class);
    }


    public function validarSeCadastroExiste($cnh)
    {
        $resultado = $this->select(
            "SELECT * FROM caminhoneiros WHERE numero_cnh = $cnh"
        );  

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Caminhoneiros::class);

    }

    public  function salvar(Destinos $destinos) 
    {
        try 
        {
          
            $lat = $destinos->getLatDestino();
            $long =   $destinos->getLongDestino();
            $carregado =  $destinos->getCarregado();
            $caminhoneiros =  $destinos->getCaminhoneiro();
           
            return $this->insert(
                'destinos',
                ":lat_destino,:long_destino,:carregado,:fk_caminhoneiros",
                [
                    ':lat_destino'=>$lat,
                    ':long_destino'=>$long,
                    ':carregado'=>$carregado,
                    ':fk_caminhoneiros' => $caminhoneiros
                ]
            );

        }

        catch (\Exception $e)
        {
            throw new \Exception("Erro na gravacao de dados.".$e->getMessage());
        }
    }


}