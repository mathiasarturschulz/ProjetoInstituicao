<?php
    require_once "inc/Header.php";
    echo "<br>";
    // TESTE INCLUSÃO, ALTERAÇÃO E EXCLUSÃO


    // INSTITUICAO
    $oInstituicaoDAO = new InstituicaoDAO();

    // $oInstituicao = (new Instituicao())->setNome('IFC');
    // echo $oInstituicaoDAO->insert($oInstituicao)[1];

    // $oInstituicao = (new Instituicao())->setId(1)->setNome('IFC - Rio do Sul');
    // echo $oInstituicaoDAO->update($oInstituicao)[1];

    // $oInstituicao = (new Instituicao())->setId(2);
    // echo $oInstituicaoDAO->delete($oInstituicao->getId())[1];


    // ALUNO
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

    // $oAluno = (new Aluno())
    //     ->setId(1)
    //     ->setCodigo(123456)
    //     ->setNome('Mathias Artur Schulz')
    //     ->setScore(9999)
    //     ->setPosicao(100)
    //     ->setDesde(new DateTime('10/10/2017'))
    //     ->setResolvidos(10)
    //     ->setTentados(13)
    //     ->setSubmissoes(50)
    //     ->setInstituicao((new Instituicao())->setId(2));
    // echo $oAlunoDAO->update($oAluno)[1];
    
    // $oAluno = (new Aluno())
    //     ->setId(1);
    // echo $oAlunoDAO->delete($oAluno->getId())[1];


    // TURMA
    $oTurmaDAO = new TurmaDAO();

    // $oAluno1 = (new Aluno())->setId(3);
    // $oAluno2 = (new Aluno())->setId(4);
    // $oTurma = (new Turma())
    //     ->setNome('Algoritmos')
    //     ->setListaAlunos([$oAluno1, $oAluno2]);
    // echo $oTurmaDAO->insert($oTurma)[1];

    // $oAluno1 = (new Aluno())->setId(3);
    // $oTurma = (new Turma())
    //     ->setId(1)
    //     ->setNome('Programação')
    //     ->setListaAlunos([$oAluno1]);
    // echo $oTurmaDAO->update($oTurma)[1];

    // $oTurma = (new Turma())
    //     ->setId(1);
    // echo $oTurmaDAO->delete($oTurma->getId())[1];



    require_once "inc/Footer.php";
    