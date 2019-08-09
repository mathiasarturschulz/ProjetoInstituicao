<?php
    require_once "inc/Header.php";
    require_once('helpers/Conversor.php');
?>

<h2>&nbspBuscar Aluno Cadastrado</h2><br>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Nome do Aluno:</label>
        <input type="text" id="nomeParaBuscar" class="form-control">
        <button type="button" class="btn btn-sm btn-success pull-right" style="margin-top: 20px;" onClick="buscaDadosAlunoByName();"><i class='fa fa-check-circle'></i> Buscar Aluno</button>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-8">
    <label for="">Informações do Aluno:</label>
        <table class="table table-hover table-sm" id="tabela_aluno">
            <tbody id="table_aluno_by_nome_body">
            </tbody>
        </table>
    </div>
</div>

<?php
    require_once "inc/Footer.php";
?>