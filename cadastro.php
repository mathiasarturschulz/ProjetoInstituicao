<?php
    require_once "inc/Header.php";
    require_once "autoload.php";
    echo "<br>";
?>

<?php
// CARREGA OS CAMINHOES
$oCaminhaoDAO = new CaminhaoDAO();
$aCaminhoes = $oCaminhaoDAO->getListaDeCaminhoes();
$sInfoCaminhoes = generateStringInfoCaminhoes($aCaminhoes);
// CARREGA OS PRODUTOS
$oProdutoDAO = new ProdutoDAO();
$aProdutos = $oProdutoDAO->getListaDeProdutos();
$sInfoProdutos = generateStringInfoProdutos($aProdutos);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $cepOrigem = isset($_POST['cepOrigem']) ? $_POST['cepOrigem'] : "";
    $cepDestino = isset($_POST['cepDestino']) ? $_POST['cepDestino'] : "";
    $dataSaida = isset($_POST['dataSaida']) ? $_POST['dataSaida'] : "";
    $dataChegada = isset($_POST['dataChegada']) ? $_POST['dataChegada'] : "";
    $caminhao = isset($_POST['selectCaminhao']) ? $_POST['selectCaminhao'] : "";
    $arrayIdProdutos = isset($_POST['selectProdutos']) ? $_POST['selectProdutos'] : [];
    $arrayQtdItemProdutos = isset($_POST['arrayQtdItemProdutos']) ? $_POST['arrayQtdItemProdutos'] : [];
} elseif (!isset($id)) {
    // GET
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
}
// CREATE OU UPDATE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
    $oCargaDAO = new CargaDAO();
    $oCaminhaoDAO = new CaminhaoDAO();
    $oCaminhao = $oCaminhaoDAO->select('id', CaminhaoDAO::TIPO_NUMERO, $caminhao, CaminhaoDAO::OPERADOR_IGUAL)[1][0];
    $aItemProdutos = [];
    foreach ($arrayIdProdutos as $chave => $iIdProduto) {
        $oProdutoDAO = new ProdutoDAO();
        $oProduto = $oProdutoDAO->select('id', ProdutoDAO::TIPO_NUMERO, $iIdProduto, ProdutoDAO::OPERADOR_IGUAL)[1][0];
        $qtd = intval($arrayQtdItemProdutos[$chave]) ? intval($arrayQtdItemProdutos[$chave]) : 1;
        $aItemProdutos[] = (new ItemProduto())->setProduto($oProduto)->setQuantidadeProduto($qtd);
    }
    if (!$id) {
        // INSERIR
        $oCarga = (new Carga())
            ->setCepOrigem($cepOrigem)
            ->setCepDestino($cepDestino)
            ->setDataSaida($dataSaida)
            ->setDataChegada($dataChegada)
            ->setCaminhao($oCaminhao)
            ->setListaItemProduto($aItemProdutos);
        $aResult = $oCargaDAO->insert($oCarga);
    } else {
        // UPDATE
        $oCarga = (new Carga())
            ->setID($id)
            ->setCepOrigem($cepOrigem)
            ->setCepDestino($cepDestino)
            ->setDataSaida($dataSaida)
            ->setDataChegada($dataChegada)
            ->setCaminhao($oCaminhao)
            ->setListaItemProduto($aItemProdutos);
        $aResult = $oCargaDAO->update($oCarga);   
    }
    if ($aResult[0]) {
        echo "<p class=\"bg-success\">" . $aResult[1] . "</p>";
        $id = $cepOrigem = $cepDestino = $dataSaida = $dataChegada = $caminhao = $arrayIdProdutos = null;
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}
// SETA OS VALORES NO FORMULÁRIO - UTILIZADO PARA UPDATE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $oCargaDAO = new CargaDAO();
    $aResult = $oCargaDAO->select('id', CargaDAO::TIPO_NUMERO, $id, CargaDAO::OPERADOR_IGUAL);
    
    if ($aResult[0]) {
        $oCarga = $aResult[1][0];
        $id = $oCarga->getID();
        $cepOrigem = $oCarga->getCepOrigem();
        $cepDestino = $oCarga->getCepDestino();
        $dataSaida = $oCarga->getDataSaida();
        $dataChegada = $oCarga->getDataChegada();
        
        $aCaminhoes = $oCaminhaoDAO->getListaDeCaminhoes();
        $sInfoCaminhoes = generateStringInfoCaminhoes($aCaminhoes, $oCarga->getCaminhao()->getID());
        
        $arrayItemProduto = $oCarga->getListaItemProduto();
        $aIDsItemProduto = [];
        foreach ($arrayItemProduto as $oItemProduto) {
            $aIDsItemProduto[] = $oItemProduto->getID();
            // $aIDsItemProduto[] = $oItemProduto->getProduto()->getID();
        }
        $sInfoProdutos = generateStringInfoProdutos($aProdutos, $aIDsItemProduto);
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}
// DELETE
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $oCargaDAO = new CargaDAO();
    $aResult = $oCargaDAO->delete($id);
    
    if ($aResult[0]) {
        echo "<p class=\"bg-success\">" . $aResult[1] . "</p>";
        $id = $cepOrigem = $cepDestino = $dataSaida = $dataChegada = $caminhao = $arrayIdProdutos = null;
    } else {
        echo "<p class=\"bg-danger\">" . $aResult[1] . "</p>";
    }
}
// CRIAÇÃO DA LISTA DE CAMINHOES
function generateStringInfoCaminhoes($aCaminhoes, $idCaminhaoSelecionado = null)
{
    $sSelected = "";
    $sInfo = "<option value=\"\" disabled selected>Nenhum caminhão encontrado </option>";
    if ($aCaminhoes) {
        if (!$idCaminhaoSelecionado) {
            $sSelected = "selected";
        }
        $sInfo = "<option value=\"\" disabled {$sSelected}>Escolha um Caminhão</option>";
        foreach ($aCaminhoes as $oCaminhao) {
            $sSelected = "";
            if ($idCaminhaoSelecionado == $oCaminhao->getId()) {
                $sSelected = "selected";
            }
            $sInfo .= ""
                . "<option value=\"" . $oCaminhao->getId() . "\" {$sSelected}>"
                . ($oCaminhao->getId() . " - "
                . $oCaminhao->getModelo() . " - " 
                . $oCaminhao->getMarca() . " - " 
                . $oCaminhao->getNomeMotorista()) . "</option>";
        }
    }
    return $sInfo;
}
// CRIAÇÃO DA LISTA DE PRODUTOS
function generateStringInfoProdutos($aProdutos, $aIdsSelecionados = [])
{
    $sSelected = "";
    $sInfo = "<option value=\"\" disabled selected>Nenhum produto encontrado </option>";
    if ($aProdutos) {
        $sInfo = "";
        foreach ($aProdutos as $oProduto) {
            $sSelected = "";
            if (in_array($oProduto->getID(), $aIdsSelecionados)) {
                $sSelected = "selected";
            }
            $sInfo .= ""
                . "<option value=\"" . $oProduto->getId() . "\" {$sSelected}>"
                . ($oProduto->getId() . " - " . $oProduto->getNome() . " - " . $oProduto->getDescricao()) . "</option>";
        }
    }
    return $sInfo;
}
?>


