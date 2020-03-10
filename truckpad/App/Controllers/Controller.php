<?php

namespace App\Controllers;

class Controller {


        public function retornoJson($dados)
        {
            return json_encode($this->array_map_deep($dados, 'utf8_encode'));
        }


        public function retornaError()
        {
            $retorno['status'] ="false";
            $retorno['msg'] = "Erro por favor entrar em contato";
            return json_encode($this->array_map_deep($retorno, 'utf8_encode'));
        }


    function array_map_deep($array, $callback)
    {
        $new = array();
        foreach($array as $key => $val)
        {
            if (is_array($val))
            {
                $new[$key] = $this->array_map_deep($val, $callback);

            } else {
                $new[$key] = call_user_func($callback, $val);
            }
      }

        return $new;
  }

  function serialize()
   {
     return json_encode(get_object_vars ($this));
   }  

}