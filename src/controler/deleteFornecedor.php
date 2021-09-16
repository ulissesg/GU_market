<?php 
if (!isset($_SESSION)){
    session_start();
}
include_once "../../src/model/DAO/FornecedorDAO.php";

$fornecedorDAO = new FornecedorDAO();
$fornecedor = new FornecedorVO();
$fornecedor->setIdFornecedor($_GET['id']);
$fornecedorDAO->deletarFornecedor($fornecedor);

header('Location: /gu_market/src/view/fornecedores.php?message=0');
?>