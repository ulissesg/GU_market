<?php
include_once "../model/DAO/FornecedorDAO.php";
$fornecedorDAO = new FornecedorDAO();
$fornecedor = new FornecedorVO();
$fornecedor->setIdFornecedor($_GET['id']);
$fornecedor = $fornecedorDAO->selecionarFornecedorID($fornecedor);
?>

<div class="m-5 px-5">
    <form method="POST" action="../controler/editarFornecedorControl.php?id=<?php echo $_GET['id'];?>">

        <?php
            include_once '../../src/controler/message/messageFornecedorForm.php';
        ?>

        <div class="my-2">
            <label class="form-label">Nome: <font color="red">*</font></label>
            <input type="text" name="nome" class="form-control" value="<?php echo $fornecedor->getNome(); ?>">
        </div>
        <div class=" my-2" >
            <label class="form-label">CNPJ: <font color="red">*</font></label>
            <input type="text" name="cnpj" class="form-control" value="<?php echo $fornecedor->getCnpj(); ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-5">Salvar</button>
        </div>
    </form>
</div>