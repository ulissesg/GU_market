<?php

include_once "./src/model/DAO/CarrinhoDAO.php";

class TestCarrinhoDAO{

    public function test_funcoes_carrinho(){
        // Testa as querys do carrinho

        try {
            $ok = false;
            $carrinho = new CarrinhoVO();
            $CarrinhoDAO = new CarrinhoDAO();

            $this->testa_inserir($carrinho, $CarrinhoDAO, $ok);

            // $this->testa_editar($carrinho, $CarrinhoDAO, $ok);   
            
            // $this->testa_deletar($carrinho, $CarrinhoDAO, $ok);  

            if ($ok){
                echo 'Teste Carrinho DAO OK';

            } else {
                echo 'Teste falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function testa_inserir($carrinho, $CarrinhoDAO, &$ok){

        $carrinho->setNome('test-001');
        $carrinho->setSenha('12*56L85');

        $CarrinhoDAO->inserircarrinho($carrinho);

        $carrinhoBD = $CarrinhoDAO->selectcarrinhoNome($carrinho);

        if ($carrinhoBD) {

            if ($carrinhoBD->getNome() == $carrinho->getNome() and 
                $carrinhoBD->getSenha() == $carrinho->getSenha()){

                $ok = true;
                $carrinho->setIdcarrinho($carrinhoBD->getIdcarrinho());

            }

        }else {
            $ok = false;
        }
    }

    private function testa_editar($carrinho, $CarrinhoDAO, &$ok){

        $carrinho->setSenha('18*65j9');

        $CarrinhoDAO->editarcarrinho($carrinho);

        $carrinhoBD = $CarrinhoDAO->selectcarrinhoNome($carrinho);

        if ($carrinhoBD) {

            if ($carrinhoBD->getNome() == $carrinho->getNome() and 
                $carrinhoBD->getSenha() == $carrinho->getSenha() and 
                $carrinhoBD->getSenha() <> '12*56L85'){

                $ok = true;
                $carrinho->setIdcarrinho($carrinhoBD->getIdcarrinho());

            }

        }else {
            $ok = false;
        }
    }

    private function testa_deletar($carrinho, $CarrinhoDAO, &$ok){
        $CarrinhoDAO->deletarcarrinho($carrinho);

        if ($CarrinhoDAO->selectcarrinhoID($carrinho) == new CarrinhoVO()){
            $ok = true;
        }
    }

    

}

$user = new TestCarrinhoDAO();
$user->test_funcoes_carrinho();

?>