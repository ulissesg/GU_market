<?php

include_once __DIR__."../../src/model/DAO/FornecedorDAO.php";

class TestFornecedorDAO{

    public function test_funcoes_fornecedor(){
        // Testa as querys do fornecedor

        try {
            $ok = false;
            $FornecedorDAO = new FornecedorDAO();

            $fornecedor = new FornecedorVO;
            $fornecedor->setNome('test-001');
            $fornecedor->setCnpj('12*56L85');
            

            $fornecedor2 = new FornecedorVO();
            $fornecedor2->setNome('test-002');
            $fornecedor2->setCnpj('298465187');

            $fornecedor3 = new FornecedorVO();
            $fornecedor3->setNome('test-003');
            $fornecedor3->setCnpj('29846656451267');

            $forn[0] = $fornecedor;
            $forn[1] = $fornecedor2;
            $forn[2] = $fornecedor3;

            $this->testa_inserir($forn, $FornecedorDAO, $ok);

            $this->testa_editar($forn, $FornecedorDAO, $ok);
            
            $this->testa_selecionar_todos($forn, $FornecedorDAO, $ok);
            
            $this->testa_deletar($forn, $FornecedorDAO, $ok);  

            if ($ok){
                echo 'Teste fornecedor DAO OK';

            } else {
                echo 'Teste fornecedor DAO falhou';
            }

        } catch (Exception $e) {
            echo 'Teste falhou';
        }
    }

    private function testa_inserir(&$fornecedor, $FornecedorDAO, &$ok){

        $FornecedorDAO->inserirFornecedor($fornecedor[0]);

        $fornecedorBD = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor[0]);

        if ($fornecedorBD) {

            if ($fornecedorBD->getNome() == $fornecedor[0]->getNome() and 
                $fornecedorBD->getCnpj() == $fornecedor[0]->getCnpj()){

                $ok = true;
                $fornecedor[0]->setIdFornecedor($fornecedorBD->getIdFornecedor());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_selecionar_todos(&$fornecedor, $FornecedorDAO, &$ok){

        $FornecedorDAO->inserirFornecedor($fornecedor[1]);
        $FornecedorDAO->inserirFornecedor($fornecedor[2]);

        $fornecedor[1] = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor[1]);
        $fornecedor[2] = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor[2]);

        $fornecedores = $FornecedorDAO->selecionarTodos();

        if ($fornecedores) {   

            $iBD = count($fornecedores) - 3;
            $iF = 0;

            while($iBD < count($fornecedores)){

                if ($fornecedor[$iF] == $fornecedores[$iBD]){
                    $ok = true;
                    $fornecedor[$iF]->setIdFornecedor($fornecedores[$iBD]->getIdFornecedor());
                    

                }else {
                    throw new Error('incompatible result from bd', 1);
                }
                $iBD++;
                $iF ++;
            }
        
        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_editar(&$fornecedor, $FornecedorDAO, &$ok){

        $fornecedor[0]->setCnpj('18*65j9');

        $FornecedorDAO->editarFornecedor($fornecedor[0]);

        $fornecedorBD = $FornecedorDAO->selecionarFornecedorCnpj($fornecedor[0]);

        if ($fornecedorBD) {

            if ($fornecedorBD->getNome() == $fornecedor[0]->getNome() and 
                $fornecedorBD->getCnpj() == $fornecedor[0]->getCnpj() and 
                $fornecedorBD->getCnpj() <> '12*56L85'){

                $ok = true;
                $fornecedor[0]->setIdFornecedor($fornecedorBD->getIdFornecedor());

            }else {
                $ok = false;
                throw new Error('Incompatible result from bd', 1);
            }

        }else {
            $ok = false;
            throw new Error('No results back from bd', 1);
        }
    }

    private function testa_deletar(&$fornecedor, $FornecedorDAO, &$ok){
        
        if ($FornecedorDAO->deletarFornecedor($fornecedor[0]) and 
            $FornecedorDAO->deletarFornecedor($fornecedor[1]) and
            $FornecedorDAO->deletarFornecedor($fornecedor[2])){

            if ($FornecedorDAO->selecionarFornecedorID($fornecedor[0]) == new FornecedorVO() and
                $FornecedorDAO->selecionarFornecedorID($fornecedor[1]) == new FornecedorVO() and
                $FornecedorDAO->selecionarFornecedorID($fornecedor[2]) == new FornecedorVO()){
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