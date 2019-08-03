<?php

require_once "InstituicaoDAO.class.php";

/**
 * Classe AlunoDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class AlunoDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;
    const OPERADOR_IGUAL      = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Aluno $Aluno)
    {
        try {
            $sql = ""
                . "INSERT INTO aluno (codigo, nome, score, posicao, desde, resolvidos, tentados, submissoes, idInstituicao)"
                . "VALUES (:codigo, :nome, :score, :posicao, :desde, :resolvidos, :tentados, :submissoes, :idInstituicao)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':score', $score, PDO::PARAM_STR);
            $stmt->bindParam(':posicao', $posicao, PDO::PARAM_STR);
            $stmt->bindParam(':desde', $desde, PDO::PARAM_STR);
            $stmt->bindParam(':resolvidos', $resolvidos, PDO::PARAM_STR);
            $stmt->bindParam(':tentados', $tentados, PDO::PARAM_STR);
            $stmt->bindParam(':submissoes', $submissoes, PDO::PARAM_STR);
            $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_STR);
            $codigo = $Aluno->getCodigo();
            $nome = $Aluno->getNome();
            $score = $Aluno->getScore();
            $posicao = $Aluno->getPosicao();
            $desde = $Aluno->getDesde();
            $resolvidos = $Aluno->getResolvidos();
            $tentados = $Aluno->getTentados();
            $submissoes = $Aluno->getSubmissoes();
            $idInstituicao = $Aluno->getInstituicao()->getId();

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Aluno $Aluno)
    {
        try {
            $sql = ""
                . "UPDATE aluno "
                . "    SET codigo = :codigo, "
                . "    nome = :nome, "
                . "    score = :score, "
                . "    posicao = :posicao, "
                . "    desde = :desde, "
                . "    resolvidos = :resolvidos, "
                . "    tentados = :tentados, "
                . "    submissoes = :submissoes, "
                . "    idInstituicao = :idInstituicao "
                . "WHERE idAluno = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':score', $score, PDO::PARAM_STR);
            $stmt->bindParam(':posicao', $posicao, PDO::PARAM_STR);
            $stmt->bindParam(':desde', $desde, PDO::PARAM_STR);
            $stmt->bindParam(':resolvidos', $resolvidos, PDO::PARAM_STR);
            $stmt->bindParam(':tentados', $tentados, PDO::PARAM_STR);
            $stmt->bindParam(':submissoes', $submissoes, PDO::PARAM_STR);
            $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_STR);
            $id = $Aluno->getId();
            $codigo = $Aluno->getCodigo();
            $nome = $Aluno->getNome();
            $score = $Aluno->getScore();
            $posicao = $Aluno->getPosicao();
            $desde = $Aluno->getDesde();
            $resolvidos = $Aluno->getResolvidos();
            $tentados = $Aluno->getTentados();
            $submissoes = $Aluno->getSubmissoes();
            $idInstituicao = $Aluno->getInstituicao()->getId();

            $stmt->execute();
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($iDAluno)
    {
        try {
            $sql = ""
                . "DELETE FROM aluno WHERE idAluno = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id);
            $id = $iDAluno;

            $stmt->execute();
            return [true, 'Deletado com Sucesso'];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Método que retorna a último Aluno cadastrada no DB
     */
    public function selectUltimoAluno()
    {
        try {
            $sql = "select max(idAluno) as ultima from aluno;";
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
                        . "SELECT * FROM aluno WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM aluno WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $oInstituicaoDAO = new InstituicaoDAO();
                    $oInstituicao = $oInstituicaoDAO->select('id', InstituicaoDAO::TIPO_NUMERO, $linha['idInstituicao'])[1][0];
    
                    $result[] = (new Aluno())
                        ->setID($linha['idAluno'])
                        ->setCodigo($linha['codigo'])
                        ->setNome($linha['nome'])
                        ->setScore($linha['score'])
                        ->setPosicao($linha['posicao'])
                        ->setDesde($linha['desde'])
                        ->setResolvidos($linha['resolvidos'])
                        ->setTentados($linha['tentados'])
                        ->setSubmissoes($linha['submissoes'])
                        ->setInstituicao($oInstituicao)
                    ;
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
            $sql = "SELECT * FROM aluno";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = [];
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $oInstituicaoDAO = new InstituicaoDAO();
                $oInstituicao = $oInstituicaoDAO->select('id', InstituicaoDAO::TIPO_NUMERO, $linha['idInstituicao'])[1][0];

                $result[] = (new Aluno())
                    ->setID($linha['id'])
                    ->setCodigo($linha['codigo'])
                    ->setNome($linha['nome'])
                    ->setScore($linha['score'])
                    ->setPosicao($linha['posicao'])
                    ->setDesde($linha['desde'])
                    ->setResolvidos($linha['resolvidos'])
                    ->setTentados($linha['tentados'])
                    ->setSubmissoes($linha['submissoes'])
                    ->setInstituicao($oInstituicao)
                ;
            }
            return [true, $result];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}