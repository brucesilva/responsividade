<?php
session_start();

require_once('../../config.php');
require_once('../model/model.votacao.php');

$userLogado = $_SESSION['userLogado'];
$userVotado = $_GET['user'];
// $idUser = $_SESSION['idUser'];

echo "Bem vindo ", $userLogado, "<br>";
echo "Votou em ", $userVotado, "<br>";
// echo "O id do usuário que voltou é o ", $idUser;

// aqui pegando o valor do id do usuário logado
$idUserLogado = new votacao($pdo);
$idUserLogado->__set('userLogado', $userLogado);
$idUser = $idUserLogado->idUserLogado($idUserLogado);

// aqui pegando o valor do id do usuário votado
$idUserVotado = new votacao($pdo);
$idUserVotado->__set('userVotado', $userVotado);
$userIdVotado =  $idUserVotado->getIdUserVotado($idUserVotado);

$votacao = new votacao($pdo);
$votacao->__set('userLogado', $idUser);
$votacao->__set('userVotado', $userIdVotado);

$verificaSeInseriu = $votacao->votacao($votacao);

if ($verificaSeInseriu == 13) {
    header('location:../../votacao.php?erro=13');
    // echo "Estou no controller e não achamos o id do usuário";
}
