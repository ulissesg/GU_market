<?php

include_once './src/model/usuario_VO.php';
include_once './src/model/usuario_RN.php';

class TestUsuarioRN{

    public function test_funcoes_usuario(){
        // Testa se a insercao do usuario e efetuada e depois exclui o mesmo do BD 
        // e realiza uma nova query para averiguar se o usuario foi de fato excluido

        try {
            $ok = false;
            $usuario = new usuario_VO();
            $usuario_RN = new usuario_RN();
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $usuario->setNome('test-001');
            $usuario->setSenha('12*56L85');

            //testa inserir usuario
            $usuario_RN->inserirUsuario($usuario);

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE  nome = ?");
            $query->execute(array($usuario->getNome()));

            $conexao = null;

            if ($query) {
                // Percorre os resultados para iteração.
                foreach ($query as $usuarioBD) {
                    if ($usuarioBD['nome'] == $usuario->getNome() and 
                    $usuarioBD['senha'] == $usuario->getSenha()){
                        $ok = true;
                    }
                    $usuario->setIdUsuario($usuarioBD['idUsuario']);
                    // testa deletar usuario
                    $usuario_RN->deletarUsuario($usuario);
                }
            }

            //testa selecionar usuario
            if (is_null($usuario_RN->selectIdUsuario($usuario))){
                $ok = true;
            } 

            $conexao = null;

            if ($ok){
                echo 'Teste OK';
            }

        } catch (Exception $e) {
            echo 'Test failed';
        }
    }

}

?>