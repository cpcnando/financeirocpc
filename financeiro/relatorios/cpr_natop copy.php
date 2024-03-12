<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'CPR Departamento/Nat. Oper';
    include __DIR__."/../../sgbd/acesso.php";
?>
<span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>

<div id="cpc-topo" class="card  container-fluid my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint me-1" data-bs-toggle="offcanvas" data-bs-target="#formnatop" aria-controls="formnatop">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint me-1" id="cpr_natop" onclick="sqlitem($('#formnatop'),'financeiro/relatorios/cpr_natop','cpcMain');">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-arrows-rotate me-sm-1"></i></div>
            </button>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i></div>
            </button>
            <div class="input-group justify-content-end">
                <?php
                    if ((isset($_POST['data-ini']))) {
                        echo "<a style='outline:none; font-size: 18px; margin: 3px;' >Data de ". date("d/m/Y", strtotime($_POST['data-ini'])). " Até ". date("d/m/Y", strtotime($_POST['data-fim'])). "</a> ";
                    }
                ?>
                <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'cpr_natop')" placeholder="Pesquisar..." style="min-width:200px; max-width:500px">
            </div>
        </div>
    </div>
</div>
<form id="formnatop" name="formnatop" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="cpr_natop">
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
            <button class="btn btn-outline-success w-100" id="cpr_natop" onclick="sqlitem($('#formnatop'),'financeiro/relatorios/cpr_natop','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;" class="card container-fluid ">
    <table id="cpr_natop" class="container table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th>CPR</th>
                <th>CLiente/Fornecedor</th>
                <th>Departamento</th>
                <th>Nat. Operação</th>
                <th>Emissao</th>
                <th>Venci.</th>
                <th>Baixa</th>
                <th class="text-end">Valor</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 10  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y"). ' + 30  days'));
                $sql = "select fg.cpr, F.nome fornecedor, dpto.a_nome departamento, custos.a_nome natop,fg.emissao, fg.vencimento, fg.baixa, fg.valor ". 
                "from FINANCEIROGERAL('where emissao between ''".str_replace('/','.',$_POST['data-ini'])."'' AND ''".str_replace('/','.',$_POST['data-fim'])."''') as FG ".
                "inner join cadastro as F on (f.fornecedor = fg.clifor) ".
                "inner join departamento as dpto on (dpto.depto = fg.depto) ".
                "inner join custos as custos on (custos.custos = fg.custos) ".
                "where fg.tipo = 'P' ";
                //.str_replace('/','.',$_POST['data-ini']).
                $sql .= " order by 5";
                $total = 0;
                $cont = 0;                
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td><? echo $row['CPR'] ?></td>
                <td><? echo $row['FORNECEDOR'] ?></td>
                <td><? echo $row['DEPARTAMENTO'] ?></td>
                <td><? echo $row['NATOP'] ?></td>
                <td><? echo $row['EMISSAO'] ?></td>
                <td><? echo $row['VENCIMENTO'] ?></td>
                <td><? echo $row['BAIXA'] ?></td>
                <td class="text-end"><? echo number_format($row['VALOR'], 2,',','.'); ?></td>
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
  $('#formnatop').offcanvas('show');
"></div>
<? } ?>