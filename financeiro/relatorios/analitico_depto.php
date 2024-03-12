<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Analítico por Departamento';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h4 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button class="btn btn-sm btn-outline-primary ms-5 cpcnoprint" type="button" data-bs-toggle="offcanvas" data-bs-target="#formfiltro" aria-controls="formfiltro">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                <span onclick="$('#fav_acesso').click()" tabindex="-1"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'listaanaliticoconta')" placeholder="Pesquisar..." style="min-width:200px; max-width:400px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<div id="divfiltrolabel" class="text-end"><? echo mb_convert_encoding(($_POST['filtrolabel'] ?? ''), 'ISO-8859-1', 'UTF-8') ?></div>
<form action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" id="formfiltro" name="formfiltro" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="baixa">
    <input type="hidden" name="tipoform" value="filtro">
    <input type="hidden" id="filtrolabel" name="filtrolabel">
    <input type="hidden" name="campomarcado" id="campomarcado">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">    
        <div class="col-12">
            <label for="data1" class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" id="data1" name="data1" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 7  days')) ?>" required>
        </div>
        <div class="col-12">
            <label for= "data2" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" id="data2" name="data2" value="<? echo date('Y-m-d') ?>">
        </div>
        <div class="col-12">
            <label for="tipo_data" class="form-label">Tipo de Data</label>
            <select class="form-select cpcsave" name="tipo_data" id="tipo_data" required>
                <option value = "1">Emissão</option>
                <option value = "2">Conciliação</option>
            </select>
        </div>
        <div class="col-12">
            <label for="conciliado" class="form-label">Conciliado</label>
            <select class="form-select cpcsave" name="conciliado" id="conciliado">
                <option value = "">Todos</option>
                <option value = "S">Sim</option>
                <option value = "N">Não</option>
            </select>
        </div>
        <div class="col-12">
            <label for="tipo_lanca" class="form-label">Tipo Lançamento</label>
            <select class="form-select cpcsave" name="tipo_lanca" id="tipo_lanca">
                <option value = "">Todos</option>
                <option value = "E">Entrada</option>
                <option value = "S">Saída</option>
            </select>
        </div>        
        <div class="col-12" role="group">
            <label for="conta" class="form-label">Contas</label>
            <select class="form-select cpcsave" name="conta" id="conta">
            <option></option>
            <? $_SESSION['listagem'] = 'fin_conta'; include __DIR__."\..\..\listagem.php" ?>
            </select>
        </div> 
        <button class="btn btn-success m-1 w-100" for="Atualizar" id="atualizar_filtro" onclick="sqlitem($('#formfiltro'),'financeiro/relatorios/analitico_depto','cpcMain','#listabaixa');">Atualizar</button>
    </div>
</form>


