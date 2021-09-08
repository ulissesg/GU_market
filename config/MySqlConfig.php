<?php

class conexaoBD{

    public function conectar(){

        $endereco = 'localhost';
        $usuario  = 'root';
        $senha    = '';
        $database = 'gu_market';

        // Conexão com o MYSQL.
        return new PDO("mysql:dbname=$database; host=$endereco", $usuario, $senha); 
        
    }
}