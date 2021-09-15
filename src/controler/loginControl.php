<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_POST['nome']) 
    and !empty($_POST['senha'])) {

    include_once __DIR__."../../model/DAO/UsuarioDAO.php";

    $usuarioDAO = new UsuarioDAO();
    $usuario = new usuarioVO();
    $usuario->setNome($_POST['nome']);
    $usuario->setSenha(hash('sha256', $_POST['senha']));

    $usuario = $usuarioDAO->login($usuario);

    if($usuario->getIdUsuario()){
        if (!isset($_SESSION)) {
            session_start();
            $_SESSION['id'] = $usuario->getIdUsuario();
            $_SESSION['nome'] = $usuario->getNome(); 
            header('Location: /gu_market/src/view/produtos.php');
        } 
    }else{
        header('Location: /gu_market/index.php?error=0');
    }     
}else{
    header('Location: /gu_market/index.php?error=1');
}
?>