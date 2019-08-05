<?php
    require_once "inc/Header.php";
?>

<?php

$aListaAlunos = [];

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
        $aListaAlunos[] = $oAluno;

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
                <input type="number" name="codigo" class="form-control" value="<?= isset($_POST['codigo']) ? $_POST['codigo'] : "" ?>" required>
            </div>
            <button type="submit" class="btn btn-sm btn-success" style="height: 35px; margin-top: 33px;"><i class='fa fa-check-circle'></i> Okay</button>
        </div>
    </form>

    <div style="width: 50%;">
        <table class="table table-hover">
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
            <button type="submit" class="btn btn-sm btn-primary" style="height: 35px; margin-top: 33px;"><i class='fa fa-plus-circle'></i> Adicionar</button>
        </div>
    </div>
    


    <h5 style="margin-top: 100px;">&nbspLista de Alunos</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // CRIAÇÃO DA TABELA
                $oTurmaDAO = new TurmaDAO();
                $aResult = $oTurmaDAO->selectAllSemAlunos();
                
                if ($aResult[0]) {
                    foreach ($aResult[1] as $chave => $oTurma) {
                        ?><tr>
                                <td id='tabela_id'><?php echo $oTurma->getId(); ?></td>
                                <td><?php echo utf8_encode($oTurma->getNome()); ?></td>
                                <td id='tabela_acoes'>
                                    <div class="form-row">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?= $oTurma->getId() ?>">
                                            <button id="btn-editar" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i> Editar</button>
                                        </form>
                                        <form action="excluir.php" method="post">
                                            <input type="hidden" name="id" value="<?= $oTurma->getId() ?>">
                                            <button class="btn btn-sm btn-danger"><i class='fa fa-trash'></i> Excluir</button>
                                        </form>
                                    </div>
                                </td>
                        </tr><?php
                    }
                } else {
                    echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    require_once "inc/Footer.php";
?>