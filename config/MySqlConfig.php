<?php

class conexaoBD{

    public function conectar(){

        $endereco = '127.0.0.1';
        $usuario  = 'root';
        $senha    = '';
        $database = 'gu_market';

        // Conexão com o MYSQL.
        return new PDO("mysql:dbname=$database; host=$endereco", $usuario, $senha); 
        
    }
}