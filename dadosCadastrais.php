<?php

require_once('app/model/model.allUser.php');

$idUser = $_GET['idUser'];
foreach ($allUser as $cadastro) {
    if ($idUser == $cadastro['id']) {
        echo $cadastro['user'];
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dadosCadastrais.css">
    <title>Dados Cadastrais</title>
</head>

<body>
    <div class="container">
        <div class="cadastro">
            <h3>Dados Cadastrais</h3>

            <form action="app/controllers/controller.dadosCadastrais.php?id=<?= $idUser ?>" method="POST" enctype="multipart/form-data">
                <!-- <form action="app/controllers/controller.cadastroUser.php"                      method="post" enctype="multipart/form-data"> -->
                <?php
                foreach ($allUser as $cadastro) {
                    if ($idUser == $cadastro['id']) { ?>

                        <div class="img">
                            <img src="<?= $cadastro['pathImg'] ?>" alt="">
                        </div>
                        <input type="file" name="foto" id="foto">

                        <div class="formulario">
                            <br>
                            <label for="name">Nome:</label><br>
                            <input type="text" name="name" id="name" value="<?= $cadastro['user'] ?>"><br>

                            <label for="sector">Setor:</label><br>
                            <input class="inputSector" type="text" name="sector" id="sector" value="<?= $cadastro['setor'] ?>"> <br>

                            <label for="pass">Senha:</label><br>
                            <input type="text" name="pass" id="pass" value="<?= $cadastro['senha'] ?>">

                            <button class="btn btn-danger btn-block">Alterar</button>
                        </div> <!-- formlario -->

                <?php }
                } ?>


            </form><!-- form -->
        </div> <!-- cadastro -->
    </div> <!-- container -->



</body>

</html>