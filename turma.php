<?php
    require_once "inc/Header.php";
    require_once "autoload.php";
?>


<?php
$att=0;
    if(isset($_POST['att'])){
        
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
                $oAlunoDAO->updateAtt($al);
                $att=1;
        }
        
    }
    


?>

<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
<style type="text/css">
        #imgpos {
            width: 75px;
            height: 75px;
            position:absolute;
            top:50%;
            left:50%;
            margin-top:255px;
            margin-left:-50px;
        }   
        .msg{
            position:absolute;
            top:50%;
            left:50%;
            color: #FFFFFF;
            margin-top:190px;
            margin-left:-175px;
        }
    </style>
<br>
<div class="form-row">
    <h2 class="col-sm-10">&nbspTurmas Cadastradas</h2><br>
    <form action="cadastro.php" method="post" style="margin-top: 30px; margin-bottom: 5px;">
        <button class="btn btn-sm btn-primary"><i class='fa fa-plus-circle'></i> Adicionar</button>
    </form>
    <form method="post" style="margin: 30px 5px">
        <input type="submit" name="att" class="btn btn-sm btn-primary" value="Atualizar" data-toggle="modal" data-target="#att_Modal">
    </form>
</div>

<?php 
        if ($GLOBALS['att']==1) {?>
            <script type="text/javascript">
                $('#att_Modal').modal('hide')
            </script>  
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Atualização terminada!</strong> Todas as informações atualizadas.
            </div>
<?php }?>
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
<!-- Modal loading-->
<div class="modal fade" id="att_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">			 
    <div class="modal-body">
        <center>
            <h2 class="msg">Atualizando os dados</h2>
            <div class="load"><img src="img/loading-1.gif" id="imgpos"></div>
        </center> 
    </div>
</div>
<?php
    require_once "inc/Footer.php";
?>