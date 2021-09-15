<?php include_once "src/view/cabecalho_login_signin.php" ?>
<h3 class="text-center mb-5 fw-light"> login </h3>

<form method="POST" action="src/controler/loginControl.php" class="m-5 px-5 pb-3 ">

    <div class="mx-5 px-5">

        <?php
        include_once 'src/controler/message/messageLogin.php';
        ?>

        <div class="mx-5 my-2 px-5">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control">
        </div>
        
        <div class="mx-5 my-2 px-5">
            <label class="form-label">Senha</label>
            <input type="text" name="senha" class="form-control">
        </div>

        <div class="mx-5 my-2 px-5 text-center">
            <input type="submit" value="Entrar" class="btn btn-primary m-2">
            <a class="btn btn-primary m-2" href="/gu_market/src/view/signin.php">Sign in</a>
        </div>
        
    </div>
    
</form>
<?php include_once "src/view/rodape.php" ?>