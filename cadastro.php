<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');
?>

<?php
$aListaAluno = null;

// VISUALIZAR INFORMAÇÕES DE UM ALUNO
if (isset($_REQUEST["act"]) && $_REQUEST["act"] === "info" && isset($_POST['codigo'])) {

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
        $aListaAluno[] = $oAluno;

        $table = ""
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
}
?>

<div class="container">
    <h2>&nbspCadastro de Turma</h2><br>

    <form action="?act=info" method="POST" class="form-horizontal">
        <h5>&nbspAluno</h5>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="">Código</label>
                <input type="number" name="codigo" class="form-control" value="<?= isset($_POST['codigo']) ? $_POST['codigo'] : "" ?>" required>
            </div>
            <button type="submit" class="btn btn-sm btn-success" style="height: 35px; margin-top: 33px;"><i class='fa fa-check-circle'></i> Okay</button>
        </div>
    </form>

    <div style="width: 50%;">
        <table class="table table-hover" id="tabela_aluno">
            <thead>
                <tr>
                    <th>Dados do Aluno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?= isset($table) ? $table : "" ?>
            </tbody>
        </table>
        <div class="pull-right">
            <button type="button" id="btn_adicionar_linha" class="btn btn-sm btn-primary" style="height: 35px; margin-top: 33px;"><i class='fa fa-plus-circle'></i> Adicionar</button>
        </div>
    </div>

    <table id="tabela_lista_alunos" class="table">
        <thead>
            <th>Nome</th>
            <th>Score</th>
            <th>Posicao</th>
            <th>Desde</th>
            <th>Resolvidos</th>
            <th>Tentados</th>
            <th>Submissoes</th>
            <th>Instituicao</th>
            <th>Ações</th>
        </thead>
        <tbody>
        </tbody>
    </table>



</div>

<?php
    require_once "inc/Footer.php";
?>