<?php

require_once('../../config.php');
require_once('../model/model.login.php');

$user = $_POST['user'];
$pass = $_POST['pass'];
$setor = $_POST['setor'];
$arquivo = $_FILES['arquivo'];

if (isset($_FILES['arquivo'])) {
    $arquivo = $_FILES['arquivo'];

    if ($arquivo['error'])
        die("Falha ao enviar o arquivo");

    if ($arquivo['size'] > 2097152)
        die("Arquivo muito grande!! Max: 2MB");


    $pasta = '../../img_users/';
    $nomeDoArquivo = $arquivo['name'];

    // esse uniqid gera um id único que não se repete
    $novoNomeDoArquivo = uniqid();
    // echo "Nome do arquivo ", $nomeDoArquivo;

    $extensao = strtolower(substr($_FILES['arquivo']['name'], -3));
    // echo "Novo nome do arquivo ", $novoNomeDoArquivo . "." . $extensao;
    if ($extensao != 'jpg' && $extensao != 'png')
        die("Tipo de arquivo não aceito");

    //-----Insere a imagem na pasta, se deu certo retorna 1 para o deu_certo
    $imgGravada =  move_uploaded_file($arquivo['tmp_name'], $pasta . $novoNomeDoArquivo . "." . $extensao);



    if ($imgGravada == 1) {
        // echo "entrei no imagem gravada";
        $caminhoPastaImg = 'img_users/';

        $cadastro = new login($pdo);
        $cadastro->__set('user', $user);
        $cadastro->__set('pass', $pass);
        $cadastro->__set('setor', $setor);
        $cadastro->__set('nomeImagem', $nomeDoArquivo);
        // $cadastro->__set('pathImagem', $pasta . $novoNomeDoArquivo . "." . $extensao);
        $cadastro->__set('pathImagem', $caminhoPastaImg . $novoNomeDoArquivo . "." . $extensao);

        $retorno = $cadastro->cadUser($cadastro);

        // if ($retorno == 1) {
        //     header('location:../../index.php');
        // } else {
        //     echo "Não foi possivel cadastrar, por favor tente novamente em alguns minutos";
        // }
    } else {
        die("Não conseguimos gravar sua imagem, por favor tente novamente");
    }
}
