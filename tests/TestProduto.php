<?php

include_once "./src/model/DAO/ProdutoDAO.php";
include_once "./src/model/DAO/FornecedorDAO.php";

class TestProdutoDAO{

    public function test_funcoes_produto(){
        // Testa as querys do produto

        try {
            $ok = false;
            $produto = [];
            $ProdutoDAO = new ProdutoDAO();
            $fornecedorDAO = new FornecedorDAO(); 
            $fornecedor = new FornecedorVO();
            $fornecedor->setNome('Test Produto');
            $fornecedor->setCnpj('252482156256225');
            $fornecedorDAO->inserirFornecedor($fornecedor);
            $fornecedor = $fornecedorDAO->selecionarFornecedorCnpj($fornecedor);

            $this->testa_inserir($produto, $fornecedor, $ProdutoDAO, $ok);

            $this->testa_editar($produto, $ProdutoDAO, $ok);  
            
            $this->testa_seleciona_todos($produto,$fornecedor, $ProdutoDAO, $ok);
            
            $this->testa_deletar($produto, $ProdutoDAO, $ok);  

            $fornecedorDAO->deletarFornecedor($fornecedor);

            if ($ok){
                echo 'Teste produto DAO OK';

            } else {
                echo 'Teste produto DAO falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function testa_inserir(&$produto, $fornecedor, $ProdutoDAO, &$ok){

        $produto[0] = new ProdutoVO();
        $produto[0]->setNome('test-001');
        $produto[0]->setDescricao('descricao teste');
        $produto[0]->setCodigoBarras('548963279651962');
        $produto[0]->setFabricante('fabricante teste');
        $produto[0]->setValidade('2021-12-25');
        $produto[0]->setFkFornecedor($fornecedor->getIdFornecedor());
        
        $ProdutoDAO->inserirProduto($produto[0]);

        $produtoBD = $ProdutoDAO->selecionarProdutoCodigoBarras($produto[0]);

        if ($produtoBD) {

            if ($produto[0]->getNome() == $produtoBD->getNome() and
                $produto[0]->getDescricao() == $produtoBD->getDescricao() and
                $produto[0]->getCodigoBarras() == $produtoBD->getCodigoBarras() and
                $produto[0]->getFabricante() == $produtoBD->getFabricante() and
                $produto[0]->getValidade() == $produtoBD->getValidade() and
                $produto[0]->getFkFornecedor() == $produtoBD->getFkFornecedor()){

                $ok = true;
                $produto[0]->setIdProduto($produtoBD->getIdProduto());

            }

        }else {
            $ok = false;
        }
    }

    private function testa_editar(&$produto, $ProdutoDAO, &$ok){

        $produto[0]->setNome('Teste editar produto');

        $ProdutoDAO->editarProduto($produto[0]);

        $produtoBD = $ProdutoDAO->selecionarProdutoCodigoBarras($produto[0]);

        if ($produtoBD) {

            if ($produto[0]->getNome() == $produtoBD->getNome() and
                $produto[0]->getDescricao() == $produtoBD->getDescricao() and
                $produto[0]->getCodigoBarras() == $produtoBD->getCodigoBarras() and
                $produto[0]->getFabricante() == $produtoBD->getFabricante() and
                $produto[0]->getValidade() == $produtoBD->getValidade() and
                $produto[0]->getFkFornecedor() == $produtoBD->getFkFornecedor() and 
                $produtoBD->getNome() <> 'test-001'){

                $ok = true;
                $produto[0]->setIdProduto($produtoBD->getIdProduto());

            }

        }else {
            $ok = false;
        }
    }

    private function testa_seleciona_todos(&$produto, $fornecedor, $ProdutoDAO, &$ok){

        $produto[1] = new ProdutoVO();
        $produto[1]->setNome('test-002');
        $produto[1]->setDescricao('descricao teste 2');
        $produto[1]->setCodigoBarras('5489632793247');
        $produto[1]->setFabricante('fabricante teste 2');
        $produto[1]->setValidade('2021-11-21');
        $produto[1]->setFkFornecedor($fornecedor->getIdFornecedor());

        $produto[2] = new ProdutoVO();
        $produto[2]->setNome('test-003');
        $produto[2]->setDescricao('descricao teste 3');
        $produto[2]->setCodigoBarras('548963279986312');
        $produto[2]->setFabricante('fabricante teste 3');
        $produto[2]->setValidade('2021-10-10');
        $produto[2]->setFkFornecedor($fornecedor->getIdFornecedor());

        $ProdutoDAO->inserirProduto($produto[1]);
        $ProdutoDAO->inserirProduto($produto[2]);

        $produtoBD = $ProdutoDAO->selecionarTodos();

        if ($produtoBD) {

            foreach($produtoBD as $i=>$produtoB){
                if ($produto[$i] == $produtoB){

                    $ok = true;
                    $produto[$i]->setIdProduto($produtoB->getIdProduto());

                }else {
                    $ok = false;
                }
            }
            

        }
    }

    private function testa_deletar(&$produto, $ProdutoDAO, &$ok){
        $ProdutoDAO->deletarProduto($produto[0]);
        $ProdutoDAO->deletarProduto($produto[1]);
        $ProdutoDAO->deletarProduto($produto[2]);

        if ($ProdutoDAO->selecionarProdutoID($produto[0]) == new ProdutoVO() and
            $ProdutoDAO->selecionarProdutoID($produto[1]) == new ProdutoVO() and
            $ProdutoDAO->selecionarProdutoID($produto[2]) == new ProdutoVO()){

            $ok = true;
        }
    }

    

}

$user = new TestProdutoDAO();
$user->test_funcoes_produto();

?>