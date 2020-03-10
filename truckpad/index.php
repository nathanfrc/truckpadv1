<?php

//require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

require_once __DIR__.'/vendor/autoload.php';

  $request = new \App\Controllers\Requests\Request();

try{

    $app = new \App\App();
    $app->run();

}catch(\Exception $e)
{

         http_response_code(403); 

        $retorno['status'] = "false";
        $retorno['erro'] = 'Erro 403 - Voce nao tem acesso para acessar essa Area ';
        $retorno['e'] =$e->getMessage();

        echo json_encode($retorno);
}
 
