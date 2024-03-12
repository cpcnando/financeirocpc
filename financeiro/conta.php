<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Contas Correntes';
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from contas where conta =0".$_GET['indice'];
     foreach ($financeiro->query($sql) as $rowcontas) {
     if (isset($rowcontas['CONTA'])) $rowcontas['CONTA'] = number_format(($rowcontas['CONTA'] ?? '0'),0,'','');
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
                                                                                                                                                                                                                                                showMain('contas<?php echo $rowcontas['CONTA'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
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
                    <option value="aba-outro">Outros</option>
                    <option value="todos">Todos</option>
                    <? if (($rowcontas['CONTA'] ?? '') != '') { ?>
                    <option disabled><hr class="dropdown-divider"></option>
                    <option value="documentos">Docs Digitais</option>
                    <? }  ?>
                    <option value="listagem">Listagem</option>
                </select>
            </div>            
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-evenly cpcnoprint mb-2 cpc-abas-padrao cpc-barra-acao">
        <? if ($rowacesso['DML_I'] === 'S') { ?>
        <button id="incluir" type="button" onclick="insertform($('#formcontas'),'a_nome');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>

        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowcontas['CONTA'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formcontas'),'a_nome');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formcontas'),'financeiro/dml','','financeiro/conta');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowcontas['CONTA'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('financeiro', 'contas', 'conta', $('#conta').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','financeiro/conta',$('#formcontas'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','financeiro/conta',$('#formcontas'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','financeiro/conta',$('#formcontas'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','financeiro/conta',$('#formcontas'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formcontas" name="formcontas" action="financeiro/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tipodml" name="tipodml" type="hidden" value="contas">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="financeiro">
        <input id="dml" name="dml" type="hidden" value="Q">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2 col-4">
                <label for="conta" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formcontas\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="conta" name="conta" type="text" class="form-control pk text-end" value="<? if (isset($rowcontas['CONTA'])) echo number_format(($rowcontas['CONTA'] ?? '0'),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','financeiro/conta','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-8">
                <label for="a_nome" class="form-label">Descrição</label>
                <div class="input-group">
                    <input id="a_nome" name="a_nome" type="text" class="form-control" value="<? echo $rowcontas['A_NOME'] ?? '' ?>" readonly required oninput="$(this).val($(this).val().toUpperCase())" size="40">
                    <a class="input-group-text cpcnoprint" onclick="inputbox('Contas','input_conta','financeiro/conta','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <label for="tipo" class="form-label">Tipo</label>
                <select id="tipo" name="tipo" class="form-select" value="<? echo $rowcontas['TIPO'] ?? ''; ?>" disabled required>
                <option></option>
                <? $_SESSION['listagem'] = 'json_tipoconta'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2 btn btn-outline-secondary">
                <label for="ativo" class="form-label">Ativo</label>
                <input id="ativo" name="ativo" type="checkbox" class="form-check-input" checado="S" nchecado="N" default="S" <? if (($rowcontas['ATIVO'] ?? '') === "S") echo 'checked' ?> disabled><br>
            </div>
            
            <div class="col-md-4">
                <label for="depto" class="form-label">C. Custo</label>
                <div class="input-group">
                    <input id="depto" name="depto" type="number" class="form-control codtexto" value="<? echo $rowcontas['DEPTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'ccustofin','deptoselect');">
                    <input id="deptoselect" name="deptoselect" type="text" class="form-control " value="<? if (isset($rowcontas['DEPTO'])) echo executasqlcampo('select a_nome from departamento where depto =0'.$rowcontas['DEPTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="depto" onkeyup="buscaCampo(event,$(this),'ccustofin')">
                </div>
            </div>
            <div class="col-md-2">
                <label for="contas" class="form-label">Cód Contábil</label>
                <input id="contas" name="contas" type="text" class="form-control" value="<? echo $rowcontas['CONTAS'] ?? ''; ?>" style="text-align:right;"  readonly tipocpc="contabil">
            </div>
            <div class="col-md-2">
                <label for="limitedias" class="form-label">Limite (dias)</label>
                <input id="limitedias" name="limitedias" type="number" class="form-control" value="<? if (isset($rowcontas['LIMITEDIAS'])) echo number_format($rowcontas['LIMITEDIAS'],0,'',''); ?>" style="text-align:right;"  readonly>
            </div>
            <div class="col-md-2">
                <label for="a_agencia" class="form-label">Agência</label>
                <input id="a_agencia" name="a_agencia" type="text" class="form-control" value="<? echo $rowcontas['A_AGENCIA'] ?? '' ?>" maxlength="20"  readonly>
            </div>
            <div class="col-md-2">
                <label for="a_nome1" class="form-label">Conta</label>
                <input id="a_nome1" name="a_nome1" type="text" class="form-control" value="<? echo $rowcontas['A_NOME1'] ?? '' ?>" maxlength="20"  readonly>
            </div>
            <div class="col-md-12">
                <label for="observacao" class="form-label">Observação</label>
                <textarea id="observacao" name="observacao" class="form-control" rows="3" readonly><? echo $rowcontas['OBSERVACAO'] ?? ''; ?></textarea>
            </div>
            
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            
        </div>
    </form>
    <div id="cpc-anexo" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="cpc-listagem" class="row g-1 cpc-abas" style="display:none">
    </div>
</div>