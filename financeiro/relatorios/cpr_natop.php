<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'CPR Departamento/Nat. Oper';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formcpr_natop" aria-controls="formcpr_natop">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'cpr_natop')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<div id="divfiltrolabel" class="text-end"><? echo mb_convert_encoding(($_POST['filtrolabel'] ?? ''), 'ISO-8859-1', 'UTF-8') ?></div>
<form id="formcpr_natop" name="formcpr_natop" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="cpr_natop">
    <input type="hidden" name="tipoform" value="filtro">
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
            <button class="btn btn-outline-success w-100" id="cpr_natop" onclick="sqlitem($('#formcpr_natop'),'financeiro/relatorios/cpr_natop','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="cpr_natop" class="table table-hover table-sm tabelareport" style="min-width:1024px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">CPR</th>
                <th>Clifor</th>
                <th>Departamento</th>
                <th>Custos</th>
                <th>Emissão</th>
                <th>Vencimento</th>
                <th>Baixa</th>
                <th>Parcela</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y")));
                $sql = "select financeirogeral.tipo, financeirogeral.indice, financeirogeral.clifor, financeirogeral.depto, financeirogeral.custos, financeirogeral.emissao, financeirogeral.vencimento, financeirogeral.baixa, financeirogeral.parcela ".
                "from financeirogeral('where emissao between ''".str_replace('/','.',$_POST['data-ini'])."'' AND ''".str_replace('/','.',$_POST['data-fim'])."'' and tipo in (''R'',''P'')') ".
                "inner join custos on (custos.custos = financeirogeral.custos) ".
                "INNER JOIN CONTAS ON (financeirogeral.CONTA = CONTAS.CONTA) ".
                "WHERE parcela > 0 ";                
                //.str_replace('/','.',$_POST['data-ini']).
                $sql .= " order by financeirogeral.tipo, financeirogeral.vencimento";
                $total = 0;
                $cont = 0;   
                $grupo = '';             
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
                                if ($grupo !== $row['TIPO']) {
                                    $grupo = $row['TIPO'];
                        ?>
                        <tr><td class="fw-bold fs-7 gs-0" colspan="8">Tipo: <? if (isset($row['TIPO'])) echo $row['TIPO'] ?></td></tr>
                        <? } ?>
            
            <tr>
                <td class="text-end"><? echo $row['INDICE'] ?></td>
                <td><? echo $row['CLIFOR'] ?></td>
                <td><? echo $row['DEPTO'] ?></td>
                <td><? echo $row['CUSTOS'] ?></td>
                <td><? echo $row['EMISSAO'] ?></td>
                <td><? echo $row['VENCIMENTO'] ?></td>
                <td><? echo $row['BAIXA'] ?></td>
                <td><? echo $row['PARCELA'] ?></td>
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
  $('#formcpr_natop').offcanvas('show');
"></div>
<? } ?>