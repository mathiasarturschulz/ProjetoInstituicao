<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');
    echo "<br>";

    $oInstituicaoDAO = new InstituicaoDAO();
    $aInstituicoes = $oInstituicaoDAO->selectAll()[1];


    // BUSCA OS SCORES E MONTA OS ARRAYS PARA UTILIZAÇÃO NOS GRÁFICOS
    $aScores = $oInstituicaoDAO->selectByInstitutionScoreAverageDesc()[1];
    $listaNomes = [];
    $listaScores = [];
    foreach ($aScores as $aScoreAtual) {
        $listaNomes[] = $aScoreAtual['instNome'];
        $listaScores[] = $aScoreAtual['sumScore'];
    }

    // GRÁFICOS
    $titulo = "Melhores Instituições por Score (Média de Alunos)";
    // GRÁFICO DE BARRA
    $legenda = "Score";
    $nomeEixoX = "Instituição";
    $nomeEixoY = "Score";
    $oBarra = new Barra($titulo, $legenda, $nomeEixoX, $nomeEixoY, $listaNomes, $listaScores);
    echo $oBarra->gerarGrafico();
    // GRÁFICO DE PIZZA
    $oPizza = new Pizza($titulo, $listaNomes, $listaScores);
    echo $oPizza->gerarGrafico();

    // MONTA A LISTA DE INSTITUICOES
    $tableInstituicoes = "";
    if (empty($aInstituicoes)) {
        $tableInstituicoes = 'Nenhuma instituição cadastrada';
    } else {
        foreach ($aInstituicoes as $chave => $oInstituicao) {
            $tableInstituicoes .= ""
                . "<tr> <td>{$oInstituicao->getId()}</td> <td id='tabela_id'>{$oInstituicao->getNome()}</td> </tr>"
            ;
        }
    }
?>

<h2>&nbspVisualizar Instituições Cadastradas</h2><br>

<div class="form-row">
    <div class="form-group col-md-4">
        <h5>Lista de Instituições</h5>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th id='tabela_id_instituicao'>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?= $tableInstituicoes ?>
            </tbody>
        </table>
    </div>
    <div class="form-group col-md-8">
        <h5>Melhores Instituições</h5>
        <div id="grafico_barra"></div>
        <div id="grafico_pizza" style="width: 700px; height: 500px;"></div>
    </div>
</div>

<?php
    require_once "inc/Footer.php";
?>