<div class="container">
    <h2 class="col-sm-6">Cargas</h2><br>

    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">CEP Origem</label>
                <input type="text" name="cepOrigem" id="cepOrigem" value="<?= isset($cepOrigem) ? $cepOrigem : "" ?>" class="form-control" placeholder="00000-000" required>
            </div>
            <div class="form-group col-md-6">
                <label for="">CEP Destino</label>
                <input type="text" name="cepDestino" id="cepDestino" value="<?= isset($cepDestino) ? $cepDestino : "" ?>" class="form-control" placeholder="00000-000" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="">Data Saída</label>
                <input type="date" name="dataSaida" value="<?= isset($dataSaida) ? $dataSaida : "" ?>" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
                <label for="">Data Chegada</label>
                <input type="date" name="dataChegada" value="<?= isset($dataChegada) ? $dataChegada : "" ?>" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">Caminhão </label>
                <select class="browser-default custom-select" name="selectCaminhao" required>
                    <?= $sInfoCaminhoes?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="">Produtos </label>
                <select id="select_produtos" class="browser-default custom-select" name="selectProdutos[]" onchange="generateTableQtdProdutos();" required multiple >
                    <?= $sInfoProdutos?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="">ID&nbsp&nbsp&nbsp&nbspQTD</label>
                <table id="tableItemProduto"> <!-- class="table table-hover"> -->
                </table>
            </div>
        </div>
        <div class="pull-right">
            <button type="submit" class="btn btn-outline-primary"><span class="glyphicon glyphicon-ok"></span>Confirmar</button>
        </div>

        <script type="text/javascript">
            $('#cepOrigem').mask('00000-000');
            $('#cepDestino').mask('00000-000');
        </script>
        
    </form>
</div><br><br><br><br>


<h2 class="col-sm-6">&nbspCargas Cadastrados</h2><br>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>CEP Origem</th>
            <th>CEP Destino</th>
            <th>Data Chegada</th>
            <th>Data Saída</th>
            <th>Caminhão</th>
            <th>Lista de Produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // CRIAÇÃO DA TABELA
            $oCargaDAO = new CargaDAO();
            $aResult = $oCargaDAO->selectAll();
            
            if ($aResult[0]) {
                foreach ($aResult[1] as $chave => $oCarga) {
                    ?><tr>
                            <td id='tabela_id'><?php echo $oCarga->getID(); ?></td>
                            <td id='tabela_cep'><?php echo $oCarga->getCepOrigem(); ?></td>
                            <td id='tabela_cep'><?php echo $oCarga->getCepDestino(); ?></td>
                            <td id='tabela_data'><?php echo date('d-m-Y', strtotime($oCarga->getDataChegada())); ?></td>
                            <td id='tabela_data'><?php echo date('d-m-Y', strtotime($oCarga->getDataSaida())); ?></td>
                            <td><?php echo $oCarga->getCaminhao()->getID() . " - " . $oCarga->getCaminhao()->getMarca() . " - " . $oCarga->getCaminhao()->getModelo(); ?></td>
                            <td><?php 
                                foreach ($oCarga->getListaItemProduto() as $oItemProduto) {
                                    echo $oItemProduto->getProduto()->getID() . " - "
                                        . $oItemProduto->getProduto()->getNome() . " - "
                                        . "QTD: " . $oItemProduto->getQuantidadeProduto()
                                        . "<br>";
                                } 
                            ?></td>
                            <td id='tabela_acoes'><center>
                                <a href="?act=upd&id=<?php echo $oCarga->getID(); ?>" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i> Editar</a>
                                <a href="?act=del&id=<?php echo $oCarga->getID(); ?>" class="btn btn-sm btn-danger" ><i class='fa fa-trash'></i> Excluir</a>
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