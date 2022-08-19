<?php

class login
{
    private $id;
    private $user;
    private $pass;
    private $setor;
    private $nomeImagem;
    private $pathImagem;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $value)
    {
        $this->$atributo = $value;
    }

    public function athetication($login)
    {
        $sql = "SELECT * FROM cadastro WHERE user = :user and senha = :pass";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user', $login->__get('user'));
        $stmt->bindValue(':pass', $login->__get('pass'));
        $stmt->execute();
        return $result = $stmt->rowCount();

        // echo "<pre>";
        // echo print_r($stmt);
        // echo "</pre>";
    }

    public function cadUser($cadastro)
    {

        $sql = "INSERT INTO cadastro VALUES  (0, :user,:setor,:caminho,:pass)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user', $cadastro->__get('user'));
        $stmt->bindValue(':setor', $cadastro->__get('setor'));
        $stmt->bindValue(':caminho', $cadastro->__get('pathImagem'));
        $stmt->bindValue(':pass', $cadastro->__get('pass'));
        // $stmt->bindValue(':nomeImg', $cadastro->__get('nomeImagem')); 
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function allUser()
    {
        $sql = "SELECT * FROM login";
        $stmt = $this->pdo->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
