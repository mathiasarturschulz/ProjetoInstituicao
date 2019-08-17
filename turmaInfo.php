<?php
    require_once "inc/Header.php";
    // echo "<br>";

    $oTurmaDAO = new TurmaDAO();
    $oTurma = $oTurmaDAO->selectTurmaPorId($_GET['id'])[1];
?>

<h2>&nbspVisualizar Turma</h2><br>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Nome da Turma:</label>
        <input type="text" name="nome_turma" class="form-control" value="<?= $oTurma->getNome() ?>" readonly>
    </div>
</div>

<br><h5>&nbspAlunos Adicionados</h5>
<table id="tabela_lista_alunos" class="table">
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Score</th>
        <th>Posicao</th>
        <th>Desde</th>
        <th>Resolvidos</th>
        <th>Tentados</th>
        <th>Submissoes</th>
        <th>Instituicao</th>
    </thead>
    <tbody>
        <?php
        foreach ($oTurma->getListaAlunos() as $oAluno) {
            echo ""
                . "<tr>"
                    . "<td id='input_number'>{$oAluno->getCodigo()}</td>"
                    . "<td id='input_tabela'>{$oAluno->getNome()}</td>"
                    . "<td id='input_number'>{$oAluno->getScore()}</td>"
                    . "<td id='input_number'>{$oAluno->getPosicao()}</td>"
                    . "<td id='input_data'>{$oAluno->getDesde()->format('d-m-Y')}</td>"
                    . "<td id='input_number'>{$oAluno->getResolvidos()}</td>"
                    . "<td id='input_number'>{$oAluno->getTentados()}</td>"
                    . "<td id='input_number'>{$oAluno->getSubmissoes()}</td>"
                    . "<td id='input_number'>{$oAluno->getInstituicao()->getNome()}</td>"
                . "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
    echo($oTurma);

    require_once "inc/Footer.php";
?>