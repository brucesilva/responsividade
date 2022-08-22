<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/login.css">
    <title>cadastro</title>
</head>

<body>

    <div class="container">

        <div class="container-login">
            <!-- <h1>Login</h1> -->
            <img src="assets/img/funcionarioMes.png" alt="">
            <h3>Cadastro</h3>

            <div class="formulario">
                <form action="app/controllers/controller.cadastroUser.php" method="post" enctype="multipart/form-data">


                    <label for="name">Nome:</label>
                    <input class="radius" type="text" name="user" id="name" required>

                    <label for="setor">Setor:</label>
                    <input class="radius" type="text" name="setor" id="setor" required>

                    <label for="senha">Senha:</label>
                    <input type="password" name="pass" id="senha" required>

                    <label for="imagem">Selecione sua foto:</label>
                    <input class="radius" type="file" name="arquivo" id="arquivo" required>

                    <button class="btn btn-danger" onclick="atheticationLogin();">Entrar</button>

                </form>

            </div> <!-- formulario -->
        </div><!-- container-login -->
    </div><!-- container -->










</body>

</html>