<?php 
include_once "cabecalho_model.php"; 
if(isset($_SESSION)){
    if (array_key_exists('id', $_SESSION)){

?>

<div class="m-5 px-5">
    <form method="POST">
        <div class="my-2">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class="my-2">
            <label class="form-label">Descrição:</label>
            <textarea  rows="5" name="descricao" class="form-control"></textarea>
        </div>
        <div class="my-2">
            <label class="form-label">Codigo de barras:</label>
            <input type="text" name="codigo_barras" class="form-control">
        </div>
        <div class="my-2">
            <label class="form-label">Fabricante:</label>
            <input type="text" name="fabricante" class="form-control">
        </div>
        <div class="my-2">
            <label class="form-label">validade:</label>
            <input type="date" name="validade" class="form-control">
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
                    echo('<option value="'.$forn->getIdFornecedor().'">'.$forn->getNome().' </option>');
                }
                echo '</select>';

            ?>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-5">Salvar</button>
        </div>
    </form>
</div>

<?php 
    }
}
include_once "rodape.php" ;
?>