<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_POST['nome']) 
    and !empty($_POST['codigo_barras'])) {

    include_once __DIR__."../../model/DAO/ProdutoDAO.php";

    $produtoDAO = new ProdutoDAO();
    $produto = new ProdutoVO();
    $produto->setIdProduto($_GET['id']);
    $produto->setNome($_POST['nome']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setCodigoBarras($_POST['codigo_barras']);
    $produto->setFabricante($_POST['fabricante']);
    if (!empty($_POST['validade'])){$produto->setValidade(date("Y-m-d", strtotime($_POST['validade'])));}
    $produto->setFkFornecedor($_POST['fornecedor']);
    

    if($produtoDAO->editarProduto($produto)){
        header('Location: /gu_market/src/view/produtos.php?message=3');
    }else{
        header('Location: /gu_market/src/view/produto_form.php?error=2');
    }     
}else{
    header('Location: /gu_market/src/view/produto_form.php?error=1');
}
?>