<?php
namespace App\Controllers;

use App\Controllers\Controller;

class CaminhoesController  extends Controller{


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



}
