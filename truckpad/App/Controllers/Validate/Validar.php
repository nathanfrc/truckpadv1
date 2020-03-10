<?php

namespace App\Controllers\Validate;

use  App\Controllers\validate\ResultadoValidacao;

use App\Models\Entidades\Caminhoneiros;
use App\Models\Entidades\Destinos;


class Validar extends ResultadoValidacao {

    
    public function parametroBuscaId($id)
    {

         if($id !== null)
         {
              if(!empty($id))
              {
                if(!is_numeric($id))
                {
                    self::addErro("id: E permtido apenas numero");
                }

              }else{

                 self::addErro("id: nao pode ser vazio");
              }
          
         }
    }

    public function validaPostCaminhoneiro(Caminhoneiros $caminhoneiro , $id = false)
    {

      /**
       * Validando nome 
       */
          if(!empty($caminhoneiro->getNome()))
          {
              if(strlen($caminhoneiro->getNome() > 250))
              {
                 self::addErro("Nome: não pode ter mais que 250 caracteres");

              }

          }else{

            self::addErro("Nome: nao pode ser vazio");

          }

          /**
           * Valdiando DAta de nascimento
           * heckdate ( int $month , int $day , int $year ) : bool
           */

          if(!empty($caminhoneiro->getDataNascimento()))
          {
               $data = explode('-',$caminhoneiro->getDataNascimento());

               if(!checkdate($data[1], $data[2], $data[0]))
               {
                 self::addErro("data_nascimento : formatado invalido");
               }

          }else{

            self::addErro("data_nascimento : nao pode ser vazio");

          }


          /**
           * Validando sexo
           */

           if(!empty($caminhoneiro->getSexo()))
           {

              if(trim($caminhoneiro->getSexo()) <> 'M' &&  trim($caminhoneiro->getSexo()) <> 'F')
              {
                 self::addErro("sexo : invalido apenas M ou F");
              }

           }else{

                self::addErro("sexo : nao pode ser vazio");
           }


           /**
            * Validando se possui veiculo proprio
            */

            if(!empty($caminhoneiro->getPossuiVeiculo()))
            {
 
               if(trim($caminhoneiro->getPossuiVeiculo()) <> 'Y' &&  trim($caminhoneiro->getPossuiVeiculo()) <> 'N')
               {
                  self::addErro("possui_veiculo : invalido apenas Y ou N");
               }
 
            }else{
 
                 self::addErro("possui_veiculo : nao pode ser vazio");
            }

             /**
            * Validando se tipo de veiculo
            */

            if(!empty($caminhoneiro->getCaminhoes()))
            {
 
               if(!is_numeric($caminhoneiro->getCaminhoes()))
               {
                  self::addErro("tipo_veiculo : formato invalido");

               }else{

                  $caminhaoDAO = new \App\Models\DAO\CaminhoesDAO();
                
                  if(count($caminhaoDAO->caminhaoExist($caminhoneiro->getCaminhoes()))==0)
                  {
                     self::addErro("tipo_veiculo : Nao existe");

                  }
                
               }

            }else{
 
                 self::addErro("tipo_veiculo : nao pode ser vazio");
            }

            /**
             * lat_origem long_origrm
             */

            if(!empty($caminhoneiro->getLatOrigem()))
            {
              if(!is_float($caminhoneiro->getLatOrigem()))
              {
                 self::addErro("lat_origem : formato invalido");
              }

            }else{
              self::addErro("lat_origem : nao pode ser vazio");
            }

               /**
             * lat_origem long_origrm
             */

            if(!empty($caminhoneiro->getLongOrigem()))
            {
              if(!is_float($caminhoneiro->getLongOrigem()))
              {
                 self::addErro("long_origem : formato invalido");
              }

            }else{
              self::addErro("long_origem : nao pode ser vazio");
            }


            if(!empty($caminhoneiro->getTipoCnh()))
            {
              $tiposCnh = ['A','B','C','D','E'];

              if(!in_array($caminhoneiro->getTipoCnh(),$tiposCnh))
              {
                 self::addErro("tipo_cnh : formato invalido : A,B,C,D,E");
              }

            }else{
              self::addErro("tipo_cnh : nao pode ser vazio");
            }

            if($id === false)
            {
                if(!empty($caminhoneiro->getNumeroCnh()))
                {
                
                  if(!is_numeric($caminhoneiro->getNumeroCnh()))
                  {
                      self::addErro("cnh : formato invalido");
                  }

                  
                  $caminhoneiroDAO = new \App\Models\DAO\CaminhoneirosDAO();
                    
                  if(count($caminhoneiroDAO->validarSeCadastroExiste($caminhoneiro->getNumeroCnh()))>0)
                  {
                      self::addErro("cnh : Já esxiste um motorista com essa cnh");

                  }

                }else{
                  self::addErro("cnh : nao pode ser vazio");
                }
           }




          if($id !== false)
          {
              if(!empty($id))
              {
                if(!is_numeric($id))
                {
                  self::addErro("id : formato invalido");
                }

                $caminhoneirosDAO = new \App\Models\DAO\CaminhoneirosDAO();

                if(count($caminhoneirosDAO->listar($id))==0)
                {
                  self::addErro("caminhoneiro : caminhoneiro nao existe");
  
                }

              }else{

                self::addErro("id : nao pode ser vazio");
              }
             

          }

    }


    public function validaPostDestinos(Destinos $destinos,$id = false)
    {

        if(!empty($destinos->getLatDestino()))
        {
          if(!is_float($destinos->getLatDestino()))
          {
            self::addErro("lat_destino : formato invalido");
          }

        }else{
          self::addErro("lat_destino : nao pode ser vazio");
        }

            /**
           * lat_origem long_origrm
           */

          if(!empty($destinos->getLongDestino()))
          {
            if(!is_float($destinos->getLongDestino()))
            {
              self::addErro("long_destino : formato invalido");
            }

          }else{
            self::addErro("long_destino : nao pode ser vazio");
          }

          if(!empty($destinos->getCarregado()))
          {

            if(trim($destinos->getCarregado()) <> 'Y' &&  trim($destinos->getCarregado()) <> 'N')
            {
                self::addErro("carregado : invalido apenas Y ou N");
            }

          }else{

              self::addErro("carregado : nao pode ser vazio");
          }


          if(!empty($destinos->getCaminhoneiro()))
          {
           
            if(!is_numeric($destinos->getCaminhoneiro()))
             {
                self::addErro("caminhoneiro : formato invalido");
             }

             $caminhoneirosDAO = new \App\Models\DAO\CaminhoneirosDAO();

             if(count($caminhoneirosDAO->listar($destinos->getCaminhoneiro()))==0)
             {
                self::addErro("caminhoneiro : caminhoneiro nao existe");

             }

          }else{
            self::addErro("caminhoneiro : nao pode ser vazio");
          }


        
          

      }


      public function validarData($data)
      {

        if($data['data_inicio'] !== false)
        {

            if(!empty($data['data_inicio']))
            {
              $data = explode('-',$data['data_inicio']);

              if(!checkdate($data[1], $data[2], $data[0]))
              {
                self::addErro("data: formatado invalido");
              }

            }else{

              self::addErro("data: nao pode ser vazia");
            }

           
        }
       
      }
      
      
          

}