<?php
session_start();

require_once('config.php');
require_once('app/model/model.login.php');
require_once('app/model/model.allUser.php');

$logado = $_SESSION['login'];

// $idUser = $_SESSION['idUser'];

if ($logado == '') {
  header('location:index.php');
}

foreach ($allUser as $user) {
  // echo $user['id'], "<br>";
  // echo "Quem está logado é o ", $logado, "<br>";
  if ($logado == $user['user']) {
    $idLogado = $user['id'];
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

  <link rel="stylesheet" href="assets/css/style.css">

  <title>Responsividade</title>
</head>

<body>

  <header>
    <div class="logo">
      <img src="assets/img/searaLogo.png" alt="">
    </div>

    <div class="title">
      <h1>Programa Gente que Faz</h1>
      Bem vindo
      <?php echo ucfirst($logado) ?>
    </div>

    <div class="logo logoRight">
      <img src="assets/img/searaLogo.png" alt="">
    </div>
  </header>

  <?php
  // se der algum problema com o id do usuário vai da uma alerta para o usuário
  if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 13) { ?>
      <div style="max-width:990px; margin:0 auto; text-align:center; margin-bottom:20px; margin-top: -20px;" class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align:center;">
        <strong>Aconteceu algum problema com o id do usuário, favor informar ao adiminstrador
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
      </div>

  <?php }
  } ?>

  <!-- <form action="app/controllers/controller.votacao.php?<= $user['user'] ?>" method="POST"> -->
  <form action="" method="POST">
    <section>
      <?php
      foreach ($allUser as $user) { ?>

        <?php
        // aqui vamos tirar o card do usuário logado no sistema
        if ($logado == $user['user']) {  ?>
        <?php } ?>

        <div class="card" style="width: 15rem;">
          <img class="card-img-top imgUser" src="<?php echo $user['pathImg'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo ucfirst($user['user']) ?> </h5>
            <p class="card-text">Analista de Suporte</p>

            <?php
            // aqui devemos bloquear o botão
            if ($logado == $user['user']) { ?>
              <div class="removeBotao">
                <a href="app/controllers/controller.votacao.php?user=<?= $user['user'] ?>" class="btn btn-primary btn-block">Votar</a>
              </div>
            <?php } else { ?>

              <a href="app/controllers/controller.votacao.php?user=<?= $user['user'] ?>" class="btn btn-primary btn-block">Votar</a>

            <?php } ?>
          </div>
        </div>
      <?php }

      $_SESSION['userLogado'] = $logado;
      ?>
    </section>
  </form>

  <script src="assets/js/votacao.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


  <script src="assets/js/atheticationLogin.js">
    $('.alert').alert()
  </script>


</body>

</html>