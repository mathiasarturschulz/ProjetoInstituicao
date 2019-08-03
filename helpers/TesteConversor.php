<?php

    require_once('Conversor.php');

    $json_format = Conversor::getDadosAlunoJSONComOID('4044');

    header('Content-Type: application/json');
    echo $json_format;


?>