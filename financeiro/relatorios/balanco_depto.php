<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Balanço Departamento';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formbalanco_depto" aria-controls="formbalanco_depto">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'balanco_depto')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" id="formbalanco_depto" name="formbalanco_depto" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="balanco_depto">
    <input type="hidden" name="campomarcado" id="campomarcado">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <label for="inputAddress2" class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-ini" id="data" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 10  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data-fim" id="baixa" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' + 30  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="co-12" role="group">
            <label for="inputState" class="form-label">Status</label>
            <select class="form-select cpcsave" name="status" id="status" required>
                <option>Todos</option>
                <option value="P"  selected>Pendente</option>
                <option value="B">Só Baixados</option>
            </select>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="balanco_depto" onclick="sqlitem($('#formbalanco_depto'),'financeiro/relatorios/balanco_depto','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="balanco_depto" class="container table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Cód</th>
                <th>Descrição</th>
                <th>Recebimentos</th>
                <th class="text-end">Pagamentos</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['status']))) $_POST['status'] ='';
                if (!(isset($_POST['data-ini']))) $_POST['data-ini'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 10  days'));
                if (!(isset($_POST['data-fim']))) $_POST['data-fim'] = date("d.m.Y", strtotime(date("m.d.y"). ' + 30  days'));
                $sql = "select departamento.depto, departamento.a_nome departamento, sum(iif(movimen.tipo = 'E',movcustos.valor,0)) recebimento, sum(iif(movimen.tipo = 'S',movcustos.valor,0)) pagamento from MOVIMEN inner join movcustos on (movimen.NUMERO = movcustos.numero) inner join departamento on (departamento.depto = movcustos.depto) where movimen.data1 between  '".str_replace('/','.',$_POST['data-ini'])."' and '".str_replace('/','.',$_POST['data-fim'])."' group by 1,2";
                $sql .= "order by 2";
                $pagamento = 0;
                $recebimento = 0;
                $cont = 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td class="text-end"><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['DEPTO'] ?>,'telapopup','financeiro/ccusto.php?indice=');" data-bs-toggle="tooltip" data-bs-placement="top" title="ir para Nat. Operação"><?php echo $row['DEPTO'] ?></div></td>
                <td><? echo $row['DEPARTAMENTO'] ?></td>
                <td class="text-end"><? if ($row['RECEBIMENTO']) { $recebimento += $row['RECEBIMENTO']; echo number_format($row['RECEBIMENTO'], 2,',','.'); } ?></td>
                <td class="text-end"><? if ($row['PAGAMENTO']) { $pagamento += $row['PAGAMENTO']; echo number_format($row['PAGAMENTO'], 2,',','.'); } ?></td>
            </tr>
            <? } ?>
            <tr class="fw-bold fs-7 gs-0">
                <td class="text-end" colspan="2">Total</td>
                <td class="text-end"><? echo number_format($recebimento, 2,',','.'); $recebimento = 0; ?></td>
                <td class="text-end"><? echo number_format($pagamento, 2,',','.'); $pagamento = 0; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<? if (!isset($row)) { ?>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    $('#formbalanco_depto').offcanvas('show');
"></div>
<? } ?>