<?php
    require_once "inc/Header.php";
    // echo "<br>";

    // BUSCAR A TURMA
    $oTurmaDAO = new TurmaDAO();
    $oTurma = $oTurmaDAO->selectTurmaPorId($_GET['id'])[1];

    // MONTAR AS LINHAS DA TABELA COM OS ALUNOS DA TURMA
    // MONTAR A LISTA DE NOMES E SCORES PARA UTILIZAÇÃO NOS GRÁFICOS
    $tableAlunos = "";
    $listaNomes = [];
    $listaScores = [];
    foreach ($oTurma->getListaAlunos() as $oAluno) {
        $nomeAluno = utf8_encode($oAluno->getNome());
        $tableAlunos .= "<tr><td id='input_number'>{$oAluno->getCodigo()}</td>"
            . "<td id='input_tabela'>{$nomeAluno}</td>"
            . "<td id='input_number'>{$oAluno->getScore()}</td>"
            . "<td id='input_number'>{$oAluno->getPosicao()}</td>"
            . "<td id='input_data'>{$oAluno->getDesde()->format('d-m-Y')}</td>"
            . "<td id='input_number'>{$oAluno->getResolvidos()}</td>"
            . "<td id='input_number'>{$oAluno->getTentados()}</td>"
            . "<td id='input_number'>{$oAluno->getSubmissoes()}</td>"
            . "<td id='input_number'>{$oAluno->getInstituicao()->getNome()}</td></tr>";
        $listaNomes[] = $nomeAluno;
        $listaScores[] = $oAluno->getScore();
    }

    // GRÁFICO DE BARRA
    $titulo = "Alunos da turma " . utf8_encode($oTurma->getNome()) . " por Score";
    $legenda = "Score";
    $nomeEixoX = "Aluno";
    $nomeEixoY = "Score";
    $oBarra = new Barra($titulo, $legenda, $nomeEixoX, $nomeEixoY, $listaNomes, $listaScores);
    echo $oBarra->gerarGrafico();
?>

<h2>&nbspVisualizar Turma</h2><br>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Nome da Turma:</label>
        <input type="text" name="nome_turma" class="form-control" value="<?= utf8_encode($oTurma->getNome()) ?>" readonly>
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
        <?= $tableAlunos ?>
    </tbody>
</table>

<br><h5>&nbspAluno por Score</h5>
<div id="grafico_barra"></div>

<?php
    require_once "inc/Footer.php";
?>