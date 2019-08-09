<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');

    $oInstituicaoDAO = new InstituicaoDAO();
    $aInstituicoes = $oInstituicaoDAO->selectAll()[1];

    $table = "";
    $table_average = "";
    $table_average_score = "";
    if (empty($aInstituicoes)) {
        $table = 'Nenhuma instituição cadastrada';
    } else {
        foreach ($aInstituicoes as $chave => $oInstituicao) {
            $table .= ""
                . "<tr> <td>{$oInstituicao->getId()}</td> <td id='tabela_id'>{$oInstituicao->getNome()}</td> </tr>"
            ;
        }
    }
?>

<h2>&nbspVisualizar Instituições Cadastradas</h2><br>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="">Lista de Instituições</label>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th id='tabela_id_instituicao'>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?= $table ?>
            </tbody>
        </table>
    </div>
    <div class="form-group col-md-8">
        <label for="">Melhores Instituições por Score (Média de alunos)</label>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th id='tabela_id_instituicao'>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?= $table_average_score ?>
            </tbody>
        </table>

        <label for="">Melhores Instituições por Score</label>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th id='tabela_id_instituicao'>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?= $table_average ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once "inc/Footer.php";
?>