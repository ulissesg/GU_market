<?php

include_once "./src/model/DAO/ProdutoDAO.php";
include_once "./src/model/DAO/FornecedorDAO.php";
include_once "./src/model/DAO/UsuarioDAO.php";
include_once "./src/model/DAO/CarrinhoDAO.php";

class TestCarrinhoDAO{

    public function test_funcoes_carrinho(){
        // Testa as querys do carrinho

        try {
            $ok = false;
            $carrinho = [];
            $CarrinhoDAO = new CarrinhoDAO();
            $fornecedorDAO = new FornecedorDAO(); 
            $fornecedor = new FornecedorVO();
            $usuario = new UsuarioVO();
            $usuarioDAO = new usuarioDAO();
            $produto = new ProdutoVO();
            $produto2 = new ProdutoVO();
            $produto3 = new ProdutoVO();
            $produtoDAO = new ProdutoDAO();

            $this->setup($fornecedor, $fornecedorDAO, $produto, $produto2, $produto3, $produtoDAO,
                            $usuario, $usuarioDAO);

            $this->testa_inserir($carrinho, $usuario, $produto, $CarrinhoDAO, $ok);

            $this->testa_editar($carrinho, $produto2, $produto, $CarrinhoDAO, $ok);  
            
            $this->testa_seleciona_todos($carrinho, $usuario, $produto, $produto3, $usuarioDAO, $CarrinhoDAO, $ok);
            
            $this->testa_deletar($carrinho, $CarrinhoDAO, $ok);  

            $fornecedorDAO->deletarFornecedor($fornecedor);

            $usuarioDAO -> deletarUsuario($usuario);

            if ($ok){
                echo 'Teste carrinho DAO OK';

            } else {
                echo 'Teste carrinho DAO falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function setup(&$fornecedor, &$fornecedorDAO, &$produto, &$produto2, &$produto3,
                            &$produtoDAO, &$usuario, &$usuarioDAO){
        $fornecedor->setNome('Test Carrinho');
        $fornecedor->setCnpj('252482156256225');
        $fornecedorDAO->inserirFornecedor($fornecedor);
        $fornecedor = $fornecedorDAO->selecionarFornecedorCnpj($fornecedor);

        $produto->setNome('test-001');
        $produto->setDescricao('descricao teste');
        $produto->setCodigoBarras('548963279651962');
        $produto->setFabricante('fabricante teste');
        $produto->setValidade('2021-12-25');
        $produto->setFkFornecedor($fornecedor->getIdFornecedor());
        $produtoDAO->inserirProduto($produto);
        $produto = $produtoDAO->selecionarProdutoCodigoBarras($produto);

        $produto2->setNome('test-002');
        $produto2->setDescricao('descricao teste 2');
        $produto2->setCodigoBarras('54896327996868');
        $produto2->setFabricante('fabricante teste 2');
        $produto2->setValidade('2021-12-24');
        $produto2->setFkFornecedor($fornecedor->getIdFornecedor());
        $produtoDAO->inserirProduto($produto2);
        $produto2 = $produtoDAO->selecionarProdutoCodigoBarras($produto2);
    
        $produto3->setNome('test-002');
        $produto3->setDescricao('descricao teste 2');
        $produto3->setCodigoBarras('5489632356658456');
        $produto3->setFabricante('fabricante teste 2');
        $produto3->setValidade('2021-12-24');
        $produto3->setFkFornecedor($fornecedor->getIdFornecedor());
        $produtoDAO->inserirProduto($produto3);
        $produto3 = $produtoDAO->selecionarProdutoCodigoBarras($produto3);

        $usuario->setNome('test-001');
        $usuario->setSenha('12*56L85');
        $usuarioDAO->inserirUsuario($usuario);
        $usuario = $usuarioDAO->selectUsuarioNome($usuario);
    }

    private function testa_inserir(&$carrinho, $usuario, $produto, $CarrinhoDAO, &$ok){

        $carrinho[0] = new CarrinhoVO();
        $carrinho[0]->setUsuario($usuario->getIdUsuario());
        $carrinho[0]->setProduto($produto->getIdProduto());
        
        $CarrinhoDAO->inserirCarrinho($carrinho[0]);

        $carrinhoBD = $CarrinhoDAO->selecionarCarrinhoUsuarioProduto($carrinho[0]);

        if ($carrinhoBD) {
            if ($carrinho[0]->getUsuario() == $carrinhoBD->getUsuario() and
                $carrinho[0]->getProduto() == $carrinhoBD->getProduto()){

                $ok = true;
                $carrinho[0]->setIdCarrinho($carrinhoBD->getIdCarrinho());

            }

        }else {
            throw new Exception("Nao foi possivel inserir o Carrinho", 1);
        }
    }

    private function testa_editar(&$carrinho, $produto2, $produto, $CarrinhoDAO, &$ok){

        $idProduto2 = $produto2->getIdProduto();
        $carrinho[0]->setProduto($idProduto2);

        $CarrinhoDAO->editarCarrinho($carrinho[0]);

        $carrinhoBD = $CarrinhoDAO->selecionarCarrinhoUsuarioProduto($carrinho[0]);

        if ($carrinhoBD) {
            if ($carrinho[0]->getUsuario() == $carrinhoBD->getUsuario() and
                $carrinho[0]->getProduto() == $carrinhoBD->getProduto() and 
                $carrinhoBD->getProduto() <> $produto->getIdProduto()){
                $ok = true;
                $carrinho[0]->setIdCarrinho($carrinhoBD->getIdCarrinho());

            }

        }else {
            $ok = false;
        }
    }

    private function testa_seleciona_todos(&$carrinho, $usuario, $produto, $produto3, $usuarioDAO, $CarrinhoDAO, &$ok){

        $carrinho[1] = new CarrinhoVO();
        $carrinho[1]->setUsuario($usuario->getIdUsuario());
        $carrinho[1]->setProduto($produto->getIdProduto());

        $carrinho[2] = new CarrinhoVO();
        $carrinho[2]->setUsuario($usuario->getIdUsuario());
        $carrinho[2]->setProduto($produto3->getIdProduto());

        $CarrinhoDAO->inserirCarrinho($carrinho[1]);
        $CarrinhoDAO->inserirCarrinho($carrinho[2]);

        $carrinhoBD = $CarrinhoDAO->buscarCarrinhoUsuario($usuario->getIdUsuario());

        if ($carrinhoBD) {
            
        
            foreach($carrinhoBD as $i=>$carrinhoB){
                if ($carrinho[$i]->getUsuario() == $carrinhoB->getUsuario() and
                    $carrinho[$i]->getProduto() == $carrinhoB->getProduto()){

                    $ok = true;
                    $carrinho[$i]->setIdCarrinho($carrinhoB->getIdCarrinho());

                }else {
                    $ok = false;
                }
            }
            

        }
    }

    private function testa_deletar(&$carrinho, $CarrinhoDAO, &$ok){
        $CarrinhoDAO->deletarCarrinho($carrinho[0]);
        // $CarrinhoDAO->deletarCarrinho($carrinho[1]);
        // $CarrinhoDAO->deletarCarrinho($carrinho[2]);

        if ($CarrinhoDAO->selecionarCarrinhoID($carrinho[0]) == new CarrinhoVO() ){

            $ok = true;
        }
    }

    

}

$user = new TestCarrinhoDAO();
$user->test_funcoes_carrinho();

?>