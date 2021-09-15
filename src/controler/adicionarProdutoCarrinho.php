<?php
if (!isset($_SESSION)){
    session_start();
}

include_once '../../src/model/DAO/CarrinhoDAO.php';

$carrinhoDAO = new CarrinhoDAO();
$carrinho = new CarrinhoVO();

$carrinho->setUsuario($_SESSION['id']);
$carrinho->setProduto($_GET['id']);

$carrinhoDAO->inserirCarrinho($carrinho);

header('Location: /gu_market/src/view/produtos.php?message=1');

?>