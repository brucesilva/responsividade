<?php
session_start();
session_destroy();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/login.css">

    <title>login</title>
</head>

<body>


    <?php
    //  Se deu tudo certo na votaão vamos agradecer o usuário pelo seu voto
    if (isset($_GET['sucess'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;">
            <strong>Voto inserido com sucesso, Obrigado ;)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="close" aria-hidden="true">&times;</span>
                </button>
        </div>
    <?php } ?>


    <?php
    //  Se deu tudo certo na votaão vamos agradecer o usuário pelo seu voto
    if (isset($_GET['v'])) {
        if ($_GET['v'] == 2) {  ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;">
                <strong>Usuário já votou esse mês
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="close" aria-hidden="true">&times;</span>
                    </button>
            </div>

    <?php }
    } ?>

    <?php
    //  verificando se existe sessão
    if (isset($_GET['s'])) {
        $verifySession = $_GET['s'];

        if ($verifySession == 1) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align:center;">
                <strong>Favor inserir usuário e senha.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="close" aria-hidden="true">&times;</span>
                    </button>
            </div>

    <?php }
    } ?>

    <?php

    //  verificando se foi enviado algo pela URL
    if (isset($_GET['id'])) {
        $verifyLogin = $_GET['id'];

        if ($verifyLogin == 1) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align:center;">
                <strong>Usuário e/ou senha incorreto!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="close" aria-hidden="true">&times;</span>
                    </button>
            </div>

    <?php }
    } ?>

    <div class="container">

        <div class="container-login">

            <img src="assets/img/funcionarioMes.png" alt="">
            <h3>Login</h3>

            <div class="formulario">
                <form action="app/controllers/controller.athetication.php" method="post">


                    <label for="name">Nome:</label>
                    <input class="radius" type="text" name="name" id="name" required>

                    <label for="senha">Senha:</label>
                    <input type="password" name="pass" id="senha" required>



                    <button class="btn btn-danger" onclick="atheticationLogin();">Entrar</button>
                </form>

                <div class="cadastro">
                    É novo por aqui? <a href="cadastro.php"> Clique aqui</a>
                </div>

            </div> <!-- formulario -->
        </div><!-- container-login -->
    </div><!-- container -->



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


    <script src="assets/js/atheticationLogin.js">
        $('.alert').alert()
    </script>
</body>

</html>