<div class="m-5 px-5">
    <form method="POST" action="../controler/inserirFornecedorControl.php">

        <?php
            include_once '../../src/controler/message/messageFornecedorForm.php';
        ?>

        <div class="my-2">
            <label class="form-label">Nome: <font color="red">*</font></label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class=" my-2" >
            <label class="form-label">CNPJ: <font color="red">*</font></label>
            <input type="text" name="cnpj" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-5">Salvar</button>
        </div>
    </form>
</div>