<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_POST['nome']) 
    and !empty($_POST['cnpj'])) {

    include_once __DIR__."../../model/DAO/FornecedorDAO.php";

    $fornecedorDAO = new FornecedorDAO();
    $fornecedor = new FornecedorVO();
    $fornecedor->setNome($_POST['nome']);
    $fornecedor->setCnpj($_POST['cnpj']);
    

    if($fornecedorDAO->inserirFornecedor($fornecedor)){
        header('Location: /gu_market/src/view/fornecedores.php?message=2');
    }else{
        header('Location: /gu_market/src/view/fornecedor_form.php?error=2');
    }     
}else{
    header('Location: /gu_market/src/view/fornecedor_form.php?error=0');
}
?>