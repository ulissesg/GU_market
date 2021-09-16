<?php
include_once "../model/DAO/ProdutoDAO.php";
$produtoDAO = new ProdutoDAO();
$produto = new ProdutoVO();
$produto->setIdProduto($_GET['id']);
$produto = $produtoDAO->selecionarProdutoID($produto);
?>

<div class="m-5 px-5">
    <form method="POST" action="../controler/editarProdutoControl.php?id=<?php echo $_GET['id'] ?>">

        <?php
            include_once '../../src/controler/message/messageProdutoForm.php';
        ?>

        <div class="my-2">
            <label class="form-label">Nome: <font color="red">*</font></label>
            <input type="text" name="nome" class="form-control" value="<?php echo $produto->getNome(); ?>">
        </div>
        <div class="my-2">
            <label class="form-label">Descrição:</label>
            <textarea  rows="5" name="descricao" class="form-control"><?php echo $produto->getDescricao(); ?></textarea>
        </div>
        <div class="my-2">
            <label class="form-label">Codigo de barras: <font color="red">*</font></label>
            <input type="text" name="codigo_barras" class="form-control" value="<?php echo $produto->getCodigoBarras(); ?>">
        </div>
        <div class="my-2">
            <label class="form-label">Fabricante:</label>
            <input type="text" name="fabricante" class="form-control" value="<?php echo $produto->getFabricante(); ?>">
        </div>
        <div class="my-2">
            <label class="form-label">validade:</label>
            <input type="date" name="validade" class="form-control" value="<?php echo $produto->getValidade(); ?>">
        </div>
        <div class="my-2">
            <label class="form-label">Fornecedor:</label>
            <?php
                include_once __DIR__."../../model/DAO/FornecedorDAO.php";

                $fornecedorDAO = new FornecedorDAO();
                $fornecedores = $fornecedorDAO->selecionarTodos();
                echo"<select name='fornecedor' class='form-control'>";
                echo"<option value='' disabled selected>escolha um fornecedor</option>";
                foreach($fornecedores as $forn){
                    if ($forn->getIdFornecedor() == $produto->getFkFornecedor()){
                        echo('<option value="'.$forn->getIdFornecedor().'" selected="selected">'.$forn->getNome().' </option>');
                    }else{
                        echo('<option value="'.$forn->getIdFornecedor().'">'.$forn->getNome().' </option>');
                    }

                }
                echo '</select>';

            ?>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-5">Salvar</button>
        </div>
    </form>
</div>