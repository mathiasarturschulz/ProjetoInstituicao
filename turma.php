<?php
    require_once "inc/Header.php";
?>

<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : "";
    $marca = isset($_POST['marca']) ? $_POST['marca'] : "";
    $nomeMotorista = isset($_POST['nomeMotorista']) ? $_POST['nomeMotorista'] : "";
} elseif (!isset($id)) {
    // GET
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
}
// CREATE OU UPDATE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
    $oCaminhaoDAO = new CaminhaoDAO();
    if (!$id) {
        // INSERIR
        $oCaminhao = (new Caminhao())
            ->setMarca($marca)
            ->setModelo($modelo)
            ->setNomeMotorista($nomeMotorista);
        $aResult = $oCaminhaoDAO->insert($oCaminhao);   
    } else {
        // UPDATE
        $oCaminhao = (new Caminhao())
            ->setID($id)
            ->setMarca($marca)
            ->setModelo($modelo)
            ->setNomeMotorista($nomeMotorista);
        $aResult = $oCaminhaoDAO->update($oCaminhao);   
    }
    if ($aResult[0]) {
        echo "<p class=\"bg-success\">" . $aResult[1] . "</p>";
        $id = $marca = $modelo = $nomeMotorista = null;
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}
// SETA OS VALORES NO FORMULÁRIO - UTILIZADO PARA UPDATE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $oCaminhaoDAO = new CaminhaoDAO();
    $aResult = $oCaminhaoDAO->select('id', CaminhaoDAO::TIPO_NUMERO, $id, CaminhaoDAO::OPERADOR_IGUAL);
    
    if ($aResult[0]) {
        $oCaminhao = $aResult[1][0];
        $id = $oCaminhao->getID();
        $marca = $oCaminhao->getMarca();
        $modelo = $oCaminhao->getModelo();
        $nomeMotorista = $oCaminhao->getNomeMotorista();
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}
// DELETE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $oCaminhaoDAO = new CaminhaoDAO();
    $aResult = $oCaminhaoDAO->delete($id);
    
    if ($aResult[0]) {
        echo "<p class=\"bg-success\">" . $aResult[1] . "</p>";
        $id = $marca = $modelo = $nomeMotorista = null;
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}*/
?>


<h2 class="col-sm-6">&nbspTurmas Cadastradas</h2><br>
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
                            <td id='tabela_acoes'><center>
                                <a href="?act=upd&id=<?php echo $oTurma->getId(); ?>" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i> Editar</a>
                                <a href="?act=del&id=<?php echo $oTurma->getId(); ?>" class="btn btn-sm btn-danger" ><i class='fa fa-trash'></i> Excluir</a>
                            </center></td>
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