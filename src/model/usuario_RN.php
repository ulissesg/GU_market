<?php 

include_once './config/mysqlConfig.php';

class usuario_RN{

    public function inserirUsuario($usuario){
        try {

            if($this->selectCpfUsuario($usuario) == new usuario_VO()){

                $conexao = new conexaoBD;
                $conexao = $conexao->conectar();
            
                $query = $conexao->prepare( "INSERT INTO usuario (nome, senha, cpf) VALUES (?,?,?)");
                $query->execute(array($usuario->getNome(), $usuario->getSenha(), $usuario->getCpf()));

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
            echo $e;
        }
    }

    public function selectIdUsuario($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE idUsuario = ?");
            $query->execute(array($usuario->getIdUsuario()));

            $conexao = null;

            if($query){
                $usuarioBD = new usuario_VO();

                foreach($query as $user){
                    $usuarioBD->setIdUsuario($user['idUsuario']);
                    $usuarioBD->setNome($user['nome']);
                    $usuarioBD->setSenha($user['senha']);
                    $usuarioBD->setCpf($user['cpf']);
                }

                return $usuarioBD;

            }else {
                return null;
            }            

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e;
        }
    }

    public function selectCpfUsuario($usuario){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();

            $query = $conexao->prepare( "SELECT * FROM usuario WHERE cpf = ?");
            $query->execute(array($usuario->getCpf()));

            $conexao = null;

            if($query){
                $usuarioBD = new usuario_VO();

                foreach($query as $user){
                    $usuarioBD->setIdUsuario($user['idUsuario']);
                    $usuarioBD->setNome($user['nome']);
                    $usuarioBD->setSenha($user['senha']);
                    $usuarioBD->setCpf($user['cpf']);
                }

                return $usuarioBD;

            }else {
                return null;
            }            

        } catch (PDOException $pdo) {
            echo $pdo->echo;
        } catch (Exception $e){
            echo $e;
        }
    }

}

?>