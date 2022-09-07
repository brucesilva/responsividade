<?php
session_start();

require_once('../../config.php');
require_once('../model/model.login.php');

$idUser = $_GET['id'];
$name = $_POST['name'];
$sector = $_POST['sector'];
$pass = $_POST['pass'];
$foto = $_FILES['foto'];

if (isset($_FILES['foto'])) {
	$foto = $_FILES['foto'];

	if ($foto['error'])
		die("Falha ao enviar o arquivo");

	if ($foto['size'] > 2097152)
		die("Arquivo muito grande!! Max: 2MB");

	$pasta = '../../img_users/';
	$nomeDoArquivo = $foto['name'];

	// esse uniqid gera um id único que não se repete
	$novoNomeDoArquivo = uniqid();
	// echo "Nome do arquivo ", $nomeDoArquivo;

	$extensao = strtolower(substr($_FILES['foto']['name'], -3));
	// echo "Novo nome do arquivo ", $novoNomeDoArquivo . "." . $extensao;
	if ($extensao != 'jpg' && $extensao != 'png')
		die("Tipo de arquivo não aceito");

	//-----Insere a imagem na pasta, se deu certo retorna 1 para o deu_certo
	$imgGravada =  move_uploaded_file($foto['tmp_name'], $pasta . $novoNomeDoArquivo . "." . $extensao);

	if ($imgGravada == 1) {
		// echo "entrei no imagem gravada";
		$caminhoPastaImg = 'img_users/';

		$update = new login($pdo);
		$update->__set('id', $idUser);
		$update->__set('user', $name);
		$update->__set('setor', $sector);
		$update->__set('pass', $pass);
		// $cadastro->__set('pathImagem', $pasta . $novoNomeDoArquivo . "." . $extensao);
		$update->__set('pathImagem', $caminhoPastaImg . $novoNomeDoArquivo . "." . $extensao);
		// $update->update($update);

		$retorno = $update->update($update);

		if ($retorno == 1) {
			$_SESSION['login'] =  $name;
			header('location:../../votacao.php');
		} else {
			echo "Não foi possivel cadastrar, por favor tente novamente em alguns minutos";
		}
	} else {
		die("Não conseguimos gravar sua imagem, por favor tente novamente");
	}
}
