<?php 
include_once "../../src/model/DAO/CarrinhoDAO.php";

$carrinhoDAO = new CarrinhoDAO();
$carrinho = new CarrinhoVO();
$carrinho->setIdCarrinho($_GET['id']);
$carrinhoDAO->deletarCarrinho($carrinho);

header('Location: /gu_market/src/view/carrinho.php?message=0');
?>