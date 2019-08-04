<?php
    require_once "inc/Header.php";
?>

<?php

$table = "";

// VISUALIZAR INFORMAÇÕES DE UM ALUNO
if (isset($_REQUEST["act"]) && $_REQUEST["act"] === "info" && isset($_POST['codigo'])) {
    require_once('helpers/Conversor.php');

    $json_data = Conversor::getDadosAlunoJSONComOID($_POST['codigo']);
    $aData =  json_decode($json_data, true);
    if ($aData) {
        $oAluno = (new Aluno())
            ->setCodigo($_POST['codigo'])
            ->setNome($aData['nome'])
            ->setScore($aData['score'])
            ->setPosicao($aData['posicao'])
            ->setDesde(new DateTime($aData['desde']))
            ->setResolvidos($aData['resolvidos'])
            ->setTentados($aData['tentados'])
            ->setSubmissoes($aData['submetidos'])
            ->setInstituicao($aData['instituicao']);

        $table = ""
            . "<tr><td>Nome</td><td>{$oAluno->getNome()}</td></tr>"
            . "<tr><td>Score</td><td>{$oAluno->getScore()}</td></tr>"
            . "<tr><td>Posicao</td><td>{$oAluno->getPosicao()}</td></tr>"
            . "<tr><td>Desde</td><td>{$oAluno->getDesde()->format('d-m-Y')}</td></tr>"
            . "<tr><td>Resolvidos</td><td>{$oAluno->getResolvidos()}</td></tr>"
            . "<tr><td>Tentados</td><td>{$oAluno->getTentados()}</td></tr>"
            . "<tr><td>Submissoes</td><td>{$oAluno->getSubmissoes()}</td></tr>"
            . "<tr><td>Instituicao</td><td>{$oAluno->getInstituicao()}</td></tr>"
        ;

    }
}

?>

<div class="container">
    <h2>&nbspCadastro de Turma</h2><br>

    <form action="?act=info" method="POST" class="form-horizontal">
        <h5>&nbspAluno</h5>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="">Código</label>
                <input type="number" name="codigo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary" style="height: 35px; margin-top: 33px;"><i class='fa fa-plus-circle'></i> Okay</button>
        </div>
    </form>

    <div class="form-group col-md-6">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dados do Aluno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?= $table ? $table : "" ?>
            </tbody>
        </table>
    </div>


</div>

<?php
    require_once "inc/Footer.php";
?>