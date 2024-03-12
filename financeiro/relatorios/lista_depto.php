<?
    include __DIR__."/../../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../funcoes.php";
    $_SESSION['ACESSO'] = 'Listagem de Departamentos';
    include __DIR__."/../../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h5 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button type="button" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="offcanvas" data-bs-target="#formlista_depto" aria-controls="formlista_depto">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <div class="input-group justify-content-center">
                    <span tabindex="-1" class="me-2 text-center" onclick="$('#fav_acesso').click()"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                    <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'lista_depto')" placeholder="Pesquisar..." style="min-width:200px; max-width:800px">
            </div>
            <button class="btn btn-sm btn-outline-primary cpcnoprint" type="button" onclick="window.print();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-print me-sm-1"></i><div class="cpc-nomobile">Imprimir</div></div>
            </button>
        </div>
    </div>
</div>
<form id="formlista_depto" name="formlista_depto" action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="lista_depto">
    <input type="hidden" name="campomarcado" id="campomarcado">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row m-2" role="group">
            <label class="form-label">Ativo</label>
            <select class="form-select cpcsave" name="ativo" id="ativo">
                <option value="">Todos</option>
                <option value="S" selected>Ativo</option>
                <option value="N">Inativo</option>
            </select>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button class="btn btn-outline-success w-100" id="lista_depto" onclick="sqlitem($('#formlista_depto'),'financeiro/relatorios/lista_depto','cpcMain');">Atualizar</button>
        </div>
    </div>
</form>

<div id="cpc-autoheight" style="overflow: auto;">
    <table id="lista_depto" class="container table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="mb-3 tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="text-end">Cód</th>
                <th>Descrição</th>
                <th>Resultado</th>
                <th>Ativo</th>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
            <?
                if (!(isset($_POST['ativo']))) $_POST['ativo'] ='S';
                $sql = "select depto, a_nome, resultado,ativo from departamento ";
                if ($_POST['ativo'] !== '') $sql .= "where ativo = '".$_POST['ativo']."'";
                else $sql .= "where 1=1 ";
                $sql .= "order by 2";
                $total = 0;
                $cont = 0;
                foreach ($financeiro->query($sql) as $row)
                {
            ?>
            <tr>
                <td class="text-end"><div style="cursor:pointer" onclick="$('#abaitem').val('aba-dados'); showMain(<? echo $row['DEPTO'] ?>,'telapopup','financeiro/ccusto.php?indice=');" data-bs-toggle="tooltip" data-bs-placement="top" title="ir para Departamento"><?php echo $row['DEPTO'] ?></div></td>
                <td><? echo $row['A_NOME'] ?></td>
                <td><? echo $row['RESULTADO'] ?></td>
                <td><? echo $row['ATIVO'] ?></td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>