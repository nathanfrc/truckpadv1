<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\DAO\BuilderDAO;

class BuilderController  extends Controller{


		public function index($param):void 
		{

		 if($_SERVER['REQUEST_METHOD'] == 'GET')
		 {
			 $builderDAO = new BuilderDAO();

			 $builderDAO->createAllDatabase();



	       }else{

	       		http_response_code(400);
		       	$retorno_erro['status'] = 400;
		       	$retorno_erro['erro'] = "Metodo invalido";
		        echo self::retornoJson($retorno_erro);
		        exit;
	       }





		}



}
