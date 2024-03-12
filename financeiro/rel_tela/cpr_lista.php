<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Cadastro de Contas a Receber';
    include __DIR__."/../../sgbd/acesso.php";
    if (!isset($_GET['tipo']) && (isset($_POST['tipocpr']))) $_GET['tipo'] = $_POST['tipocpr'];
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formcpr_lista" aria-controls="formcpr_lista">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'cpr_lista')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="GerarPDF('Lista CPR','cpcMain')">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-regular fa-file-pdf me-sm-1"></i><div class="cpc-nomobile">PDF</div></div>
            </button>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form id="formcpr_lista" name="formcpr_lista" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="cpr_lista">
    <input type="hidden" name="tipocpr" value="<? echo $_GET['tipo'] ?>">    
    <input type="hidden" name="campomarcado" id="campomarcado">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <label for="data-ini" class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-ini" id="data-ini" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 30  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label for="data-fim" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-fim" id="data-fim" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' + 5  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="row m-2" role="group">
            <label for="documento_filtro" class="form-label">Documento</label>
            <select class="form-select cpcsave" name="documento" id="documento_filtro">
                <option value="">Todos</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
            </select>
        </div>
        <div class="row m-2" role="group">
            <label for="databaixa_filtro" class="form-label">Baixa</label>
            <select class="form-select cpcsave" name="databaixa" id="databaixa_filtro">
                <option value="">Todos</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
            </select>
        </div>
        <div class="col-sm-12" role="group">
            <label for="clifor_filtro" class="form-label">Cliente/Fornec</label>
            <select class="form-select cpcsave" name="clifor" id="clifor_filtro" >
            <option></option>
            <? if ($_GET['tipo'] == 'R') $_SESSION['listagem'] = 'etq_cliente'; else $_SESSION['listagem'] = 'etq_fornecedor'; include __DIR__."\..\..\listagem.php" ?>
            </select>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="cpr_lista" onclick="sqlitem($('#formcpr_lista'),'financeiro/rel_tela/cpr_lista','cpc-listagem');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="cpr_lista" class="container table table-hover table-sm tablereport" style="min-width:1024px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th>CPR</th>
                <th>Cli/For</th>
                <th>Descrição</th>
                <th>CNPJ</th>
                <th>E-mail</th>
                <th>Documento</th>
                <th>Vencimento</th>
                <th>Data Baixa</th>
                <th class="text-end">Valor</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['databaixa']))) $_POST['databaixa'] ='N';
                if (!(isset($_POST['documento']))) $_POST['documento'] ='';
                if (!(isset($_POST['clifor']))) $_POST['clifor'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y"). ' + 30  days'));
                $sql = "SELECT Cpr1.NUMEROCPR, Cpr1.DOCUMENTO, Cpr1.CLIFOR, Cpr2.VENCIMENTO, Cpr2.PARCELA, CPR2.DATABAIXA, Cpr1.TIPO, cpr1.vencimento, CPR1.OK, CPR1.HISTORICO, CADASTRO.NOME, CADASTRO.EMAIL, CADASTRO.CGC  ".
                       "FROM CPR1 INNER JOIN CPR2 ON (CPR2.NUMEROCPR = CPR1.NUMEROCPR) LEFT JOIN CADASTRO ON (CADASTRO.FORNECEDOR = CPR1.CLIFOR) WHERE CPR2.VENCIMENTO BETWEEN '".str_replace('/','.',$_POST['data-ini'])."' and '".str_replace('/','.',$_POST['data-fim'])."' and cpr1.tipo ='".$_GET['tipo']."'";
                if ($_POST['documento'] == 'S') $sql .=" and cpr1.documento <> '' ";
                if ($_POST['documento'] == 'N') $sql .=" and (cpr1.documento is null or cpr1.documento = '') ";
                if ($_POST['databaixa'] == 'S') $sql .=" and cpr2.databaixa is not null ";
                if ($_POST['databaixa'] == 'N') $sql .=" and (cpr2.databaixa is null) ";
                if ($_POST['clifor'] != '') $sql .=" and (cpr1.clifor =".$_POST['clifor'].") ";
                                     $sql .= "order by cpr2.vencimento, cadastro.nome";
                $total = 0;
                $cont = 0;
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
            <td><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['NUMEROCPR'] ?>,'cpcMain','financeiro/cpr.php?indice=');"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="ir para o Tí­tulo"><?php echo $row['NUMEROCPR'] ?></div></td>
            <td><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['CLIFOR'] ?>,'telapopup','estoque/cadastro.php?indice=');"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="ir para o Cli/Fornec"><?php echo $row['CLIFOR'] ?></div></td>
                <td><? echo $row['NOME'] ?></td>
                <td><? echo $row['CGC'] ?></td>
                <td><? echo $row['EMAIL'] ?></td>
                <td><? echo $row['DOCUMENTO'] ?></td>
                <td><? echo date('d/m/Y', strtotime($row['VENCIMENTO'])) ?></td>
                <? if (isset($row['DATABAIXA'])) { ?>
                <td ><? echo date('d/m/Y', strtotime($row['DATABAIXA'])); ?></td>
                <? } else { ?>
                <td class="text-center"><? if ($_GET['tipo'] === 'R') { ?><i class="btn btn-outline-primary fa-solid fa-barcode" onclick="window.open('financeiro/boleto.php?tipo=<? echo $row['NUMEROCPR']?>', '_blank');"></i><? } ?></td>
                <? } ?>
                <td class="text-end"><? if ($row['PARCELA']) { $total += $row['PARCELA']; echo number_format($row['PARCELA'], 2,',','.'); } ?></td>
            </tr>
            <? } ?>
            <tr class="fw-bold fs-7 gs-0">
                <td class="text-end" colspan="3">Total</td>
                <td class="text-end"><? echo number_format($total, 2,',','.'); $total = 0; ?></td>
            </tr>
        </tbody>
    </table>
</div>