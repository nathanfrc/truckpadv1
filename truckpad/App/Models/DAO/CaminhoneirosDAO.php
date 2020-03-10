<?php

namespace App\Models\DAO;

use App\Models\Entidades\Caminhoneiros;
use App\Libs\DataBase\BaseDAO;

class CaminhoneirosDAO extends BaseDAO
{
    public  function listar($id)
    {
        if(isset($id)) 
        {
            $resultado = $this->select(
                "SELECT * FROM caminhoneiros WHERE id = '".$this->secure($id)."'"
            );           
        }
        else
        {
            $resultado = $this->select(
                'SELECT * FROM caminhoneiros'
            );            
        }
        
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Caminhoneiros::class);
    }


    public function validarSeCadastroExiste($cnh)
    {
        $resultado = $this->select(
            "SELECT * FROM caminhoneiros WHERE numero_cnh = '".$this->secure($cnh)."'"
        );  

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Caminhoneiros::class);

    }


    public function listarTodosSemCarga()
    {
        $resultado = $this->select(
            "SELECT caminhoneiros.id,caminhoneiros.nome,caminhoneiros.numero_cnh,caminhoneiros.data_nascimento, caminhoneiros.sexo, caminhoneiros.possui_veiculo,
            caminhoneiros.tipo_cnh,caminhoneiros.lat_origem, caminhoneiros.long_origem,tipo_caminhoes.titulo, caminhoneiros.adiciona
            FROM caminhoneiros
            left JOIN destinos ON destinos.fk_caminhoneiros = caminhoneiros.id
            INNER JOIN tipo_caminhoes ON tipo_caminhoes.id = caminhoneiros.fk_tipo_caminhoes 
            WHERE destinos.fk_caminhoneiros IS NULL"
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);   

    }



    public  function salvar(Caminhoneiros $caminhoneiros) 
    {
        try 
        {
          
            $nome = $caminhoneiros->getNome();
            $data =   $caminhoneiros->getDataNascimento();
            $sexo =  $caminhoneiros->getSexo();
            $possui =  $caminhoneiros->getPossuiVeiculo();
            $cnh =  $caminhoneiros->getTipoCnh();
            $lat =  $caminhoneiros->getLatOrigem();
            $long = $caminhoneiros->getLongOrigem();
            $tipo_veiculo = $caminhoneiros->getCaminhoes();
            $numero_cnh = $caminhoneiros->getNumeroCnh();

            return $this->insert(
                'caminhoneiros',
                ":nome,:data_nascimento,:sexo,:possui_veiculo,:tipo_cnh,:lat_origem,:long_origem,:fk_tipo_caminhoes,:numero_cnh",
                [
                    ':nome'=>$nome,
                    ':data_nascimento'=>$data,
                    ':sexo'=>$sexo,
                    ':possui_veiculo' => $possui,
                    ':tipo_cnh' => $cnh,
                    ':lat_origem' => $lat,
                    ':long_origem' => $long,
                    ':fk_tipo_caminhoes' =>$tipo_veiculo,
                    ':numero_cnh' =>$numero_cnh
                ]
            );

        }

        catch (\Exception $e)
        {
            throw new \Exception("Erro na gravacao de dados.".$e->getMessage());
        }
    }

  
    public  function editar(Caminhoneiros $caminhoneiros) 
    {
        try 
        {

            $id      = $caminhoneiros->getId();
            $nome   = $caminhoneiros->getNome();
            $numero_cnh    = $caminhoneiros->getNumeroCnh();
            $data_nascimento           = $caminhoneiros->getDataNascimento();
            $sexo                      = $caminhoneiros->getSexo();
            $possui_veiculo            = $caminhoneiros->getPossuiVeiculo();
            $tipo_cnh                  = $caminhoneiros->getTipoCnh();
            $lat                       = $caminhoneiros->getLatOrigem();
            $long                      = $caminhoneiros->getLongOrigem();
            $fk_tipo_caminhoes         = $caminhoneiros->getCaminhoes();
            $adiciona_last         =    date('Y-d-m  h:i:s');

            
            return $this->update(
                'caminhoneiros',
                "nome = :nome, numero_cnh = :numero_cnh, data_nascimento = :data_nascimento, sexo = :sexo , possui_veiculo = :possui_veiculo, tipo_cnh = :tipo_cnh , 
                 lat_origem = :lat_origem , long_origem = :long_origem , fk_tipo_caminhoes = :fk_tipo_caminhoes, adiciona_last_update = :adiciona_last_update ",
                [
                    ':id' =>$id,
                    ':nome' => $nome,
                    ':numero_cnh' => $numero_cnh,
                    ':data_nascimento' => $data_nascimento,
                    ':sexo' => $sexo,
                    ':possui_veiculo' => $possui_veiculo,
                    ':tipo_cnh' => $tipo_cnh,
                    ':lat_origem' => $lat,
                    ':long_origem' =>$long,
                    ':fk_tipo_caminhoes' =>$fk_tipo_caminhoes,
                    ':adiciona_last_update' =>$adiciona_last
                ],
                "id = :id"
            );
        }

        catch (Exception $e)
        {
            throw new Exception("Erro na gravacao de dados.");
        }
    }


    public function  quantidadesCaminhoneirosVeiculoProprio()
    {
        try{

            $resultado = $this->select(
                "SELECT COUNT(caminhoneiros.id) AS total FROM  caminhoneiros where caminhoneiros.possui_veiculo = 'Y'"
            ); 

            return $resultado->fetchAll(\PDO::FETCH_ASSOC);

        }catch (\Exception $e)
        {
            throw new \Exception("Erro na gravacao de dados.".$e->getMessage());
        }

    }
    

    public function  quantidadesCaminhoneirosVeiculoPassados($param)
    {
        try{

           $query = "SELECT COUNT(*) AS total FROM caminhoneiros
            inner JOIN destinos ON destinos.fk_caminhoneiros = caminhoneiros.id
            WHERE destinos.carregado = 'Y' and
            DATE_FORMAT(destinos.adicionado,'%Y%m%d') BETWEEN ";

            if($param['data_inicio'] !== false)
            {
                
               $query .= "DATE_FORMAT(".$this->secure($param['data_inicio'].",'%Y%m%d')
                 AND DATE_FORMAT(CURRENT_TIMESTAMP(),'%Y%m%d')");

            }else{

                $query .= "DATE_FORMAT(CURRENT_TIMESTAMP(),'%Y%m%d')
                 AND DATE_FORMAT(CURRENT_TIMESTAMP(),'%Y%m%d')";
            }

            $resultado = $this->select($query); 

            return $resultado->fetchAll(\PDO::FETCH_ASSOC);

        }catch (\Exception $e)
        {
            throw new \Exception("Erro na gravacao de dados.".$e->getMessage());
        }

    }


    

   
}