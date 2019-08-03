<?php

/**
 * Classe InstituicaoDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class InstituicaoDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;

    const OPERADOR_IGUAL      = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Instituicao $Instituicao)
    {
        try {
            $sql = ""
                . "INSERT INTO instituicao (nome)"
                . "VALUES (:nome)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $nome = $Instituicao->getNome();

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Instituicao $Instituicao)
    {
        try {
            $sql = ""
                . "UPDATE instituicao "
                . "    SET nome = :nome "
                . "WHERE idInstituicao = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $id = $Instituicao->getId();
            $nome = $Instituicao->getNome();

            $stmt->execute();
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($idInstituicao)
    {
        try {
            $sql = ""
                . "DELETE FROM instituicao WHERE idInstituicao = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id);
            $id = $idInstituicao;
            
            $stmt->execute();
            return [true, "Deletado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function selectUltimaInstituicao()
    {
        try {
            $sql = "select max(idInstituicao) as ultima from instituicao;";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $total = $linha['ultima'];

            return [true, $total];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function select($campoBusca, $tipo, $valorBusca, $operador = null)
    {
        try {
            if ($campoBusca && $tipo && $valorBusca) {
                // POSSUI PARAMETROS
                $op = self::OPERADOR_IGUAL;
                if ($tipo == self::TIPO_NUMERO) {
                    if ($operador == self::OPERADOR_MAIOR
                        || $operador == self::OPERADOR_MAIORIGUAL
                        || $operador == self::OPERADOR_MENOR
                        || $operador == self::OPERADOR_MENORIGUAL) {
                        $op = $operador;
                    }
                    $sql = ""
                        . "SELECT * FROM instituicao WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM instituicao WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = (new Instituicao())
                            ->setId($linha['idInstituicao'])
                            ->setNome($linha['nome']);
                }
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function selectAll()
    {
        try {
            $sql = "SELECT * FROM instituicao";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = [];
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = (new Instituicao())
                        ->setId($linha['idInstituicao'])
                        ->setNome($linha['nome']);
            }
            return [true, $result];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}