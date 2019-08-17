<?php
    require_once "inc/Header.php";
?>

<?php

    include('autoload.php');

    $turmaDAO = new TurmaDAO();

    $oTurma = $turmaDAO->selectTurmaPorId($_GET['id'])[1];

    echo($oTurma);

?>

<?php
    require_once "inc/Footer.php";
?>