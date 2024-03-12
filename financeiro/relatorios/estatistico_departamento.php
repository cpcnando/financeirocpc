<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Departamento';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formestatistico_departamento" aria-controls="formestatistico_departamento">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'estatistico_departamento')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form id="formestatistico_departamento" name="formestatistico_departamento" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="estatistico_departamento">
    <input type="hidden" name="campomarcado" id="campomarcado">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <label for="data-ini" class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-ini" id="data-ini" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 10  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label for="data-fim" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-fim" id="data-fim" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' + 30  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="estatistico_departamento" onclick="sqlitem($('#formestatistico_departamento'),'financeiro/relatorios/estatistico_departamento','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="estatistico_departamento" class="container table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Numero</th>
                <th>Descricao</th>
                <th>Mes</th>
                <th class="text-end">Recebimento</th>
                <th class="text-end">Pagamento</th>
                <th class="text-end">saldo</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y")));
                $sql = "select custos.CUSTOS AS NUM, custos.a_nome AS descricao, ".
                "EXTRACT(MONTH FROM FINANCEIROGERAL.EMISSAO) AS MES, ".
                "sum(iif(((financeirogeral.tipo = 'E')),parcela,0)) RECEBIMENTO, ".
                "sum(iif(((financeirogeral.tipo = 'S')),parcela,0)) PAGAMENTO ".
                "from financeirogeral('where emissao between ''".str_replace('/','.',$_POST['data-ini'])."'' AND ''".str_replace('/','.',$_POST['data-fim'])."''') ".
                "INNER JOIN custos ON (financeirogeral.custos = custos.CUSTOS) ".
                "WHERE parcela > 0 group by 1,2,3 ";
                //.str_replace('/','.',$_POST['data-ini']).
                $sql .= "order by 2,3";
                $total = 0;
                $cont = 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td class="text-end"><? echo $row['NUM'] ?></td>
                <td><? echo $row['DESCRICAO'] ?></td>
                <td><? echo $row['MES'] ?></td>
                <td class="text-end"><? if ($row['RECEBIMENTO']) { $total += $row['RECEBIMENTO']; echo number_format($row['RECEBIMENTO'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['PAGAMENTO']) { $total += $row['PAGAMENTO']; echo number_format($row['PAGAMENTO'], 2,',','.'); } ?></td>
                <td class="text-end"><? $saldo = $row['RECEBIMENTO'] - $row['PAGAMENTO']; if ($saldo) { $total += $saldo; echo number_format($saldo, 2,',','.'); } ?></td>
            </tr>
            <? } ?>
            <tr class="fw-bold fs-7 gs-0">
                <td class="text-end" colspan="3">Total</td>
                <td class="text-end"><? echo number_format($total, 2,',','.'); $total = 0; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<? if (!isset($row)) { ?>
<div class="loadcpc" onclick="
  $('.loadcpc').removeClass('loadcpc');
  $('#formestatistico_departamento').offcanvas('show');
"></div>
<? } ?>