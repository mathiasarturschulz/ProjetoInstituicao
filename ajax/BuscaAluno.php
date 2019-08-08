<?php 

require_once('../helpers/Conversor.php');
require_once('../classes/Aluno.class.php');

/**
 * Readers para não utilizar o cache do browser
 */
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 

// CODIGO DO ALUNO PASSADO PELO GET
$codigoAluno = $_GET["n"];

// REALIZA A BUSCA DOS DADOS DO ALUNO
$json_data = Conversor::getDadosAlunoJSONComOID($codigoAluno);

$table = "";
$aData = json_decode($json_data, true);
if ($aData) {
    $table = ""
        . "<tr> <td>Código</td>      <td id='codigo'>{$codigoAluno}</td> </tr>"
        . "<tr> <td>Nome</td>        <td id='nome'>{$aData['nome']}</td> </tr>"
        . "<tr> <td>Score</td>       <td id='score'>{$aData['score']}</td> </tr>"
        . "<tr> <td>Posicao</td>     <td id='posicao'>{$aData['posicao']}</td> </tr>"
        . "<tr> <td>Desde</td>       <td id='desde'>" . (new DateTime($aData['desde']))->format('d/m/Y') . "</td> </tr>"
        . "<tr> <td>Resolvidos</td>  <td id='resolvidos'>{$aData['resolvidos']}</td> </tr>"
        . "<tr> <td>Tentados</td>    <td id='tentados'>{$aData['tentados']}</td> </tr>"
        . "<tr> <td>Submissoes</td>  <td id='submissoes'>{$aData['submetidos']}</td> </tr>"
        . "<tr> <td>Instituicao</td> <td id='instituicao'>{$aData['instituicao']}</td> </tr>"
    ;
}

// RETORNA O RESULTADO PARA O AJAX
echo $table;

?> 