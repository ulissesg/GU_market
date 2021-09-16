<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_POST['nome']) 
    and !empty($_POST['senha'])) {

    include_once __DIR__."../../model/DAO/UsuarioDAO.php";

    $usuarioDAO = new UsuarioDAO();
    $usuario = new usuarioVO();
    $usuario->setNome($_POST['nome']);
    $usuario->setSenha(hash('sha256', $_POST['senha']));

    if ($usuarioDAO->inserirUsuario($usuario)){
        header('Location: /gu_market/index.php?message=0');
    }else{
        header('Location: /gu_market/src/view/signin.php?error=1');
    }
}else {
    header('Location: /gu_market/src/view/signin.php?error=0');
}

?>