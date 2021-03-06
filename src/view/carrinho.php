<?php 
include_once "cabecalho_model.php" ;
if(isset($_SESSION)){
    if (array_key_exists('id', $_SESSION)){

        include_once "../../src/controler/message/messageCarrinho.php";

        include_once "../model/DAO/CarrinhoDAO.php";
        include_once "../model/DAO/ProdutoDAO.php";
        include_once "../model/DAO/FornecedorDAO.php";
        $fornecedorDAO = new FornecedorDAO();
        $fornecedor = new FornecedorVO();
        $carrinhoDAO = new CarrinhoDAO();
        $produto = new ProdutoVO();
        $produtoDAO = new ProdutoDAO();
        $carrinhos = $carrinhoDAO->buscarCarrinhoUsuario($_SESSION['id']);


        foreach($carrinhos as $car){
        
            $produto->setIdProduto($car->getProduto());
            $produto = $produtoDAO->selecionarProdutoID($produto);
            $fornecedor->setIdFornecedor($produto->getFkFornecedor());
            $fornecedor = $fornecedorDAO->selecionarFornecedorID($fornecedor);
        
            ?>

            <div class="m-5 border border-lighter border-2 rounded">
                <div class="d-flex bd-highlight m-4">
                    <div class="ms-2 mt-2 flex-grow-1 bd-highlight me-4">
                        <h4><?php echo $produto->getNome(); ?></h4>
                        <p><?php echo $produto->getDescricao(); ?></p>
                        <div class="d-flex justify-content-between">
                            <p>Codigo de barras: <?php echo $produto->getCodigoBarras(); ?></p>
                            <p>Fabricante: <?php echo $produto->getFabricante(); ?></p>
                        </div>
                        <div class="d-flex justify-content-between m-1">
                            <p class="">Validade: <?php echo $produto->getValidade(); ?></p>
                            <p class="">Fornecedor: <?php echo $fornecedor->getNome(); ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-self-center flex-column  bd-highlight ">
                        <div class="p-2 bd-highlight text-center">
                            <a onclick="showConfirm('<?php echo $car->getIdCarrinho() ;?>');"  class="btn btn-primary">
                                Excluir do carrinho
                            </a>
                        </div>  
                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center mx-5 px-5 m-4 d-none" id="<?php echo $car->getIdCarrinho() ;?>" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div >
                        Tem certeza que deseja remover esse produto do carrinho ?
                    </div>
                    <div class="ms-auto bd-highlight">
                        <a type="button" onclick="deleteConfirmed('<?php echo $car->getIdCarrinho(); ?>')" class="btn btn-danger">Confirmar</a>
                    </div>
                </div>
                
            </div>

            <script src="/gu_market/src/js/removeProdutoCarrinho.js" ></script>

<?php
        } 
    }
}
include_once "rodape.php";
?>