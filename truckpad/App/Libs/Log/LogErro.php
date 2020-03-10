<?php

namespace App\Libs\Log;

class LogErro{

   public $pathLog = PATH_LOG;

   public function logMsg( $msg, $level = 'info')
    {
        // vari�vel que vai armazenar o n�vel do log (INFO, WARNING ou ERROR)
        $levelStr = '';
        // verifica o n�vel do log
        switch ( $level )
        {
            case 'info':
                // n�vel de informa��o
                $levelStr = 'INFO';
                break;
     
            case 'warning':
                // n�vel de aviso
                $levelStr = 'WARNING';
                break;
     
            case 'error':
                // n�vel de erro
                $levelStr = 'ERROR';
                break;
        }
     
        // data atual
        $date = date( 'Y-m-d H:i:s' );
     
        // formata a mensagem do log
        // 1o: data atual
        // 2o: n�vel da mensagem (INFO, WARNING ou ERROR)
        // 3o: a mensagem propriamente dita
        // 4o: uma quebra de linha
        $msg = sprintf( "[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL );
     
        // escreve o log no arquivo
        // � necess�rio usar FILE_APPEND para que a mensagem seja escrita no final do arquivo, preservando o conte�do antigo do arquivo
        file_put_contents( $this->$pathLog, $msg, FILE_APPEND );
    }







}