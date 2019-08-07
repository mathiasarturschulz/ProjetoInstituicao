<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');
?>

<?php
// $aListaAluno = null;

// VISUALIZAR INFORMAÇÕES DE UM ALUNO
// if (isset($_REQUEST["act"]) && $_REQUEST["act"] === "info" && isset($_POST['codigo'])) {

//     $json_data = Conversor::getDadosAlunoJSONComOID($_POST['codigo']);
//     $aData =  json_decode($json_data, true);
//     if ($aData) {
//         $oAluno = (new Aluno())
//             ->setCodigo($_POST['codigo'])
//             ->setNome($aData['nome'])
//             ->setScore($aData['score'])
//             ->setPosicao($aData['posicao'])
//             ->setDesde(new DateTime($aData['desde']))
//             ->setResolvidos($aData['resolvidos'])
//             ->setTentados($aData['tentados'])
//             ->setSubmissoes($aData['submetidos'])
//             ->setInstituicao($aData['instituicao']);
//         $aListaAluno[] = $oAluno;

//         $table = ""
//             . "<tr> <td>Código</td>      <td id='codigo'>{$oAluno->getCodigo()}</td> </tr>"
//             . "<tr> <td>Nome</td>        <td id='nome'>{$oAluno->getNome()}</td> </tr>"
//             . "<tr> <td>Score</td>       <td id='score'>{$oAluno->getScore()}</td> </tr>"
//             . "<tr> <td>Posicao</td>     <td id='posicao'>{$oAluno->getPosicao()}</td> </tr>"
//             . "<tr> <td>Desde</td>       <td id='desde'>{$oAluno->getDesde()->format('d-m-Y')}</td> </tr>"
//             . "<tr> <td>Resolvidos</td>  <td id='resolvidos'>{$oAluno->getResolvidos()}</td> </tr>"
//             . "<tr> <td>Tentados</td>    <td id='tentados'>{$oAluno->getTentados()}</td> </tr>"
//             . "<tr> <td>Submissoes</td>  <td id='submissoes'>{$oAluno->getSubmissoes()}</td> </tr>"
//             . "<tr> <td>Instituicao</td> <td id='instituicao'>{$oAluno->getInstituicao()}</td> </tr>"
//         ;
//     }
// }
?>

<h2>&nbspCadastro de Turma</h2><br>

<!--<form action="?act=info" method="POST" class="form-horizontal">
    <h5>&nbspAluno</h5>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="">Código</label>
            <input type="number" name="codigo" class="form-control" value="" required>
        </div>
        <button type="submit" class="btn btn-sm btn-success" style="height: 35px; margin-top: 33px;"><i class='fa fa-check-circle'></i> Okay</button>
    </div>
</form>-->

<form action="cadastro_aluno.php" method="POST" class="form-horizontal">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">Nome da Turma:</label>
            <input type="text" name="nome_turma" class="form-control" value="" required>
        </div>
    </div>

    <h5>&nbspAluno</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">Código:</label>
            <input type="number" id="codigoParaBuscar" class="form-control">
            <button type="button" class="btn btn-sm btn-success pull-right" style="margin-top: 20px;" onClick="insereAluno();"><i class='fa fa-check-circle'></i> Buscar Aluno</button>
        </div>

        <div class="form-group col-md-6">
        <label for="">Informações do Aluno:</label>
            <table class="table table-hover table-sm" id="tabela_aluno">
                <tbody id="table_aluno_body">
                </tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary pull-right" style="" onclick="adicionarLinhaTabela()"><i class='fa fa-plus-circle'></i> Adicionar Aluno</button>
        </div>
    </div>

    <br><h5>&nbspAlunos Adicionados</h5>
    <table id="tabela_lista_alunos" class="table">
        <thead>
            <th>Código</th>
            <th id="tabela_nome">Nome</th>
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

    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class='fa fa-plus-circle'></i> Adicionar Turma</button>

</form>


<?php
    require_once "inc/Footer.php";
?>