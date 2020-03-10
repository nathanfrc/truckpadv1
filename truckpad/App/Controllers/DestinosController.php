<?php
namespace App\Controllers;

use App\Controllers\Controller;

class DestinosController  extends Controller{


		public function listar($param):void 
		{

		 if($_SERVER['REQUEST_METHOD'] == 'GET')
		 {
				$id = isset($param[0]) ? $param[0] : null;

				$validar = new \App\Controllers\Validate\Validar();
		        $validar->parametroBuscaId($id);

		        if(($msg = $validar->getErros()))
		        {
		        	http_response_code(400);
		            $retorno_erro['status'] = 400;
		            $retorno_erro['erro'] = $msg;
		            echo self::retornoJson($retorno_erro);
		            exit;
		        }
		    
			 $serviceCaminhao =  new  \App\Services\ServiceCaminhoes();
			 \print_r($serviceCaminhao->listar($id));


	       }else{

	       		http_response_code(400);
		       	$retorno_erro['status'] = 400;
		       	$retorno_erro['erro'] = "Metodo invalido";
		        echo self::retornoJson($retorno_erro);
		        exit;
	       }

		}


		/**
		 * criar caminhoneiro
		 */
		public function create()
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				  $request = new \App\Controllers\Requests\DestinosRequest();
			
				 $validar = new \App\Controllers\Validate\Validar();

				 $entidadeDestinos = $request->requestParamBody();

				 $validar->validaPostDestinos($entidadeDestinos);

				 if($validar->getErros())
				 {
					http_response_code(400);
					$retorno['status'] = 400;
					$retorno['erro'] = $validar->getErros();
					
					echo self::retornoJson($retorno);
					exit;
				}

				
				$destinosDAO = new \App\Models\DAO\DestinosDAO();

				$retorno = $destinosDAO->salvar($entidadeDestinos);

				if(is_numeric($retorno))
				{
					\http_response_code(201);

					$serviceCaminhao =  new  \App\Services\ServiceDestinos();

					\print_r($serviceCaminhao->listar($retorno));

				}

			


			
			}else{

				http_response_code(400);
				$retorno_erro['status'] = 400;
				$retorno_erro['erro'] = "Metodo invalido";
			    echo self::retornoJson($retorno_erro);
			 exit;
		}

		}



}
