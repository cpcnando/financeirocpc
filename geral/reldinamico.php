<?
    include __DIR__."/../headermain.php";
    if (isset($_POST['rel'])) $_GET['rel'] = $_POST['rel'];
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../sgbd/fatura.php";
    include __DIR__."/../funcoes.php";
    $_SESSION['ACESSO'] = 'Relatorio Dinamico';
    include __DIR__."/../sgbd/acesso.php";
    $sqldinamico = "select * from relatorios where indice =".$_GET['rel'];
    foreach ($fatura->query($sqldinamico) as $rowdinamico){
        $sqldinamico = $rowdinamico['SCRIPT'];
        if (!empty($_POST) || !strpos($sqldinamico,':')) {
            if (isset($_POST['data1'])) $sqldinamico = str_replace(":data1","'".$_POST['data1']."'",$sqldinamico);
            if (isset($_POST['data2'])) $sqldinamico = str_replace(":data2","'".$_POST['data2']."'",$sqldinamico);
            if (isset($_POST['convenio1'])) $sqldinamico = str_replace(":convenio1",$_POST['convenio1'],$sqldinamico);
            if (isset($_POST['medico1'])) $sqldinamico = str_replace(":medico1",$_POST['medico1'],$sqldinamico);
        }
    }

?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formreldinamico" aria-controls="formreldinamico">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $rowdinamico['RELATORIO']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'reldinamico')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form id="formreldinamico" name="formreldinamico" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="reldinamico">
    <input type="hidden" name="campomarcado" id="campomarcado">
    <input type="hidden" name="rel" id="rel" value= <? echo $_GET['rel'] ?>>
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <? if (strpos($rowdinamico['SCRIPT'],':data1')) { ?>
        <div class="col-12">
            <label for="data-ini" class="form-label"><? if (strpos($rowdinamico['SCRIPT'],':data2')) echo "De"; else echo "Data"; ?></label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data1" id="data1" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 10  days')) ?>" maxlength="100" size="100" required>
        </div>
        <? } ?>
        <? if (strpos($rowdinamico['SCRIPT'],':data2')) { ?>
        <div class="col-12">
            <label for="data-fim" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data2" id="data2" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' + 30  days')) ?>" maxlength="100" size="100" required>
        </div>
        <? } ?>
        <? if (strpos($rowdinamico['SCRIPT'],':convenio1')) { ?>
        <div class="col-12">
            <label for="convenio1" class="form-label">Convênio</label>
            <select id="convenio1" name="convenio1" class="form-select cpcsave" required>
            <option></option>
            <? $_SESSION['listagem'] = 'fat_convenio'; include __DIR__."\..\listagem.php" ?>
            </select>
        </div>
        <? } ?>
        <? if (strpos($rowdinamico['SCRIPT'],':medico1')) { ?>
        <div class="col-12">
            <label for="medico1" class="form-label">Profissional</label>
            <select id="medico1" name="medico1" class="form-select cpcsave" required>
            <option></option>
            <? $_SESSION['listagem'] = 'fat_profserv'; include __DIR__."\..\listagem.php" ?>
            </select>
        </div>
        <? } ?>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="reldinamico" onclick="sqlitem($('#formreldinamico'),'geral/reldinamico','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="reldinamico" class="table table-hover table-sm tabelareport" style="min-width:1024px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <? if ($rowdinamico['ORDEM'] === '1') {echo "<th class='text-end'>Ord</th>"; $ordem = 1; } ?>
                <? foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo is null or grupo = '0') order by ordem") as $rowitem) { ?>
                <th class="<? if ($rowitem['ALINHAMENTO'] === 'D') echo 'text-end'; if ($rowitem['ALINHAMENTO'] === 'C') echo 'text-center'; ?>"><? echo $rowitem['TITULO'] ?></th>
                <? } ?>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                $total = 0;
                $cont = 0;
                if (!empty($_POST) || !strpos($sqldinamico,':'))
                foreach ($fatura->query($sqldinamico) as $row)
                {
                    foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo <> '0') order by ordem") as $rowgrupo) {
                        if ((!isset($grupo[$rowgrupo['CAMPO']])) || ($row[$rowgrupo['CAMPO']] !== $grupo[$rowgrupo['CAMPO']]))
                        { if (isset($totaisgrupo)) { ?>
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <? if ($rowdinamico['ORDEM'] === '1') {echo "<td></td>"; } $total="Total Grupo:" ?>
                <? foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo is null or grupo = '0') order by ordem") as $rowitem) { ?>
                <td class="<? if ($rowitem['ALINHAMENTO'] === 'D') echo 'text-end'; if ($rowitem['ALINHAMENTO'] === 'C') echo 'text-center'; ?>"><? echo $total; $total = ''; if ($rowitem['TOTALIZA'] == 'S') echo formatarValor($totaisgrupo[$rowitem['CAMPO']],$rowitem['MASCARA']); $totaisgrupo[$rowitem['CAMPO']] = 0; ?></td>
                <? } ?>
            </tr>

                        <? }
                            $grupo[$rowgrupo['CAMPO']] = $row[$rowgrupo['CAMPO']];
                            echo '<tr class="text-start text-muted fw-bold fs-7 gs-0"><td colspan="'.count($rowitem).'">'.$rowgrupo['TITULO'].': '.$row[$rowgrupo['CAMPO']].'</td></tr>';
                        }
                    }
            ?>
            <tr>
            <? if ($rowdinamico['ORDEM'] === '1') {echo "<td class='text-end'>".$ordem++."</td>"; } ?>
                <? 
                    foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo is null or grupo = '0') order by ordem") as $rowitem) { 
                        $campo = formatarValor($row[$rowitem['CAMPO']],$rowitem['MASCARA']);
                        if ($rowitem['TOTALIZA'] == 'S') {
                            // Converte o valor para um número antes de somar
                            $valorNumerico = floatval(str_replace([',', '.'], ['', '.'], $row[$rowitem['CAMPO']]));
                            if (!isset($totais[$rowitem['CAMPO']])) $totais[$rowitem['CAMPO']] = 0;
                            if (!isset($totaisgrupo[$rowitem['CAMPO']])) $totaisgrupo[$rowitem['CAMPO']] = 0;
                            $totais[$rowitem['CAMPO']] += $valorNumerico;
                            $totaisgrupo[$rowitem['CAMPO']] += $valorNumerico;
                        }                ?>
                <td class="<? if ($rowitem['ALINHAMENTO'] === 'D') echo 'text-end'; if ($rowitem['ALINHAMENTO'] === 'C') echo 'text-center'; ?>"><? echo $campo ?></td>
                <? } ?>
            </tr>
            </tr>
            <? } if (isset($totaisgrupo)) { ?>


            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <? if ($rowdinamico['ORDEM'] === '1') {echo "<td></td>"; } $total="Total Grupo:" ?>

                <? if (!empty($_POST) || !strpos($sql,':')) foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo is null or grupo = '0') order by ordem") as $rowitem) { ?>
                <td class="<? if ($rowitem['ALINHAMENTO'] === 'D') echo 'text-end'; if ($rowitem['ALINHAMENTO'] === 'C') echo 'text-center'; ?>"><? echo $total; $total = ''; if ($rowitem['TOTALIZA'] == 'S') echo formatarValor($totaisgrupo[$rowitem['CAMPO']],$rowitem['MASCARA']); ?></td>
                <? } ?>
            </tr>
            <? } ?>


            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <? if ($rowdinamico['ORDEM'] === '1') {echo "<td></td>"; } $total="Total Geral:" ?>

                <? if (isset($row)) if (!empty($_POST) || !strpos($sql,':')) foreach ($fatura->query("select * from relatorios1 where indice =".$_GET['rel']." and (grupo is null or grupo = '0') order by ordem") as $rowitem) { ?>
                <td class="<? if ($rowitem['ALINHAMENTO'] === 'D') echo 'text-end'; if ($rowitem['ALINHAMENTO'] === 'C') echo 'text-center'; ?>"><? echo $total; $total = ''; if ($rowitem['TOTALIZA'] == 'S') echo formatarValor($totais[$rowitem['CAMPO']],$rowitem['MASCARA']); ?></td>
                <? } ?>
            </tr>
            <? if (!isset($row)) echo '<tr class="text-center text-muted fw-bold fs-7 gs-0"><td class="text-danger" colspan="'.count($rowitem).'">Nenhum registro encontrado ou filtre a pesquisa!!</td></tr>'; ?>
        </tbody>
    </table>
</div>
<? if (!isset($row)) { ?>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    $('#formreldinamico').offcanvas('show');
"></div>
<? } ?>