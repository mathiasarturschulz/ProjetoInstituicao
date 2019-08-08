<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');
?>

<h2>&nbspCadastro de Turma</h2><br>

<form action="cadastro_turma.php" method="POST" class="form-horizontal">

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
            <button type="button" class="btn btn-sm btn-success pull-right" style="margin-top: 20px;" onClick="buscaDadosAluno();"><i class='fa fa-check-circle'></i> Buscar Aluno</button>
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