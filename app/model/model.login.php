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

        echo "O user passado foi ", $login->__get('user'), "<br>";
        echo "senha ", $login->__get('pass'), "<br>";

        // aqui se encontrou o usário
        if ($stmt->rowCount() > 0) {
            $IdUser = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // aqui o usuário foi encontado
            foreach ($IdUser as $userId) {
                $userJaVotou = $this->verificaSituacao($userId['id']);

                if ($userJaVotou == 1) {
                    // echo "Usuário já votou <br>";
                    return 2;
                    die();
                }

                if ($userJaVotou == 0) {
                    return 1;
                }
            }
            // return 1;
        } else {
            return 0;
            // die();
        }
    }

    public function verificaSituacao($idUser)
    {
        // aqui é para verificar se a pessoa votou ou não 
        $sqlSituacao = "SELECT idUser FROM resultadovotos WHERE idUser = :idUser and jaVotou = :jaVotou";
        $stmtSituacao = $this->pdo->prepare($sqlSituacao);
        $stmtSituacao->bindValue(':idUser', $idUser);
        $stmtSituacao->bindValue(':jaVotou', 'Sim');
        $stmtSituacao->execute();
        $user = $stmtSituacao->rowCount();

        $users = $stmtSituacao->fetchall(PDO::FETCH_ASSOC);

        foreach ($users as $jaVotou) {
        }
        // aqui já votou
        if ($jaVotou['idUser'] == $idUser) {
            return 1;
            die();
        }
        // aqui não votou
        if ($jaVotou['idUser'] != $idUser) {
            return 0;
            die();
        }
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
