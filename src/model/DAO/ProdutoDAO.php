<?php 

include_once './src/model/VO/ProdutoVO.php';
include_once './config/MySqlConfig.php';

class ProdutoDAO{

    public function inserirProduto($produto){
        try {
            if($this->selecionarProdutoCodigoBarras($produto) == new ProdutoVO()){

                $conexao = new conexaoBD;
                $conexao = $conexao->conectar();
            
                $query = $conexao->prepare( "INSERT INTO produto (nome, descricao, codigo_barra, 
                                            fabricante, validade, fkFornecedor) VALUES (?,?,?,?,?,?)");
                $query->execute(array($produto->getNome(), $produto->getDescricao(),
                                        $produto->getCodigoBarras(), $produto->getFabricante(),
                                        $produto->getValidade(), $produto->getFkFornecedor()));

                $conexao = null;

                return True;

            } else{

                throw new Exception("produto alredy exist", 1);
                
            }

        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function selecionarProdutoID($produto){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM produto WHERE idProduto = ?");
            $query->execute(array($produto->getIdProduto()));

            $conexao = null;

            if($query){
                $produtoBD = new ProdutoVO();

                foreach($query as $produ){
                    $produtoBD->setIdProduto($produ['idProduto']);
                    $produtoBD->setNome($produ['nome']);
                    $produtoBD->setDescricao($produ['descricao']);
                    $produtoBD->setCodigoBarras($produ['codigo_barra']);
                    $produtoBD->setFabricante($produ['fabricante']);
                    $produtoBD->setValidade($produ['validade']);
                    $produtoBD->setFkFornecedor($produ['fkFornecedor']);
                }

                return $produtoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selecionarProdutoCodigoBarras($produto){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM produto WHERE codigo_barra = ?");
            $query->execute(array($produto->getCodigoBarras()));

            $conexao = null;

            if($query){
                $produtoBD = new ProdutoVO();

                foreach($query as $produ){
                    $produtoBD->setIdProduto($produ['idProduto']);
                    $produtoBD->setNome($produ['nome']);
                    $produtoBD->setDescricao($produ['descricao']);
                    $produtoBD->setCodigoBarras($produ['codigo_barra']);
                    $produtoBD->setFabricante($produ['fabricante']);
                    $produtoBD->setValidade($produ['validade']);
                    $produtoBD->setFkFornecedor($produ['fkFornecedor']);
                }

                return $produtoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function selecionarTodos(){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare( "SELECT * FROM produto");
            $query->execute();

            $conexao = null;

            if($query){
                $produtoBD = [];
                foreach($query as $i=>$produ){
                    $produtoBD[$i] = new ProdutoVO;
                    $produtoBD[$i]->setIdProduto($produ['idProduto']);
                    $produtoBD[$i]->setNome($produ['nome']);
                    $produtoBD[$i]->setDescricao($produ['descricao']);
                    $produtoBD[$i]->setCodigoBarras($produ['codigo_barra']);
                    $produtoBD[$i]->setFabricante($produ['fabricante']);
                    $produtoBD[$i]->setValidade($produ['validade']);
                    $produtoBD[$i]->setFkFornecedor($produ['fkFornecedor']);
                }

                return $produtoBD;

            }else {
                return null;
            }            


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function editarProduto($produto){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("UPDATE produto SET nome = ?, descricao = ?, codigo_barra = ?, 
                                        fabricante = ?, validade = ?, fkFornecedor = ? 
                                        WHERE idProduto = ?");

            $query->execute(array($produto->getNome(), $produto->getDescricao(),
                                    $produto->getCodigoBarras(), $produto->getFabricante(),
                                    $produto->getValidade(), $produto->getFkFornecedor(),
                                    $produto->getIdProduto()));

            $conexao = null;

            return true;


        } catch (PDOException $pdo) {
            echo $pdo->getMessage();
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function deletarProduto($produto){
        try {
            $conexao = new conexaoBD;
            $conexao = $conexao->conectar();
        
            $query = $conexao->prepare("DELETE FROM produto WHERE idProduto = ?");
            $query->execute(array($produto->getIdProduto()));

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