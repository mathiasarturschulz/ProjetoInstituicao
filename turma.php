<?php
    require_once "inc/Header.php";
?>

<br>
<div class="form-row">
    <h2 class="col-sm-10">&nbspTurmas Cadastradas</h2><br>
    <form action="cadastro.php" method="post" style="margin-top: 30px; margin-bottom: 5px;">
        <button class="btn btn-sm btn-primary"><i class='fa fa-plus-circle'></i> Adicionar</button>
    </form>
</div>
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
                                    <!-- EDITAR 
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $oTurma->getId() ?>">
                                        <button id="btn-editar" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i> Editar</button>
                                    </form>
                                    -->
                                    <form action="excluir_turma.php" method="post">
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

<?php
    require_once "inc/Footer.php";
?>