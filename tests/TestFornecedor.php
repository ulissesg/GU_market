<?php

include_once "./src/model/DAO/FornecedorDAO.php";

class TestFornecedorDAO{

    public function test_funcoes_fornecedor(){
        // Testa as querys do fornecedor

        try {
            $ok = false;
            $fornecedor = new FornecedorVO;
            $FornecedorDAO = new FornecedorDAO();

            $this->testa_inserir($fornecedor, $FornecedorDAO, $ok);

            $this->testa_editar($fornecedor, $FornecedorDAO, $ok);   
            
            $this->testa_deletar($fornecedor, $FornecedorDAO, $ok);  

            if ($ok){
                echo 'Teste fornecedor DAO OK';

            } else {
                echo 'Teste fornecedor DAO falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function testa_inserir($fornecedor, $FornecedorDAO, &$ok){

        $fornecedor->setNome('test-001');
        $fornecedor->setCnpj('12*56L85');

        $FornecedorDAO->inserirFornecedor($fornecedor);

        $fornecedorBD = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor);

        if ($fornecedorBD) {

            if ($fornecedorBD->getNome() == $fornecedor->getNome() and 
                $fornecedorBD->getCnpj() == $fornecedor->getCnpj()){

                $ok = true;
                $fornecedor->setIdFornecedor($fornecedorBD->getIdFornecedor());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_editar($fornecedor, $FornecedorDAO, &$ok){

        $fornecedor->setCnpj('18*65j9');

        $FornecedorDAO->editarFornecedor($fornecedor);

        $fornecedorBD = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor);

        if ($fornecedorBD) {

            if ($fornecedorBD->getNome() == $fornecedor->getNome() and 
                $fornecedorBD->getCnpj() == $fornecedor->getCnpj() and 
                $fornecedorBD->getCnpj() <> '12*56L85'){

                $ok = true;
                $fornecedor->setIdFornecedor($fornecedorBD->getIdFornecedor());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_deletar($fornecedor, $FornecedorDAO, &$ok){
        
        if ($FornecedorDAO->deletarFornecedor($fornecedor)){

            if ($FornecedorDAO->selecionarFornecedorID($fornecedor) == new FornecedorVO()){
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

$user = new TestFornecedorDAO();
$user->test_funcoes_fornecedor();

?>