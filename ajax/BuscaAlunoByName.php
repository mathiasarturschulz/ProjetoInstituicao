<?php 

require_once('../helpers/Conversor.php');
require_once('../classes/Aluno.class.php');
require_once('../classes/Instituicao.class.php');
require_once('../classesDAO/AlunoDAO.class.php');
require_once('../conexao/Conexao.class.php');

/**
 * Readers para não utilizar o cache do browser
 */
$gmtDate = gmdate("D, d M Y H:i:s"); 
header("Expires: {$gmtDate} GMT"); 
header("Last-Modified: {$gmtDate} GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 

// NOME DO ALUNO PASSADO PELO GET
$nomeAluno = $_GET["n"];

// REALIZA A BUSCA DOS DADOS DO ALUNO
$oAlunoDAO = new AlunoDAO();
$aAluno = $oAlunoDAO->select('nome', AlunoDAO::TIPO_STRING, $nomeAluno)[1];

if (empty($aAluno)) {
    echo "Nenhum aluno encontrado!";
}else {
    $oAluno = $aAluno[0];

    if ($oAluno->getInstituicao() == "") {
        $instituicao = "";
    } else {
        $instituicao = $oAluno->getInstituicao()->getNome();
    }

    $table = "";
    if ($oAluno) {
        $table = ""
            . "<tr> <td>Código</td>      <td id='codigo'>{$oAluno->getCodigo()}</td> </tr>"
            . "<tr> <td>Nome</td>        <td id='nome'>{$oAluno->getNome()}</td> </tr>"
            . "<tr> <td>Score</td>       <td id='score'>{$oAluno->getScore()}</td> </tr>"
            . "<tr> <td>Posicao</td>     <td id='posicao'>{$oAluno->getPosicao()}</td> </tr>"
            . "<tr> <td>Desde</td>       <td id='desde'>{$oAluno->getDesde()->format('d/m/Y')}</td> </tr>"
            . "<tr> <td>Resolvidos</td>  <td id='resolvidos'>{$oAluno->getResolvidos()}</td> </tr>"
            . "<tr> <td>Tentados</td>    <td id='tentados'>{$oAluno->getTentados()}</td> </tr>"
            . "<tr> <td>Submissoes</td>  <td id='submissoes'>{$oAluno->getSubmissoes()}</td> </tr>"
            . "<tr> <td>Instituicao</td> <td id='instituicao'>{$instituicao}</td> </tr>"
        ;
    }
    
    // RETORNA O RESULTADO PARA O AJAX
    echo $table;
}

?> 