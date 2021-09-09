<?php 

include_once './src/model/VO/FornecedorVO.php';
include_once './config/MySqlConfig.php';

class FornecedorDAO{

    public function inserirFornecedor($fornecedor){
        try {
            if($this->selecionarFornecedorCnpj($fornecedor) == new FornecedorVO()){

                $conexao = new conexaoBD;
                $conexao = $conexao->conectar();
            
                $query = $conexao->prepare( "INSERT INTO fornecedor (nome, cnpj) VALUES (?,?)");
                $query->execute(array($fornecedor->getNome(), $fornecedor->getCnpj()));

                $conexao = null;

                return True;

            } else{

                throw new Exception("fornecedor alredy exist", 1);
                
            }

        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function selecionarFornecedorID($fornecedor){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM fornecedor WHERE idFornecedor = ?");
            $query->execute(array($fornecedor->getIdFornecedor()));

            $conexao = null;

            if($query){
                $fornecedorBD = new FornecedorVO();

                foreach($query as $forne){
                    $fornecedorBD->setIdFornecedor($forne['idFornecedor']);
                    $fornecedorBD->setNome($forne['nome']);
                    $fornecedorBD->setCnpj($forne['cnpj']);
                }

                return $fornecedorBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selecionarFornecedorCnpj($fornecedor){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM fornecedor WHERE cnpj = ?");
            $query->execute(array($fornecedor->getCnpj()));

            $conexao = null;

            if($query){
                $fornecedorBD = new FornecedorVO();

                foreach($query as $forne){
                    $fornecedorBD->setIdFornecedor($forne['idFornecedor']);
                    $fornecedorBD->setNome($forne['nome']);
                    $fornecedorBD->setCnpj($forne['cnpj']);
                }

                return $fornecedorBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editarFornecedor($fornecedor){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("UPDATE fornecedor SET nome = ?, cnpj = ? WHERE idFornecedor = ?");
            $query->execute(array($fornecedor->getNome(), $fornecedor->getCnpj(),
                                    $fornecedor->getIdFornecedor()));

            $conexao = null;

            return true;


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function deletarFornecedor($fornecedor){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("DELETE FROM fornecedor WHERE idFornecedor = ?");
            $query->execute(array($fornecedor->getIdFornecedor()));

            $conexao = null;

            return true;


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>