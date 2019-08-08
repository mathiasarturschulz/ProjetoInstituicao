<?php
    require_once "inc/Header.php";
    echo "<br>";

    $oTurmaDAO = new TurmaDAO();
    if ($_POST['id']) {
        $oTurmaDAO->delete($_POST['id']);
    }

    header('Location: turma.php');

    require_once "inc/Footer.php";
