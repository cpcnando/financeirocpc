<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../sgbd/almoxa.php";
    include __DIR__."/../../funcoes.php";
    $tipocpr = '';
    $tipocpr = buscaconfigusuario('SomenteCPR');
    $_SESSION['ACESSO'] = 'Fluxo de Caixa';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formfluxocaixa" aria-controls="formfluxocaixa">
            <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'fluxodecaixa')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<div id="divfiltrolabel" class="text-end"><? echo mb_convert_encoding(($_POST['filtrolabel'] ?? ''), 'ISO-8859-1', 'UTF-8') ?></div>
<form action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" id="formfluxocaixa" name="formfluxocaixa" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="baixa">
    <input type="hidden" name="filtrolabel" id="filtrolabel">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <label for="data1" class="form-label" onclick="$('#divfiltrolabel').text($('#tipo_data option:selected').text())">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data1" id="data1" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 10  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label for="data2" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data2" id="data2" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' + 30  days')) ?>" maxlength="100" size="100">
        </div>
        <div class="col-12" role="group">
            <label for="tipo_data" class="form-label">Tipo de Data</label>
            <select class="form-select cpcsave" name="tipo_data" id="tipo_data" required>
                <option value="cpr2.previsao">Previsão</option>
                <option value="cpr1.emissao">Emissão</option>
                <option value="cpr2.vencimento">Vencimento</option>
                <option value="cpr2.databaixa">Baixa</option>
            </select>
        </div>
        <? if ($tipocpr == '') { ?>
        <div class="col-12" role="group">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select cpcsave" name="tipo" id="tipo">
                <option value="">Todos</option>
                <option value="R">Receber</option>
                <option value="P">Pagar</option>
            </select>
        </div>
        <? } ?>
        <div class="col-12" role="group">
            <label for="status" class="form-label">Status Baixa</label>
            <select class="form-select cpcsave" name="status" id="status" required>
                <option>Todos</option>
                <option value="P"  selected>Pendente</option>
                <option value="B">Só Baixados</option>
            </select>
        </div>
        <div class="col-12" role="group">
            <label for="clifor" class="form-label">Cliente/Fornec</label>
            <select class="form-select cpcsave" name="clifor" id="clifor" >
            <option></option>
            <? $_SESSION['listagem'] = 'etq_cadastro'; include __DIR__."\..\..\listagem.php" ?>
            </select>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button id="atualizarfiltro" class="btn btn-outline-success w-100" onclick="sqlitem($('#formfluxocaixa'),'financeiro/relatorios/fluxo_caixa','cpcMain','#listabaixa');">Atualizar</button>
        </div>
    </div>
