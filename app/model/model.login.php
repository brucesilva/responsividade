<?php

class login
{
    private $id;
    private $idUser;
    private $user;
    private $pass;
    private $setor;
    private $nomeImagem;
    private $pathImagem;
    private $qtdVotos = 0;
    private $jaVotou = 'Não';
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
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // depois que fizer o cadastro, ele precisa cadastrar o id do usuário 
            // na tabela de resultado votos, onde fica a qtd de votos e se ele já voltou ou não
            $sql = "SELECT * FROM cadastro WHERE user = :user";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindvalue(':user', $cadastro->__get('user'));
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $userId) {
            }

            $insert = "INSERT INTO resultadoVotos VALUES(0, :idUser, :qtdVotos, :jaVotou)";
            $stat = $this->pdo->prepare($insert);
            $stat->bindValue(':idUser', $userId['idUser']);
            $stat->bindValue(':qtdVotos', $this->qtdVotos);
            $stat->bindValue(':jaVotou', $this->jaVotou);
            $stat->execute();

            // echo "<pre>";
            // echo print_r($result);
            // echo "</pre>";

            // return 1;
        } else {
            return 0;
        }
    }



    public function update($alterarDados)
    {
        $sql = "UPDATE cadastro set user = :user, setor = :setor, pathImg =:pathImg , senha = :senha WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user',  $alterarDados->__get('user'));
        $stmt->bindValue(':setor', $alterarDados->__get('setor'));
        $stmt->bindValue(':pathImg', $alterarDados->__get('pathImagem'));
        $stmt->bindValue(':senha',  $alterarDados->__get('pass'));
        $stmt->bindValue(':id',    $alterarDados->__get('id'));
        return $stmt->execute();
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
