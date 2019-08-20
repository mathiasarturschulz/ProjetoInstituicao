<?php
    require_once "inc/Header.php";
    require_once "autoload.php";
?>


<?php

    if(isset($_POST['att'])){
        
        // pegar todos os codigos dos alunos

        // para cada codigo encontrado, buscar o aluno novamente, montar o objeto aluno e atualizar a tabela de alunos
        
        $oAlunoDAO = new AlunoDAO();

        $aResult = $oAlunoDAO->selectAll();
        $codigos = [];
        if($aResult[0]){
            foreach($aResult[1] as $oAluno){
                $codigos[] = intval($oAluno->getCodigo());
            }
        }

        foreach($codigos as $alunoCod){
            $alunoJson = Conversor::getDadosAlunoJSONComOID($alunoCod);
            $alunoJson = json_decode($alunoJson, true);

            $al = (new Aluno())
                    ->setCodigo($alunoJson['codigo'])
                    ->setNome($alunoJson['nome'])
                    ->setScore($alunoJson['score'])
                    ->setPosicao($alunoJson['posicao'])
                    ->setResolvidos($alunoJson['resolvidos'])
                    ->setTentados($alunoJson['tentados'])
                    ->setSubmissoes($alunoJson['submetidos'])
                ;
            echo $al->getCodigo() . ' -- ' . $al->getNome(); echo '<br><br>';
            $oAlunoDAO->updateAtt($al);
        }



    }


?>

<br>
<div class="form-row">
    <h2 class="col-sm-10">&nbspTurmas Cadastradas</h2><br>
    <form action="cadastro.php" method="post" style="margin-top: 30px; margin-bottom: 5px;">
        <button class="btn btn-sm btn-primary"><i class='fa fa-plus-circle'></i> Adicionar</button>
    </form>
    <form method="post" style="margin: 30px 5px">
        <input type="submit" name="att" class="btn btn-sm btn-primary" value="Atualizar">
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
                    ?><tr id="click" onClick="window.location='turmaInfo.php?id=<?php echo $oTurma->getId(); ?>'">
                            <td id='tabela_id'><?php echo $oTurma->getId(); ?></td>
                            <td><?php echo utf8_encode($oTurma->getNome()); ?></td>
                            <td id='tabela_acoes'>
                                <div class="form-row">
                                    <button class="btn btn-sm btn-success" onClick="window.location='turmaInfo.php?id=<?php echo $oTurma->getId(); ?>'" style="margin-right: 7px;"><i class='fa fa-eye'></i> Visualizar</button>
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