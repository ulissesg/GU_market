<?php 

include_once __DIR__.'../../VO/CarrinhoVO.php';
include_once __DIR__.'/UsuarioDAO.php';
include_once __DIR__.'../../../../config/MySqlConfig.php';

class CarrinhoDAO{

    public function inserirCarrinho($carrinho){
        try {
            if($this->selecionarCarrinhoUsuarioProduto($carrinho) == new CarrinhoVO()){

                $conexao = new conexaoBD;
                $conexao = $conexao->conectar();
            
                $query = $conexao->prepare( "INSERT INTO carrinho (fkUsuario, fkProduto) VALUES (?,?)");
                $query->execute(array($carrinho->getUsuario(), $carrinho->getProduto()));

                $conexao = null;

                return True;

            } else{

                throw new Exception("carrinho alredy exist", 1);
                
            }

        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function selecionarCarrinhoID($carrinho){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM carrinho WHERE idCarrinho = ?");
            $query->execute(array($carrinho->getIdCarrinho()));

            $conexao = null;

            if($query){
                $carrinhoBD = new CarrinhoVO();

                foreach($query as $car){
                    $carrinhoBD->setIdCarrinho($car['idCarrinho']);
                    $carrinhoBD->setUsuario($car['fkUsuario']);
                    $carrinhoBD->setProduto($car['fkProduto']);
                }

                return $carrinhoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selecionarCarrinhoUsuarioProduto($carrinho){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM carrinho WHERE fkUsuario = ? and fkProduto = ?");
            $query->execute(array($carrinho->getUsuario(), $carrinho->getProduto()));

            $conexao = null;

            if($query){
                $carrinhoBD = new CarrinhoVO();

                foreach($query as $car){
                    $carrinhoBD->setIdCarrinho($car['idCarrinho']);
                    $carrinhoBD->setUsuario($car['fkUsuario']);
                    $carrinhoBD->setProduto($car['fkProduto']);
                }

                return $carrinhoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function buscarCarrinhoUsuario($usuario){
        
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
            $usuarioDAO = new UsuarioDAO();

            $query = $conexao->prepare( "SELECT * FROM carrinho WHERE fkUsuario = ?");
            $query->execute(array($usuario));

            $conexao = null;

            if($query){
                $carrinhoBD = [];

                foreach($query as $i=>$car){
                    $carrinhoBD[$i] = new CarrinhoVO;
                    $carrinhoBD[$i]->setIdCarrinho($car['idCarrinho']);
                    $carrinhoBD[$i]->setUsuario($car['fkUsuario']);
                    $carrinhoBD[$i]->setProduto($car['fkProduto']);
                }

                return $carrinhoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function editarCarrinho($carrinho){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("UPDATE carrinho SET fkUsuario = ?, fkProduto = ? WHERE 
                                        idCarrinho = ?");
            $query->execute(array($carrinho->getUsuario(), $carrinho->getProduto(),
                                    $carrinho->getIdCarrinho()));

            $conexao = null;

            return true;


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function deletarCarrinho($carrinho){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("DELETE FROM carrinho WHERE idCarrinho = ?");
            $query->execute(array($carrinho->getIdCarrinho()));

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