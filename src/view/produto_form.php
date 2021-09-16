<?php 
include_once "cabecalho_model.php"; 
if(isset($_SESSION)){
    if (array_key_exists('id', $_SESSION)){
        if (isset($_GET['id'])){
            include_once "produtoEditar.php";
        }else{
            include_once "produtoInserir.php";
        }
    }
}
include_once "rodape.php" ;
?>