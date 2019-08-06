<?php 


require_once('helpers/Conversor.php');
require_once('classes/Aluno.class.php');

$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 
/* Os readers acima dizem para nao usar o cache do browser! */ 

$n = $_GET["n"]; //pegar a variavei enviada

$json_data = Conversor::getDadosAlunoJSONComOID($n);

// echo $json_data; // agora vamos "retornar" o valor, para isso escrevemos ele em tela 

$table = "";
// $json_data = Conversor::getDadosAlunoJSONComOID($_POST['codigo']);
$aData =  json_decode($json_data, true);
if ($aData) {
    $oAluno = (new Aluno())
        ->setCodigo($n)
        ->setNome($aData['nome'])
        ->setScore($aData['score'])
        ->setPosicao($aData['posicao'])
        ->setDesde(new DateTime($aData['desde']))
        ->setResolvidos($aData['resolvidos'])
        ->setTentados($aData['tentados'])
        ->setSubmissoes($aData['submetidos'])
        ->setInstituicao($aData['instituicao']);
    // $aListaAluno[] = $oAluno;

    $table = ""
        . "<tr> <td>Código</td>      <td id='codigo'>{$oAluno->getCodigo()}</td> </tr>"
        . "<tr> <td>Nome</td>        <td id='nome'>{$oAluno->getNome()}</td> </tr>"
        . "<tr> <td>Score</td>       <td id='score'>{$oAluno->getScore()}</td> </tr>"
        . "<tr> <td>Posicao</td>     <td id='posicao'>{$oAluno->getPosicao()}</td> </tr>"
        . "<tr> <td>Desde</td>       <td id='desde'>{$oAluno->getDesde()->format('d-m-Y')}</td> </tr>"
        . "<tr> <td>Resolvidos</td>  <td id='resolvidos'>{$oAluno->getResolvidos()}</td> </tr>"
        . "<tr> <td>Tentados</td>    <td id='tentados'>{$oAluno->getTentados()}</td> </tr>"
        . "<tr> <td>Submissoes</td>  <td id='submissoes'>{$oAluno->getSubmissoes()}</td> </tr>"
        . "<tr> <td>Instituicao</td> <td id='instituicao'>{$oAluno->getInstituicao()}</td> </tr>"
    ;
}

echo $table;

?> 