</form>
<div id="cpc-autoheight" style="overflow: auto;">
    <table id="fluxodecaixa" class="table table-hover table-sm tabelareport" style="min-width:1024px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Cód</th>
                <th>Vencimento</th>
                <th>Documento</th>
                <th>Cliente/Fornecedor</th>
                <? if ($tipocpr != 'P') echo '<th class="text-end">A receber</th>'; ?>
                <? if ($tipocpr != 'R') echo '<th class="text-end">A pagar</th>'; ?>
                <? if ($tipocpr == "") echo '<th class="text-end">Saldo</th>'; ?>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
        <?
            if (!(isset($_POST['tipo']))) $_POST['tipo'] ='';
            if (!(isset($_POST['clifor']))) $_POST['clifor'] ='';
            if (!(isset($_POST['status']))) $_POST['status'] ='P';
            if (!(isset($_POST['data1']))) $_POST['data1'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 10  days'));
            if (!(isset($_POST['data2']))) $_POST['data2'] = date("d.m.Y", strtotime(date("m.d.y"). ' + 30  days'));
            $sql = "select cpr2.previsao data, cpr2.numerocpr, cpr2.vencimento data2, cpr1.referencia documento, cpr1.clifor, iif(cpr1.tipo = 'R',cpr2.parcela,null) receita , iif(cpr1.tipo = 'P',cpr2.parcela,null) despesa from cpr2 ".
                    "inner join cpr1 on (cpr2.previsao between '".str_replace('/','.',$_POST['data1'])."' and '".str_replace('/','.',$_POST['data2'])."' and cpr1.numerocpr = cpr2.numerocpr) ";
            if ($_POST['status'] == 'P') $sql = $sql." where cpr2.databaixa is null";
            else if ($_POST['status'] == 'B') $sql = $sql." where databaixa is not null";
            else $sql = $sql." where 1 = 1";
            if ($_POST['tipo'] != '') $sql = $sql." and cpr1.tipo = '".$_POST['tipo']."'";
            if ($_POST['clifor'] != '') $sql = $sql." and clifor = ".$_POST['clifor'];
            if ($tipocpr != '') $sql = $sql." and cpr1.tipo = '".$tipocpr."'";
            $sql .= " order by cpr2.previsao, cpr1.tipo desc, cpr2.vencimento,cpr2.numerocpr";
            if (isset($_POST['tipo_data'])) $sql = str_replace('cpr2.previsao',$_POST['tipo_data'],$sql);

            $total = 0;
            $cont = 0;
            $entrada = 0;
            $saida = 0;
            $grupo = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            foreach ($financeiro->query($sql) as $row)
            {
                if ($grupo != $row['DATA']) {
                    $sql = "select first 1 valor from saldotipo(0,'".date("d.m.Y", strtotime(date("d.m.Y")))." 23:59:59','0')";
                if ($grupo === '')
                foreach ($financeiro->query($sql) as $rowconta)
                {
                    if ($rowconta['VALOR']) $total = $rowconta['VALOR'];
        ?>
            <? if ($tipocpr == '') { ?>
            <tr>
                <td colspan=7 class="text-end">Saldo Anterior: <? echo number_format($total,'2',',','.'); ?></td>
            </tr>
            <? } }
                $grupo = $row['DATA'];
            ?>
            <tr class="table-active">
                <td colspan=7><?php if (!isset($_POST['tipo_data']) || ($_POST['tipo_data'] === "cpr2.previsao")) { echo "Previsão";} else if ($_POST['tipo_data'] === "cpr2.vencimento") { echo 'Vencimento';} else if ($_POST['tipo_data'] === "cpr1.emissao") { echo 'Emissão';} else if ($_POST['tipo_data'] === "cpr2.databaixa") {  echo 'Baixa';} ?>: <? echo date('d/m/Y',strtotime($row['DATA'])); ?></td>
            </tr>
        <? } ?>
            <tr>
                <td class="text-end"><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['NUMEROCPR'] ?>,'telapopup','financeiro/cpr.php?indice=');" data-bs-toggle="tooltip" data-bs-placement="top" title="ir para CPR"><?php echo $row['NUMEROCPR'] ?></div></td>
                <td><? if ($row['DATA2'] != '') echo  date('d/m/Y', strtotime($row['DATA2'])) ?></td>
                <td><? echo $row['DOCUMENTO'] ?></td>
                <td class="text-wrap">
                    <? $sql = "select nome from cadastro where fornecedor =".$row['CLIFOR'];
                    foreach ($almoxa->query($sql) as $rowclifor) {}
                    echo $rowclifor['NOME'] ?>
                </td>
                <td class="text-end"><? if ($row['RECEITA']) { $entrada += $row['RECEITA']; echo number_format($row['RECEITA'], 2,',','.'); if ($row['RECEITA']) $total += $row['RECEITA']; } ?></td>
                <td class="text-end"><? if ($row['DESPESA']) { $saida += $row['DESPESA']; echo number_format($row['DESPESA'], 2,',','.'); if ($row['DESPESA']) $total -= $row['DESPESA']; } ?></td>
                <? if ($tipocpr == '') { ?>
                <td class="text-end <?php echo ($total >= 0) ? "" : "text-danger"; ?>"><? echo number_format($total, 2,',','.'); ?></td>
                <? } ?>
            </tr>
            <? } ?>
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <td></td>
                <td></td>
                <td></td>
                <td class="text-end">Total</td>
                <td class="text-end"><? echo number_format($entrada, 2,',','.'); $entrada = 0; ?></td>
                <td class="text-end"><? echo number_format($saida, 2,',','.'); $saida = 0;?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <input id="campototal" onclick="$('#totalbaixa').val($(this).attr('value'))" class="form-control form-control-lg" style="text-align:right; min-width:100px" type="hidden" value="<? echo number_format($total,2,'.','') ?>" readonly>
</div>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    <? if (!isset($row)) echo "$('#formfluxocaixa').offcanvas('show');" ?>
"></div>