<div id="cpc-autoheight" style="overflow: auto;">
    <table id="listaanaliticoconta" class="table table-hover table-sm tabelareport" style="min-width:1024px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Ord</th>
                <th class="text-end">Cód</th>
                <th >Data</th>                
                <th >Baixa</th>
                <th >Histórico</th>
                <th class="text-end">Entrada</th>
                <th class="text-end">Saída</th>
                <th class="text-end">Saldo</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
        <?
                if (!(isset($_POST['tipo_data']))) $_POST['tipo_data'] ='1';
                if (!(isset($_POST['conciliado']))) $_POST['conciliado'] ='';
                if (!(isset($_POST['tipo_lanca']))) $_POST['tipo_lanca'] ='';
                if (!(isset($_POST['clifor']))) $_POST['clifor'] ='';
                if (!(isset($_POST['data2']))) $_POST['data2'] = date("d.m.Y");
                if (!(isset($_POST['data1']))) $_POST['data1'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 7  days'));
                $tipo1 = 'E';
                $tipo2 = 'S';
                if ($_POST['tipo_lanca'] === "E") $tipo2 = 'E';
                if ($_POST['tipo_lanca'] === "S") $tipo1 = 'S';
                // $sql = "select * from baixartitulo('".$_POST['data1']."','".str_replace('/','.',$_POST['data2'])." 23:59:59','".$_POST['tipo']."') where 1=1 ";
                $sql = "select depto, indice, max(emissao) emissao, max(baixa) baixa, max(historico) historico, sum(receita) receita, sum(despesa) despesa from financeirogeral('where emissao between ''".str_replace('/','.',$_POST['data1'])."'' and ''".str_replace('/','.',$_POST['data2'])." 23:59:59'' and tipo in (''".$tipo1."'',''".$tipo2."'')') where 1 = 1";
                if (($_POST['conta'] ?? '') !== '') $sql .= " and conta = ".$_POST['conta'];
                if (($_POST['conciliado'] ?? '') === 'S') $sql .= " and baixa is not null ";
                if (($_POST['conciliado'] ?? '') === 'N') $sql .= " and baixa is null ";
                // }
                $sql = $sql.' group by 1,2 order by depto, emissao ,indice';
                if ($_POST['tipo_data'] =='2')
                    $sql = str_replace(' emissao ',' baixa ',$sql);

                //   echo $sql;
            $total = 0;
            $cont = 1;
            $custos = 0;
            $entrada = 0;
            $saida = 0;
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            foreach ($financeiro->query($sql) as $rowanaliticodepto) 
            {
                if ($custos != $rowanaliticodepto['DEPTO']) {
                    $custos = $rowanaliticodepto['DEPTO'];
                    $sql = "select * from saldotipogeral(".$rowanaliticodepto['DEPTO'].",'".date("d.m.Y", strtotime(date("d.m.Y",strtotime($rowanaliticodepto['EMISSAO'])). ' - 1  days'))." 23:59:59','".($_POST['tipo_data'] ?? '1')."','DEPTO')";
                    
                foreach ($financeiro->query($sql) as $rowcustos) 
                {if ($rowcustos['VALOR']) $total = $rowcustos['VALOR'];}
            if (($entrada != 0) || ($saida != 0)) {
        ?>
        <tr class="text-start text-muted fw-bold fs-7 gs-0">
            <td class="text-end"></td>
            <td class="text-end"></td>
            <td></td>                
            <td></td>
            <td class="text-end">Total</td>
            <td class="text-end"><? echo number_format($entrada, 2,',','.'); $entrada = 0; ?></td>
            <td class="text-end"><? echo number_format($saida, 2,',','.'); $saida = 0;?></td>
            <td class="text-end"></td>
        </tr>
        <? } ?>
        <tr class="table-active">
            <td colspan=6 class="text-start text-muted fw-bold fs-7 gs-0"><? echo $rowanaliticodepto['DEPTO']. ' '.$rowcustos['DESCRICAO']; ?></td>
            <td colspan=2 class="text-end align-middle"><? echo number_format($rowcustos['VALOR'], 2,',','.'); ?></td>
        </tr>

        <? } ?>
        <tr>
            <td class="text-end"><? echo $cont++; ?></td>
            <td class="text-end"><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $rowanaliticodepto['INDICE'] ?>,'telapopup','financeiro/movimento.php?indice=');" data-bs-toggle="tooltip" data-bs-placement="top" title="ir para o Movimento"><?php echo $rowanaliticodepto['INDICE'] ?></div></td>
            <td><? if ($rowanaliticodepto['EMISSAO'] != '') echo  date('d/m/Y', strtotime($rowanaliticodepto['EMISSAO'])) ?></td>
            <td><? if ($rowanaliticodepto['BAIXA'] != '') echo  date('d/m/Y', strtotime($rowanaliticodepto['BAIXA'])) ?></td>
            <td class="lh-1"><? echo $rowanaliticodepto['HISTORICO'] ?></td>
            <td class="text-end"><? if ($rowanaliticodepto['RECEITA']) { $entrada += $rowanaliticodepto['RECEITA']; echo number_format($rowanaliticodepto['RECEITA'], 2,',','.'); if ($rowanaliticodepto['RECEITA']) $total += $rowanaliticodepto['RECEITA']; } ?></td>
            <td class="text-end"><? if ($rowanaliticodepto['DESPESA']) { $saida += $rowanaliticodepto['DESPESA']; echo number_format($rowanaliticodepto['DESPESA'], 2,',','.'); if ($rowanaliticodepto['DESPESA']) $total -= $rowanaliticodepto['DESPESA']; } ?></td>
            <td class="text-end"><? echo number_format($total, 2,',','.'); ?></td>
        </tr>
        <? } ?>
        <tr class="text-start text-muted fw-bold fs-7 gs-0">
            <td class="text-end"></td>
            <td class="text-end"></td>
            <td ></td>                
            <td ></td>
            <td class="text-end">Total</td>
            <td class="text-end"><? echo number_format($entrada, 2,',','.'); $entrada = 0; ?></td>
            <td class="text-end"><? echo number_format($saida, 2,',','.'); $saida = 0;?></td>
            <td class="text-end"></td>
        </tr>
        </tbody>
    </table>
    <input id="campototal" onclick="$('#totalbaixa').val($(this).attr('value'))" class="form-control form-control-lg" style="text-align:right; min-width:100px" type="hidden" value="<? echo number_format($total,2,'.','') ?>" readonly>
</div>
<? if (!isset($rowanaliticodepto)) { ?>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    $('#formfiltro').offcanvas('show');
"></div>
<? } ?>