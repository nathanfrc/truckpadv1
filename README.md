# truckpadv1

1-º ter composer instalado
  - "composer install" para instalar todas depedencias.
  
  
  2-° truckpad\App\App.php - arquivo aonde encontra as configurações de banco de dados e outras coisas.
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
        
    3-° crie o banco de dados e coloque o nome de truckpad
      chamar o end-point 
     -http://localhost/truckpad/builder - Cria banco de dados e adiciona alguns registros
     
     --lista Caminhoneiros
     Método GET
     http://localhost/truckpad/caminhoes/listar/10 - lista por 10
     htpp://localhost/truckpad/caminhoes/listar - lista todos
     
     --lista tipos Caminhoes
     Método GET
     http://localhost/truckpad/caminhoneiro/listar/1 - lista por id
     htpp://localhost/truckpad/caminhoneiro/listar - lista todos
     
     Método POST
     http://localhost/truckpad/caminhoneiro/create - Cria um motorista
     
     Corpo da requisição
     {
      "nome":"Nathan",
      "data_nascimento": "1993-09-04",
        "sexo" :"M",
        "possui_veiculo": "Y",
        "tipo_cnh":"A",
         "cnh": 12345544, 
        "lat_origem":-23.5713566,
        "long_origem":-46.5504646,
        "tipo_veiculo": 4
    }
    
    Método PUT 
    
    localhost/truckpad/caminhoneiro/update/1 - id do motorista
    {
      "nome":"Nathan Costa 3",
      "data_nascimento": "1993-09-04",
        "sexo" :"M",
        "possui_veiculo": "Y",
        "tipo_cnh":"E",
         "cnh": 82877613672906, 
        "lat_origem":-23.5713566,
        "long_origem":-46.5504646,
        "tipo_veiculo": 1
   }
   
   METODO POST
   localhost/truckpad/destinos/create - cria o destino do motorista
   
   Métetodo GET
   relatorio
   localhost/truckpad/caminhoneiro/relatorios?data_incio=2020-03-08
   
   parametro data_inicio até momento;
   
   caso tenha alguma duvida suba o arquivo truckpad.postman_collection.json no postman 
   e teste os metodos.
     
     
     
     
     
     
