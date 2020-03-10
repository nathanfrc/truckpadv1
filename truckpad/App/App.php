<?php

namespace App;

use Exception;

class App
{

    private $controller;
    private $controllerFile;
    private $action;
    private $params;
    public  $controllerName;
    public $controllerRetorno;

    public function __construct()
    {
        /*
         * Constantes do sistema
         */
        define('APP_HOST'       , $_SERVER['HTTP_HOST'] . "/truckpad");
        define('PATH'           , realpath('./'));
        define('TITLE'          , "Truckpad");
        define('DB_HOST'        , "localhost");
        define('DB_USER'        , "truckpad");
        define('DB_PASSWORD'    , "truckpad");
        define('DB_NAME'        , "truckpad_teste");
        define('DB_DRIVER'      , "mysql");
        define('DEBUG'          , false);
        define('DB_LOG'          , "");
        define('RPP'            ,500);
        define('MAX_PAGE'       ,35);
        define('PATH_PROJECT', 'App');
        define('PATH_LOG', PATH ."/App/Libs/Log/main.log");
    

        date_default_timezone_set("America/Sao_Paulo");
        error_reporting(E_ALL & ~ E_NOTICE);


        $this->$controllerRetorno = new \App\Controllers\Controller();


        $this->url();
    }


    public function run()
    {

        if ($this->controller)
        {
            $this->controllerName = ucwords($this->controller) . 'Controller';
            $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName);

        } else {

            \http_response_code(400);
            $retorno['status'] = 400;
            $retorno['erro'] = "Metodo nao encontrado";
            echo  $this->$controllerRetorno->retornoJson($retorno);
            exit;
        }

        $this->controllerFile   = $this->controllerName . '.php';
        $this->action           = preg_replace('/[^a-zA-Z]/i', '', $this->action);

        if (!$this->controller)
        {
            $this->controller = new HomeController($this);
            $this->controller->index();
        }


        if (!file_exists(PATH . '/App/Controllers/' . $this->controllerFile))
        {
            \http_response_code(400);
            $retorno['status'] = 400;
            $retorno['erro'] = "Pagina nao encontrada";
            echo  $this->$controllerRetorno->retornoJson($retorno);
            exit;
        }

        $nomeClasse     = "\\App\\Controllers\\" . $this->controllerName;
        $objetoController = new $nomeClasse($this);

        if (!class_exists($nomeClasse))
        {
            \http_response_code(400);
            $retorno['status'] = 400;
            $retorno['erro'] = "Método não encontratado2";
            echo  $this->$controllerRetorno->retornoJson($retorno);
            exit;
        }
        if (method_exists($objetoController, $this->action))
        {
            $objetoController->{$this->action}($this->params);
            return;
        } else if (!$this->action && method_exists($objetoController, 'index'))
        {
            $objetoController->index($this->params);
            return;
        } else {

            \http_response_code(400);
            $retorno['status'] = 400;
            $retorno['erro'] = "Nosso suporte já esta verificando o erro desculpe!3";
            echo  $this->$controllerRetorno->retornoJson($retorno);
            exit;
        }

        \http_response_code(400);
        $retorno['status'] = 400;
        
        $retorno['erro'] = "Metodo não encontrado4";
        echo  $this->$controllerRetorno->retornoJson($retorno);
        exit;
    }

    public function url ()
    {
        if ( isset( $_GET['url'] ) )
        {

            $path = $_GET['url'];
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL); 

            $path = explode('/', $path);

            $this->controller  = $this->verificaArray( $path, 0 );
            $this->action      = $this->verificaArray( $path, 1 );

            if ( $this->verificaArray( $path, 2 ) )
            {
                unset( $path[0] );
                unset( $path[1] );
                $this->params = array_values( $path );
            }

        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    private function verificaArray ( $array, $key )
    {
        if ( isset( $array[ $key ] ) && !empty( $array[ $key ] ) )
        {
            return $array[ $key ];
        }
        return null;
    }

}