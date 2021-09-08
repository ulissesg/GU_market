<?php 

include_once './config/MySqlConfig.php';

class usuarioDAO{

    public function inserirUsuario($usuario){
        try {
            if($this->selectUsuarioNome($usuario) == new usuarioVO()){

                $conexao = new conexaoBD;
                $conexao = $conexao->conectar();
            
                $query = $conexao->prepare( "INSERT INTO usuario (nome, senha) VALUES (?,?)");
                $query->execute(array($usuario->getNome(), $usuario->getSenha()));

                $conexao = null;

                return True;

            } else{

                throw new Exception("user alredy exist", 1);
                
            }

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function deletarUsuario($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "DELETE FROM usuario WHERE idUsuario = ?");
            $query->execute(array($usuario->getIdUsuario()));

            $conexao = null;

            return true;

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selectUsuarioID($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE idUsuario = ?");
            $query->execute(array($usuario->getIdUsuario()));

            $conexao = null;

            if($query){
                $usuarioBD = new usuarioVO();

                foreach($query as $user){
                    $usuarioBD->setIdUsuario($user['idUsuario']);
                    $usuarioBD->setNome($user['nome']);
                    $usuarioBD->setSenha($user['senha']);
                }

                return $usuarioBD;

            }else {
                return null;
            }            

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selectUsuarioNome($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE nome = ?");
            $query->execute(array($usuario->getNome()));

            $conexao = null;

            if($query){
                $usuarioBD = new usuarioVO();

                foreach($query as $user){
                    $usuarioBD->setIdUsuario($user['idUsuario']);
                    $usuarioBD->setNome($user['nome']);
                    $usuarioBD->setSenha($user['senha']);
                }

                return $usuarioBD;

            }else {
                return null;
            }            

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editarUsuario($usuario){

        //altera nome e senha do usuario
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "UPDATE usuario SET nome = ?, senha = ? WHERE idUsuario = ?");
            $query->execute(array($usuario->getNome(), $usuario->getSenha(), $usuario->getIdUsuario()));

            $conexao = null;

            return True;

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function login ($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE nome = ? and senha = ? ");
            $query->execute(array($usuario->getNome(), $usuario->getSenha()));

            $conexao = null;

            if($query){
                foreach($query as $user){
                    if ($user['nome'] == $usuario->getNome() and $user['senha'] == $usuario->getSenha()){
                        $usuario->setIdUsuario($user['idUsuario']);
                    }
                    
                }

                return $usuario;

            }else {
                return null;
            }            

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

}

?>