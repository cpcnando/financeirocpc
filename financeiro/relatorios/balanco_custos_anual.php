<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Anual por Nat. de Operação';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formbalanco_custos_anual" aria-controls="formbalanco_custos_anual">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'balanco_custos_anual')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<div id="divfiltrolabel" class="text-end"><? echo mb_convert_encoding(($_POST['filtrolabel'] ?? ''), 'ISO-8859-1', 'UTF-8') ?></div>
<form id="formbalanco_custos_anual" name="formbalanco_custos_anual" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="balanco_custos_anual">
    <input type="hidden" name="filtrolabel" id="filtrolabel">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <label for="ano" class="form-label">Ano</label>
            <input type="number" class="form-control cpcsave text-end" placeholder="" name="ano" id="ano" value="<? echo date("Y-m-d", strtotime(date("m.d.y"))) ?>" required>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="balanco_custos_anual" onclick="sqlitem($('#formbalanco_custos_anual'),'financeiro/relatorios/balanco_custos_anual','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="balanco_custos_anual" class="table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Contas</th>
                <th>Descrição</th>
                <th class="text-end">Jan</th>
                <th class="text-end">Fev</th>
                <th class="text-end">Mar</th>
                <th class="text-end">Abr</th>
                <th class="text-end">Mai</th>
                <th class="text-end">Jun</th>
                <th class="text-end">Jul</th>
                <th class="text-end">Ago</th>
                <th class="text-end">Set</th>
                <th class="text-end">Out</th>
                <th class="text-end">Nov</th>
                <th class="text-end">Dez</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['ano']))) $_POST['ano'] =date("Y", strtotime(date("m.d.y")));
                $sql = "select financeirogeral.custos, custos.a_nome, custos.contabilx,sum(iif(extract(month from emissao) = 1, parcela,0)) JAN, sum(iif(extract(month from emissao) = 2,parcela,0))  FEV,  sum(iif(extract(month from emissao) = 3,parcela,0)) MAR,".
                "sum(iif(extract(month from emissao) = 4, parcela,0)) ABR, sum(iif(extract(month from emissao) = 5,parcela,0))  MAI,  sum(iif(extract(month from emissao) = 6,parcela,0)) JUN,".
                'sum(iif(extract(month from emissao) = 7, parcela,0)) JUL, sum(iif(extract(month from emissao) = 8,parcela,0))  AGO,  sum(iif(extract(month from emissao) = 9,parcela,0)) "SET",'.
                "sum(iif(extract(month from emissao) = 10,parcela,0)) OUT, sum(iif(extract(month from emissao) = 11,parcela,0)) NOV, sum(iif(extract(month from emissao) = 12,parcela,0)) DEZ".
                " from financeirogeral('where emissao between ''1.1.".str_replace('/','.',$_POST['ano'])."'' and ''31.12.".$_POST['ano']."'' and tipo in (''E'',''S'')')".
                "inner join custos on (custos.custos = financeirogeral.custos) WHERE parcela > 0 group by 1,2,3";
                $sql .= "order by 3,2";
                $total = 0;
                $cont = 0;
                // echo $sql;
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td class="text-end"><? echo $row['CONTABILX'] ?></td>
                <td><? echo $row['A_NOME'] ?></td>
                <td class="text-end"><? if ($row['JAN']) { $total += $row['JAN']; echo number_format($row['JAN'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['FEV']) { $total += $row['FEV']; echo number_format($row['FEV'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['MAR']) { $total += $row['MAR']; echo number_format($row['MAR'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['ABR']) { $total += $row['ABR']; echo number_format($row['ABR'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['MAI']) { $total += $row['MAI']; echo number_format($row['MAI'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['JUN']) { $total += $row['JUN']; echo number_format($row['JUN'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['JUL']) { $total += $row['JUL']; echo number_format($row['JUL'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['AGO']) { $total += $row['AGO']; echo number_format($row['AGO'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['SET']) { $total += $row['SET']; echo number_format($row['SET'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['OUT']) { $total += $row['OUT']; echo number_format($row['OUT'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['NOV']) { $total += $row['NOV']; echo number_format($row['NOV'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['DEZ']) { $total += $row['DEZ']; echo number_format($row['DEZ'], 2,',','.'); } ?></td>
            </tr>
            <? } ?>
            <tr class="fw-bold fs-7 gs-0">
                <td class="text-end" colspan="13">Total</td>
                <td class="text-end"><? echo number_format($total, 2,',','.'); $total = 0; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<? if (!isset($row)) { ?>
<div class="loadcpc" onclick="
  $('.loadcpc').removeClass('loadcpc');
  $('#formbalanco_custos_anual').offcanvas('show');
"></div>
<? } ?>