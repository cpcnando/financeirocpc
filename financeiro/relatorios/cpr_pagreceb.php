<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Pagamentos e Recebimentos';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formcpr_pagreceb" aria-controls="formcpr_pagreceb">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'cpr_pagreceb')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<div id="divfiltrolabel" class="text-end"><? echo mb_convert_encoding(($_POST['filtrolabel'] ?? ''), 'ISO-8859-1', 'UTF-8') ?></div>
<form id="formcpr_pagreceb" name="formcpr_pagreceb" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="cpr_pagreceb">
    <input type="hidden" name="filtrolabel" id="filtrolabel">
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
            <input type="date" class="form-control cpcsave" placeholder="" name="data-fim" id="data-fim" value="<? echo date("Y-m-d", strtotime(date("m.d.y"))) ?>" maxlength="100" size="100" required>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="cpr_pagreceb" onclick="sqlitem($('#formcpr_pagreceb'),'financeiro/relatorios/cpr_pagreceb','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="cpr_pagreceb" class="table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Cód</th>
                <th>Emissão</th>
                <th class="text-center">Tipo</th>
                <th>Cli/For</th>
                <th class="text-end">Valor</th>
                <th>Baixa</th>
                <th>Banco</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y")));
                $sql = "select vencimento,indice, emissao,tipo, clifor, parcela,baixa,conta from financeirogeral('where emissao between ''".str_replace('/','.',$_POST['data-ini'])."'' and ''".str_replace('/','.',$_POST['data-fim'])."'' and tipo in (''R'',''P'')')";
                //.str_replace('/','.',$_POST['data-ini']).
                $sql .= "order by 1,2";
                $total = 0;
                $cont = 0;
                $grupo = "";
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
                    if ($grupo !== $row['VENCIMENTO']) {
                        $grupo = $row['VENCIMENTO'];
            ?>
            <tr><td class="fw-bold fs-7 gs-0" colspan="7">Vencimento: <? if (isset($row['VENCIMENTO'])) echo date("d/m/Y", strtotime($row['VENCIMENTO'])) ?></td></tr>
            <? } ?>
            <tr>
                <td class="text-end"><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['INDICE'] ?>,'telapopup','financeiro/cpr.php?indice=');" data-bs-toggle="tooltip" data-bs-placement="top" title="ir para Título"><?php echo $row['INDICE'] ?></div></td>
                <td><? echo date("d/m/Y", strtotime($row['EMISSAO'])) ?></td>
                <td class="text-center"><? echo $row['TIPO'] ?></td>
                <td><? echo executasqlcampo("select nome from cadastro where fornecedor =0".$row['CLIFOR'],$almoxa); ?></td>
                <td class="text-end"><? if ($row['PARCELA']) { $total += $row['PARCELA']; echo number_format($row['PARCELA'], 2,',','.'); } ?></td>
                <td><? if (isset($row['BAIXA'])) echo date("d/m/Y", strtotime($row['BAIXA'])) ?></td>
                <td><? if (isset($row['CONTA'])) echo executasqlcampo("select a_nome from contas where conta =0".$row['CONTA'],$financeiro); ?></td>
            </tr>
            <? } ?>
            <tr class="fw-bold fs-7 gs-0">
                <td class="text-end" colspan="4">Total</td>
                <td class="text-end"><? echo number_format($total, 2,',','.'); $total = 0; ?></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
</div>
<? if (!isset($row)) { ?>
<div class="loadcpc" onclick="
  $('.loadcpc').removeClass('loadcpc');
  $('#formcpr_pagreceb').offcanvas('show');
"></div>
<? } ?>