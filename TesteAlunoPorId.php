<?php
    include('autoload.php');

    $alunoDAO = new AlunoDAO();

    $oAluno = $alunoDAO->selectAlunoPorId(1)[1][0];

    echo $oAluno;


?>