<?php


    include('autoload.php');

    $turmaDAO = new TurmaDAO();

    $oTurma = $turmaDAO->selectTurmaPorId(1)[1][0];

    echo $oTurma;


?>