<?php 
include_once "cabecalho_model.php" ;
if(isset($_SESSION)){
    if (array_key_exists('id', $_SESSION)){
        if(isset($_GET['id'])){
            include_once "fornecedorEditar.php";
        }else{
            include_once "fornecedorInserir.php";
        }
    }
}
include_once "rodape.php";
 ?>