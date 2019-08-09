<?php

/**
 * Classe TurmaDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class TurmaDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;
    const OPERADOR_IGUAL      = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Turma $Turma)
    {
        try {
            $sql = ""
                . "INSERT INTO turma (nome)"
                . "VALUES (:nome)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $nome = $Turma->getNome();
            
            $stmt->execute();
            $aResult = $this->selectUltimaTurma();
            if ($stmt->rowCount() && $aResult[0]) {
                return $this->insertAlunos($aResult[1], $Turma->getListaAlunos());
            } else {
                return [false, "Erro ao Inserir"];
            }
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function insertAlunos($iIdTurma, array $aAlunos)
    {
        try {
            $aResult = [];
            foreach ($aAlunos as $oAluno) {
                $aResult = $this->insertTurmaAluno($iIdTurma, $oAluno);
                if (!$aResult[0])
                    return [false, 'Error: ' . $aResult[1]];
            }
            return [true, "Inserido com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function insertTurmaAluno($iIdTurma, Aluno $oAluno)
    {
        try {
            $sql = ""
                . "INSERT INTO TurmaAluno (idTurma, idAluno)"
                . "VALUES (:idTurma, :idAluno)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':idTurma', $idTurma, PDO::PARAM_STR);
            $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_STR);
            $idTurma = $iIdTurma;
            $idAluno = $oAluno->getId();

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Turma $Turma)
    {
        try {
            $sql = ""
                . "UPDATE turma "
                . "    SET nome = :nome "
                . "WHERE idTurma = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $id = $Turma->getID();
            $nome = $Turma->getNome();

            $stmt->execute();
            return $this->updateAlunos($id, $Turma->getListaAlunos());
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function updateAlunos($iIdTurma, array $aAlunos)
    {
        try {
            $aResult = $this->deleteAlunos($iIdTurma);
            if (!$aResult[0])
                return [false, 'Error: ' . $aResult[1]];

            $aResult = $this->insertAlunos($iIdTurma, $aAlunos);
            if (!$aResult[0])
                return [false, 'Error: ' . $aResult[1]];
            
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($iDTurma)
    {
        try {
            if (!$this->deleteAlunos($iDTurma)[0])
                return [false, 'Erro ao Deletar'];
            
            $sql = ""
                . "DELETE FROM turma WHERE idTurma = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id);
            $id = $iDTurma;
            
            $stmt->execute();
            return [true, 'Deletado com Sucesso'];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function deleteAlunos($iIdTurma)
    {
        try {
            $sql = ""
                . "DELETE FROM TurmaAluno WHERE idTurma = :idTurma";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idTurma', $idTurma);
            $idTurma = $iIdTurma;

            $stmt->execute();
            return [true, "Deletado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Método que retorna a última Turma cadastrada no DB
     */
    public function selectUltimaTurma()
    {
        try {
            $sql = "select max(idTurma) as ultima from turma;";
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
                        . "SELECT * FROM turma WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM turma WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }

                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $aAlunos = $this->selectAlunos('idTurma', self::TIPO_NUMERO, $linha['idTurma'])[1];
    
                    $result[] = (new Turma())
                        ->setId($linha['idTurma'])
                        ->setNome($linha['nome'])
                        ->setListaAlunos($aAlunos)
                    ;
                }
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    // public function selectAlunos($sIdTurma)
    // {
        
    // }

    public function selectAll()
    {
        try {
            $sql = "SELECT * FROM turma";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = [];
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $aAlunos = $this->selectAlunos('idTurma', self::TIPO_NUMERO, $linha['idTurma'])[1];

                $result[] = (new Turma())
                    ->setId($linha['idTurma'])
                    ->setNome($linha['nome'])
                    ->setListaAlunos($aAlunos)
                ;
            }
            return [true, $result];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Método utilizado para listar as turma sem carregar a lista de alunos das turmas
     */
    public function selectAllSemAlunos()
    {
        try {
            $sql = "SELECT * FROM turma";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = [];
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = (new Turma())
                    ->setId($linha['idTurma'])
                    ->setNome($linha['nome'])
                    ->setListaAlunos([])
                ;
            }
            return [true, $result];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function selectTurmaPorId($id)    
    {
        try {
            $sql = "SELECT * FROM TURMA WHERE IDTURMA = $id;";

            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $turma = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT TA.idAluno FROM TURMA T INNER JOIN TURMAALUNO TA ON T.IDTURMA = TA.IDTURMA WHERE T.IDTURMA = 1;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $alunosRs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $listaAlunos = [];
            foreach($alunosRs as $aluno){
                $alunoDAO = new AlunoDAO();
                $aluno = $alunoDAO->selectAlunoPorId(intval($aluno['idAluno']));
                $listaAlunos[] = $aluno;
            }

            $result = new Turma();

            $result->setNome($turma[0]['nome']);
            $result->setId($turma[0]['idTurma']);
            $result->setListaAlunos($listaAlunos);
            var_dump($listaAlunos[0][1]);
            return [true, $result];

        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

}