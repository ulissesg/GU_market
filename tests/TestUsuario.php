<?php

include_once __DIR__."../../src/model/DAO/UsuarioDAO.php";

class TestUsuarioDAO{

    public function test_funcoes_usuario(){
        // Testa as querys do usuario

        try {
            $ok = false;
            $usuario = new usuarioVO();
            $usuarioDAO = new usuarioDAO();

            $this->testa_inserir($usuario, $usuarioDAO, $ok);

            $this->testa_editar($usuario, $usuarioDAO, $ok);   

            $this->testar_login($usuario, $usuarioDAO, $ok);
            
            $this->testa_deletar($usuario, $usuarioDAO, $ok);  

            if ($ok){
                echo 'Teste Usuario DAO OK';

            } else {
                echo 'Teste Usuario DAO falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function testa_inserir($usuario, $usuarioDAO, &$ok){

        $usuario->setNome('test-001');
        $usuario->setSenha('12*56L85');

        $usuarioDAO->inserirUsuario($usuario);

        $usuarioBD = $usuarioDAO->selectUsuarioNome($usuario);

        if ($usuarioBD) {

            if ($usuarioBD->getNome() == $usuario->getNome() and 
                $usuarioBD->getSenha() == $usuario->getSenha()){

                $ok = true;
                $usuario->setIdUsuario($usuarioBD->getIdUsuario());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_editar($usuario, $usuarioDAO, &$ok){

        $usuario->setSenha('18*65j9');

        $usuarioDAO->editarUsuario($usuario);

        $usuarioBD = $usuarioDAO->selectUsuarioNome($usuario);

        if ($usuarioBD) {

            if ($usuarioBD->getNome() == $usuario->getNome() and 
                $usuarioBD->getSenha() == $usuario->getSenha() and 
                $usuarioBD->getSenha() <> '12*56L85'){

                $ok = true;
                $usuario->setIdUsuario($usuarioBD->getIdUsuario());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testar_login($usuario, $usuarioDAO, &$ok){
        
        $usuarioBD = $usuarioDAO->login($usuario);
        
        if ($usuarioBD){
            if ($usuario == $usuarioBD){
                $ok = true;
            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
        
    }

    private function testa_deletar($usuario, $usuarioDAO, &$ok){
    
        if ($usuarioDAO->deletarUsuario($usuario)){

            if ($usuarioDAO->selectUsuarioID($usuario) == new usuarioVO()){
                $ok = true;
            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }
}

$user = new TestUsuarioDAO();
$user->test_funcoes_usuario();

?>