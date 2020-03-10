<?php

namespace App\Services;

use App\Models\DAO\CaminhoneirosDAO;
use App\Models\Entidades\Caminhoneiros;

class ServiceCaminhoneiros{


    public function listar($id)
    {
        $caminhoneirosDAO = new CaminhoneirosDAO();
        $caminhoneiros = $caminhoneirosDAO->listar($id);

        $dados = [];
        $y=0;

        if(count($caminhoneiros) > 1)
        {
            foreach($caminhoneiros as $r)
            {
               
                $dados[$y]['id'] = $r->getId();
                $dados[$y]['nome'] = $r->getNome();
                $dados[$y]['cnh'] = $r->getNumeroCnh();
                $dados[$y]['data_nascimento'] = $r->getDataNascimento();
                $dados[$y]['sexo'] = $r->getSexo();
                $dados[$y]['possui_veiculo'] = $r->getPossuiVeiculo();
                $dados[$y]['tipo_cnh'] = $r->getTipoCnh();
                $dados[$y]['tipo_caminhao'] = $r->getCaminhoes();
                $dados[$y]['lat_origem'] = $r->getLatOrigem();
                $dados[$y]['long_origem'] = $r->getLongOrigem();
                $dados[$y]['adicionado'] = $r->getAdicona();
                $dados[$y]['adicionado_last_update'] = $r->getLastAdicionado();
                ++$y;
    
               
            }

        }else{

              if(count($caminhoneiros) == 1)
              {
                    $dados['id'] = $caminhoneiros[0]->getId();
                    $dados['nome'] = $caminhoneiros[0]->getNome();
                    $dados['cnh'] = $caminhoneiros[0]->getNumeroCnh();
                    $dados['data_nascimento'] = $caminhoneiros[0]->getDataNascimento();
                    $dados['sexo'] = $caminhoneiros[0]->getSexo();
                    $dados['possui_veiculo'] = $caminhoneiros[0]->getPossuiVeiculo();
                    $dados['tipo_cnh'] = $caminhoneiros[0]->getTipoCnh();
                    $dados['tipo_caminhao'] = $caminhoneiros[0]->getCaminhoes();
                    $dados['lat_origem'] = $caminhoneiros[0]->getLatOrigem();
                    $dados['long_origem'] = $caminhoneiros[0]->getLongOrigem();
                    $dados['adicionado'] = $caminhoneiros[0]->getAdicona();
                    $dados['adicionado_last_update'] = $caminhoneiros[0]->getLastAdicionado();

              }
               

        }

       
       return(json_encode($dados));

         
    }


    public function listarTodosSemCarga()
    {
        $caminhoneirosDAO = new CaminhoneirosDAO();
        $caminhoneiros = $caminhoneirosDAO->listarTodosSemCarga($id);

       
        $dados = [];
        $y=0;

        foreach($caminhoneiros as $r)
        {
           
            $dados[$y]['id'] = $r['id'];
            $dados[$y]['nome'] = $r['nome'];
            $dados[$y]['cnh'] = $r['numero_cnh'];
            $dados[$y]['data_nascimento'] = $r['data_nascimento'];
            $dados[$y]['sexo'] = $r['sexo'];
            $dados[$y]['possui_veiculo'] = $r['possui_veiculo'];
            $dados[$y]['tipo_cnh'] = $r['tipo_cnh'];
            $dados[$y]['lat_origem'] = $r['lat_origem'];
            $dados[$y]['long_origem'] = $r['long_origem'];
            $dados[$y]['adicionado'] = $r['adiciona'];
            $dados[$y]['titulo'] = $r['titulo'];
            ++$y;

        }

        return(json_encode($dados));


    }


    public function relatorios($param)
    {
        $param['data_inicio'];

        $caminhoneirosDAO = new CaminhoneirosDAO();

        $qtPossuiVeiculos = $caminhoneirosDAO->quantidadesCaminhoneirosVeiculoProprio();

        $dados['qt_possui_veiculos_proprio'] = (int) $qtPossuiVeiculos[0]['total'];

        $qtVeiculosPassados = $caminhoneirosDAO->quantidadesCaminhoneirosVeiculoPassados($param);

        if($param['data_inicio'] !== false)
        {
            $dados['data_inicio'] = $param['data_inicio'];
        }

        $dados['qt_veiculos_passos'] = $qtVeiculosPassados[0]['total'];

        return(json_encode($dados));


    }




  


}