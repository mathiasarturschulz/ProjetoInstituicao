<?php
    require_once "inc/Header.php";
    echo "<br>";

    echo var_dump($_POST);
    echo 'TESTE';

    $aListaAlunos = [];
    foreach ($_POST['arrayNomes'] as $chave => $oNome) {
        $oAlunoDAO = new AlunoDAO();

        // $oAluno = (new Aluno())
        //     ->setCodigo(123)
        //     ->setNome('Mathias Schulz')
        //     ->setScore(1000)
        //     ->setPosicao(250)
        //     ->setDesde(new DateTime('10/10/2019'))
        //     ->setResolvidos(10)
        //     ->setTentados(13)
        //     ->setSubmissoes(50)
        //     ->setInstituicao((new Instituicao())->setId(1));
        // echo $oAlunoDAO->insert($oAluno)[1];
    }


    $oTurmaDAO = new TurmaDAO();

    // $oAluno1 = (new Aluno())->setId(3);
    // $oAluno2 = (new Aluno())->setId(4);
    // $oTurma = (new Turma())
    //     ->setNome('Algoritmos')
    //     ->setListaAlunos([$oAluno1, $oAluno2]);
    // echo $oTurmaDAO->insert($oTurma)[1];

    // header('Location: turma.php');

    require_once "inc/Footer.php";
