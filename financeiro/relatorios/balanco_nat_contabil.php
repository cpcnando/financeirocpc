<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Balanco por Nat. Contábil';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formbalanco_nat_contabil" aria-controls="formbalanco_nat_contabil">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'balanco_nat_contabil')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form id="formbalanco_nat_contabil" name="formbalanco_nat_contabil" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="balanco_nat_contabil">
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
            <button class="btn btn-outline-success w-100" id="balanco_nat_contabil" onclick="sqlitem($('#formbalanco_nat_contabil'),'financeiro/relatorios/balanco_nat_contabil','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="balanco_nat_contabil" class="container table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Núm</th>
                <th>Cód</th>
                <th>Descrição</th>
                <th class="text-end">Anterior</th>
                <th class="text-end">Recebimento</th>
                <th class="text-end">Pagamento</th>
                <th class="text-end">Atual</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y")));
                $sql = "select custos.contabilx, financeirogeral.custos, custos.a_nome,".
                "sum(iif(emissao < '".str_replace('/','.',$_POST['data-ini'])."', parcelareal,0)) ANTERIOR, ".
                "sum(iif(((emissao >= '".str_replace('/','.',$_POST['data-ini'])."') and (financeirogeral.tipo = 'E')),parcela,0)) RECEBIMENTO, ".
                "sum(iif(((emissao >= '".str_replace('/','.',$_POST['data-ini'])."') and (financeirogeral.tipo = 'S')),parcela,0)) PAGAMENTO ".
                "from financeirogeral('where emissao <= ''".str_replace('/','.',$_POST['data-fim'])."''')inner join custos on (custos.custos = financeirogeral.custos) ".
                "WHERE parcela > 0 group by 1,2,3 ";
                //.str_replace('/','.',$_POST['data-ini'])."' and '".str_replace('/','.',$_POST['data-fim'])."'";
                $sql .= "order by 1,3";
                $total = 0;
                $cont = 0;
                //echo $sql;
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td class="text-end"><? echo $row['CONTABILX'] ?></td>
                <td><? echo $row['CUSTOS'] ?></td>
                <td><? echo $row['A_NOME'] ?></td>
                <td class="text-end"><? if ($row['ANTERIOR']) { $total += $row['ANTERIOR']; echo number_format($row['ANTERIOR'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['RECEBIMENTO']) { $total += $row['RECEBIMENTO']; echo number_format($row['RECEBIMENTO'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['PAGAMENTO']) { $total += $row['PAGAMENTO']; echo number_format($row['PAGAMENTO'], 2,',','.'); } ?></td>
                <td class="text-end"><? $saldo = $row['ANTERIOR'] - $row['PAGAMENTO'] + $row['RECEBIMENTO']; if ($saldo) { $total += $saldo; echo number_format($saldo, 2,',','.'); } ?></td>
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
  $('#formbalanco_nat_contabil').offcanvas('show');
"></div>
<? } ?>