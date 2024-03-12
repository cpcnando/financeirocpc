<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Centro de Custos';
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from departamento where depto =0".$_GET['indice'];
     foreach ($financeiro->query($sql) as $rowdepartamento) {
     if (isset($rowdepartamento['DEPTO'])) $rowdepartamento['DEPTO'] = number_format(($rowdepartamento['DEPTO'] ?? '0'),0,'','');
     }
?>
<div id="cpc-topo" class="card container my-2 cpcnoprint">
    <div class="row card-head h3 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <div class="input-group text-center">
                <span class="input-group-text cpcnoprint border border-primary" onclick="$('#fav_acesso').click()" tabindex="-1"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                <select id="abaitem" value="aba-dados" class="form-select form-select-aba form-select-sm border border-primary fw-bold text-center text-primary cpcnoupdate select-cpc-abas" onfocusout="$(this).attr('size','1')" onchange=" $('.cpc-abas-padrao').show();
                                                                                                                                                                                                                                              $('.cpc-abas').hide();
                                                                                                                                                                                                                                              if ($(this).val() === 'documentos') {
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;');
                                                                                                                                                                                                                                                $('#cpc-anexo').show();
                                                                                                                                                                                                                                                showMain('departamento<?php echo $rowdepartamento['DEPTO'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'listagem') {
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;');
                                                                                                                                                                                                                                                $('#header-fixo').hide();
                                                                                                                                                                                                                                                $('#cpc-listagem').show();
                                                                                                                                                                                                                                                showMain('<?php echo $_SESSION['ACESSO']; ?>', 'cpc-listagem', 'geral/lista.php?tipo=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'todos') {
                                                                                                                                                                                                                                                $('.aba-cad').show();
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else {
                                                                                                                                                                                                                                                $('#header-fixo').show();
                                                                                                                                                                                                                                                $('.' + $(this).val()).show();
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                            ">
                    <option value="aba-dados" selected>Dados</option>
                    <? if (($rowdepartamento['DEPTO'] ?? '') != '') { ?>
                    <option disabled><hr class="dropdown-divider"></option>
                    <option value="documentos">Docs Digitais</option>
                    <? } ?>
                    <option value="listagem">Listagem</option>
                </select>
            </div>            
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-evenly cpcnoprint mb-2 cpc-abas-padrao cpc-barra-acao">
        <? if ($rowacesso['DML_I'] === 'S') { ?>
        <button id="incluir" type="button" onclick="insertform($('#formdepartamento'),'a_nome');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowdepartamento['DEPTO'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formdepartamento'),'a_nome');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formdepartamento'),'financeiro/dml','','financeiro/ccusto');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowdepartamento['DEPTO'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('financeiro', 'departamento', 'depto', $('#depto').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','financeiro/ccusto',$('#formdepartamento'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','financeiro/ccusto',$('#formdepartamento'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','financeiro/ccusto',$('#formdepartamento'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','financeiro/ccusto',$('#formdepartamento'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formdepartamento" name="formdepartamento" action="financeiro/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tipodml" name="tipodml" type="hidden" value="departamento">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="financeiro">
        <input id="dml" name="dml" type="hidden" value="Q">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2 col-4">
                <label for="depto" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formdepartamento\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="depto" name="depto" type="text" class="form-control pk text-end" value="<? if (isset($rowdepartamento['DEPTO'])) echo number_format(($rowdepartamento['DEPTO'] ?? '0'),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','financeiro/ccusto','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-10 col-8">
                <label for="a_nome" class="form-label">Descrição</label>
                <div class="input-group">
                    <input id="a_nome" name="a_nome" type="text" class="form-control" value="<? echo $rowdepartamento['A_NOME'] ?? '' ?>" readonly required oninput="$(this).val($(this).val().toUpperCase())" size="40">
                    <a class="input-group-text cpcnoprint" onclick="inputbox('Centro de Custo','input_ccustofin','financeiro/ccusto','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-5">
                <label for="contas" class="form-label">Contas</label>
                <input id="contas" name="contas" type="text" class="form-control" value="<? echo $rowdepartamento['CONTAS'] ?? '' ?>" readonly tipocpc="contabil">
            </div>
            <div class="col-md-5">
                <label for="receita" class="form-label">% Receita</label>
                <input id="receita" name="receita" type="text" class="form-control" value="<? if (isset($rowdepartamento['RECEITA'])) echo number_format($rowdepartamento['RECEITA'],2,',',''); ?>" style="text-align:right;"  readonly  tipocpc="moeda">
            </div>
            <div class="col-md-1 btn btn-outline-secondary">
                <label for="resultado" class="form-label">Resultado</label><br>
                <input id="resultado" name="resultado" type="checkbox" class="form-check-input" checado="S" nchecado="N" default="S" <? if (($rowdepartamento['RESULTADO'] ?? '') === "S") echo 'checked' ?> disabled>
            </div>
            <div class="col-md-1 btn btn-outline-secondary">
                <label for="ativo" class="form-label">Ativo</label><br>
                <input id="ativo" name="ativo" type="checkbox" class="form-check-input" checado="S" nchecado="N" default="S" <? if (($rowdepartamento['ATIVO'] ?? '') === "S") echo 'checked' ?> disabled>
            </div>
                        
        </div>
    </form>
    <div id="cpc-anexo" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="cpc-listagem" class="row g-1 cpc-abas" style="display:none">
    </div>
</div>