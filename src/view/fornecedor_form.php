<?php 
include_once "cabecalho_model.php" ;
if(isset($_SESSION)){
    if (array_key_exists('id', $_SESSION)){

?>

<div class="m-5 px-5">
    <form method="POST">
        <div class="my-2">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class=" my-2" >
            <label class="form-label">CNPJ:</label>
            <input type="text" name="cnpj" class="form-control">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-5">Salvar</button>
        </div>
    </form>
</div>

<?php 
    }
}
include_once "rodape.php";
 ?>