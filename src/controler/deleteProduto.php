<?php 
include_once "../../src/model/DAO/ProdutoDAO.php";

$produtoDAO = new ProdutoDAO();
$produto = new ProdutoVO();
$produto->setIdProduto($_GET['id']);
$produtoDAO->deletarProduto($produto);

header('Location: /gu_market/src/view/produtos.php?message=0');
?>
