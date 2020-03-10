<?php
namespace App\Controllers;

use App\Controllers\Controller;

class CaminhoneiroController  extends Controller{


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
				
				$serviceCaminhoneiros =  new  \App\Services\ServiceCaminhoneiros();
				\print_r($serviceCaminhoneiros->listar($id));


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
					$request = new \App\Controllers\Requests\CaminhoneiroRequest();
				
					$validar = new \App\Controllers\Validate\Validar();

					$entidadeCaminhoneiro = $request->requestParamBody();

					$validar->validaPostCaminhoneiro($entidadeCaminhoneiro);

					if($validar->getErros())
					{
						http_response_code(400);
						$retorno['status'] = 400;
						$retorno['erro'] = $validar->getErros();
						
						echo self::retornoJson($retorno);
						exit;
					}

				
					$caminhoneirosDAO = new \App\Models\DAO\CaminhoneirosDAO();

					$retorno = $caminhoneirosDAO->salvar($entidadeCaminhoneiro);

					if(is_numeric($retorno))
					{
						\http_response_code(201);

						$serviceCaminhao =  new  \App\Services\ServiceCaminhoneiros();

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


		public function update($param)
		{
			if($_SERVER['REQUEST_METHOD'] == 'PUT')
			{
				$id = isset($param[0]) ? $param[0] : false;

				$request = new \App\Controllers\Requests\CaminhoneiroRequest();
				
				$validar = new \App\Controllers\Validate\Validar();

				$entidadeCaminhoneiro = $request->requestParamBody();

				$validar->validaPostCaminhoneiro($entidadeCaminhoneiro,$id);

				if($validar->getErros())
				{
					http_response_code(400);
					$retorno['status'] = 400;
					$retorno['erro'] = $validar->getErros();
					
					echo self::retornoJson($retorno);
					exit;
				}

				$entidadeCaminhoneiro->setId($id);

				$caminhoneirosDAO = new \App\Models\DAO\CaminhoneirosDAO();

				$retorno = $caminhoneirosDAO->editar($entidadeCaminhoneiro);

				if(!empty($retorno))
				{
					\http_response_code(201);
				}

				
				

			}else{

				http_response_code(400);
				$retorno_erro['status'] = 400;
				$retorno_erro['erro'] = "Metodo invalido";
				echo self::retornoJson($retorno_erro);
			 }
			 exit;
		}

		public function listarTodosSemCarga($param):void 
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
				
				$serviceCaminhoneiros =  new  \App\Services\ServiceCaminhoneiros();
				\print_r($serviceCaminhoneiros->listarTodosSemCarga($id));


			}else{

					http_response_code(400);
					$retorno_erro['status'] = 400;
					$retorno_erro['erro'] = "Metodo invalido";
					echo self::retornoJson($retorno_erro);
					exit;
			}

		}


		public function relatorios():void 
		{

			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$param['data_inicio'] = isset($_REQUEST['data_inicio']) ? $_REQUEST['data_inicio'] : false;

				$validar = new \App\Controllers\Validate\Validar();

				$validar->validarData($param);

					if(($msg = $validar->getErros()))
					{
						http_response_code(400);
						$retorno_erro['status'] = 400;
						$retorno_erro['erro'] = $msg;
						echo self::retornoJson($retorno_erro);
						exit;
					}

				
				$serviceCaminhoneiros =  new  \App\Services\ServiceCaminhoneiros();
				\print_r($serviceCaminhoneiros->relatorios($param));


			}else{

					http_response_code(400);
					$retorno_erro['status'] = 400;
					$retorno_erro['erro'] = "Metodo invalido";
					echo self::retornoJson($retorno_erro);
					exit;
			}

		}






}
