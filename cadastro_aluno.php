<?php
    require_once "inc/Header.php";
    echo "<br>";

    echo var_dump($_POST);
    echo 'TESTE';

    $aListaAlunos = [];
    foreach ($_POST['arrayCodigos'] as $chave => $sCodigo) {

        echo 'INSTITUIÇÃO: ';
        // CADASTRA A INSTITUIÇÃO
        $oInstituicaoDAO = new InstituicaoDAO();
        $nomeInstituicao = $_POST['arrayInstituicoes'][$chave];
        if ($nomeInstituicao !== "") {
            $idInstituicao = $oInstituicaoDAO->verificaPossuiCadastro($nomeInstituicao);
            if (!$idInstituicao) {
                $oInstituicao = (new Instituicao())->setNome($_POST['arrayInstituicoes'][$chave]);
                echo $oInstituicaoDAO->insert($oInstituicao)[1];
                $idInstituicao = $oInstituicaoDAO->verificaPossuiCadastro($nomeInstituicao);
            }
        }

        echo 'ALUNO';
        // CADASTRA O ALUNO
        $oAlunoDAO = new AlunoDAO();
        $idAluno = $oAlunoDAO->verificaPossuiCadastro($sCodigo);
        if (!$idAluno) {
            $oAluno = (new Aluno())
                ->setCodigo($sCodigo)
                ->setNome($_POST['arrayNomes'][$chave])
                ->setScore($_POST['arrayScores'][$chave])
                ->setPosicao($_POST['arrayPosicoes'][$chave])
                ->setDesde(new DateTime($_POST['arrayDesde'][$chave]))
                ->setResolvidos($_POST['arrayResolvidos'][$chave])
                ->setTentados($_POST['arrayTentados'][$chave])
                ->setSubmissoes($_POST['arraySubmissoes'][$chave]);
            if (isset($idInstituicao)) {
                $oAluno->setInstituicao((new Instituicao())->setId($idInstituicao));
            }else {
                $oAluno->setInstituicao((new Instituicao())->setId(null));
            }
            echo '<br><br>';
            echo $oAluno;
            echo '<br><br>';

            echo $oAlunoDAO->insert($oAluno)[1];
            $oAluno->setId($oAlunoDAO->verificaPossuiCadastro($sCodigo));
        }else {
            $oAluno = (new Aluno())->setId($idAluno);
        }

        $aListaAlunos[] = $oAluno;
    }

    echo 'TURMA';
    // CADASTRA A TURMA
    $oTurmaDAO = new TurmaDAO();
    $oTurma = (new Turma())
        ->setNome($_POST['nome_turma'])
        ->setListaAlunos($aListaAlunos);
    echo $oTurmaDAO->insert($oTurma)[1];

    // header('Location: turma.php');

    require_once "inc/Footer.php";
