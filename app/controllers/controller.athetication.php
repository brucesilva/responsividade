<?php
session_start();

require_once('../../config.php');
require_once('../model/model.login.php');

$name = $_POST['name'];
$pass = $_POST['pass'];

// descomentar daqui pra baixo está certo, estou tentando pegar o caminho da imagem acima
$login = new login($pdo);
$login->__set('user', $name);
$login->__set('pass', $pass);

$result = $login->athetication($login);


// echo "O valor do result é ", $result;

if ($result == 1) {
    $_SESSION['login'] =  $name;
    header('location: ../../votacao.php');
}
if ($result == 2) {
    header('location: ../../index.php?v=2');
}
if ($result == 0) {
    header('location: ../../index.php?id=1');
}
