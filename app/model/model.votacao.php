<?php

class votacao
{
    private $userLogado;
    private $userVotado;
    private $qtdVotos;
    private $jaVotou;
    private $idUserLogado;
    private $idUserVotado;
    private $pdo;


    function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function __set($atributo, $value)
    {
        $this->$atributo = $value;
    }


    // função para adicionar quem votou e em quem
    public function votacao($votacao)
    {
        $sql = 'INSERT INTO votacao VALUES(:id, :userLogado, :userVotado)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', 0);
        $stmt->bindValue(':userLogado', $votacao->__get('userLogado'));
        $stmt->bindValue(':userVotado', $votacao->__get('userVotado'));
        $retorno = $stmt->execute();

        if ($retorno != '') {
            $this->updateQtdVotos($votacao->__get('userVotado'));
            $this->updateJaVotou($votacao->__get('userLogado'));
        } else {
            // aqui caso o id do usuário seja passado errado, ele não acha
            echo "Não foi possivel encontrar o registro";
            return 13;
        }
    }

    // função responsavel para incrementar os votos do usuário
    public function updateQtdVotos($userVotado)
    {
        $sql = "UPDATE resultadovotos set qtdVotos = qtdVotos + :qtdVotos WHERE idUser = :idUser";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':qtdVotos', 1);
        $stmt->bindValue(':idUser', $userVotado);
        $stmt->execute();
    }

    // função para dizer se o usuário já voltou ou não
    public function updateJaVotou($user)
    {
        $sql = "UPDATE resultadoVotos set jaVotou = :jaVotou WHERE idUser = :idUser";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':jaVotou', 'Sim');
        $stmt->bindValue(':idUser', $user);
        $stmt->execute();
    }

    // função responsável para informar o id do usuário logado
    public function idUserLogado($user)
    {

        $sql = "SELECT id FROM cadastro WHERE user = :user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user', $user->__get('userLogado'));
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        foreach ($result as $idUsuario) {
            return $idUsuario['id'];
        }
        // return 4;
    }


    // função responsavel por pegar o id do usuário votado
    public function getIdUserVotado($userVotado)
    {
        // aqui estou pegando o id do usuário votado 
        $sql = "SELECT id FROM cadastro WHERE user = :user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user', $userVotado->__get('userVotado'));
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        foreach ($result as $idUsuario) {
            return $idUsuario['id'];
        }
    }
}
