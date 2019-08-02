<?php
    require_once "inc/Header.php";
    echo "<br>";

    $oInstituicaoDAO = new InstituicaoDAO();

    $oInstituicao = (new Instituicao())->setNome('Mathias Schulz');
    echo $oInstituicaoDAO->insert($oInstituicao)[1];

    $oInstituicao = (new Instituicao())->setId(1)->setNome('Mathias Artur Schulz');
    echo $oInstituicaoDAO->update($oInstituicao)[1];

    $oInstituicao = (new Instituicao())->setId(2);
    echo $oInstituicaoDAO->delete($oInstituicao)[1];


    require_once "inc/Footer.php";
    