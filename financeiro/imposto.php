<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/financeiro.php";
    include __DIR__."/../sgbd/almoxa.php";
    $_SESSION['ACESSO'] = 'Impostos';
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from impostos where sequencia =0".$_GET['indice'];
     foreach ($financeiro->query($sql) as $rowimpostos) {
     if (isset($rowimpostos['SEQUENCIA'])) $rowimpostos['SEQUENCIA'] = number_format(($rowimpostos['SEQUENCIA'] ?? '0'),0,'','');
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
                                                                                                                                                                                                                                                showMain('impostos<?php echo $rowimpostos['SEQUENCIA'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
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
                    <? if (($rowimpostos['SEQUENCIA'] ?? '') != '') { ?>
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
        <button id="incluir" type="button" onclick="insertform($('#formimpostos'),'descricao');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowimpostos['SEQUENCIA'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formimpostos'),'descricao');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formimpostos'),'financeiro/dml','','financeiro/imposto');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowimpostos['SEQUENCIA'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('financeiro', 'impostos', 'sequencia', $('#sequencia').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','financeiro/imposto',$('#formimpostos'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','financeiro/imposto',$('#formimpostos'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','financeiro/imposto',$('#formimpostos'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','financeiro/imposto',$('#formimpostos'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formimpostos" name="formimpostos" action="financeiro/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tipodml" name="tipodml" type="hidden" value="impostos">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="financeiro">
        <input id="dml" name="dml" type="hidden" value="Q">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2 col-4">
                <label for="sequencia" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formimpostos\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="sequencia" name="sequencia" type="text" class="form-control pk text-end" value="<? if (isset($rowimpostos['SEQUENCIA'])) echo number_format(($rowimpostos['SEQUENCIA']),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','financeiro/imposto','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-10 col-8">
                <label for="descricao" class="form-label">Descrição</label>
                <div class="input-group">
                    <input id="descricao" name="descricao" type="text" class="form-control" value="<? echo $rowimpostos['DESCRICAO'] ?? '' ?>" readonly required oninput="$(this).val($(this).val().toUpperCase())" size="40">
                    <a class="input-group-text cpcnoprint" onclick="inputbox('Impostos','input_imposto','financeiro/imposto','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-2">
                <label for="atividade" class="form-label">Atividade</label>
                <input id="atividade" name="atividade" type="number" class="form-control" value="<? if (isset($rowimpostos['ATIVIDADE'])) echo number_format($rowimpostos['ATIVIDADE'],0,'',''); ?>" style="text-align:right;"  readonly>
            </div>
            <div class="col-md-2">
                <label for="dias" class="form-label">Dias</label>
                <input id="dias" name="dias" type="number" class="form-control" value="<? if (isset($rowimpostos['DIAS'])) echo number_format($rowimpostos['DIAS'],0,'',''); ?>" style="text-align:right;"  readonly>
            </div>
            <div class="col-md-4">
                <label for="minimorecolhido" class="form-label">Vl Mín Rec</label>
                <input id="minimorecolhido" name="minimorecolhido" type="text" class="form-control" value="<? if (isset($rowimpostos['MINIMORECOLHIDO'])) echo number_format($rowimpostos['MINIMORECOLHIDO'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-4">
                <label for="maximorecolhido" class="form-label">Vl Máx Rec</label>
                <input id="maximorecolhido" name="maximorecolhido" type="text" class="form-control" value="<? if (isset($rowimpostos['MAXIMORECOLHIDO'])) echo number_format($rowimpostos['MAXIMORECOLHIDO'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-4">
                <label for="tipovenc" class="form-label">Tipo Venc.</label>
                <select id="tipovenc" name="tipovenc" class="form-select" value="<? echo $rowimpostos['TIPOVENC'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_imptipovenc'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="diasema" class="form-label">Semana</label>
                <select id="diasema" name="diasema" class="form-select" value="<? echo $rowimpostos['DIASEMA'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_semanatexto'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="data" class="form-label">Data</label>
                <select id="data" name="data" class="form-select" value="<? echo $rowimpostos['DATA'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_datatipo'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="incidimposto" class="form-label">Inc. Imposto</label>
                <select id="incidimposto" name="incidimposto" class="form-select" value="<? echo $rowimpostos['INCIDIMPOSTO'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_impostoincid'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="tipo" class="form-label">Tipo Doc</label>
                <select id="tipo" name="tipo" class="form-select" value="<? echo $rowimpostos['TIPO'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_impostotipo'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="acumula" class="form-label">Acum. Período</label>
                <select id="acumula" name="acumula" class="form-select" value="<? echo $rowimpostos['ACUMULA'] ?? ''?>" disabled>
                    <option value=""></option>
                    <option value="S">S</option>
                    <option value="N">N</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="fornecedor" class="form-label">Fornecedor</label>
                <div class="input-group">
                    <input id="fornecedor" name="fornecedor" type="number" class="form-control codtexto" value="<? echo $rowimpostos['FORNECEDOR'] ?? ''; ?>" readonly onchange="campoLista($(this),'fornecedor','fornecedorselect');">
                    <input id="fornecedorselect" name="fornecedorselect" type="text" class="form-control " value="<? if (isset($rowimpostos['FORNECEDOR'])) echo executasqlcampo('select nome from cadastro where fornecedor =0'.$rowimpostos['FORNECEDOR'],$almoxa) ?? ''; ?>" readonly autocomplete="off" compcodigo="fornecedor" onkeyup="buscaCampo(event,$(this),'fornecedor')">
                </div>
            </div>
            <div class="col-md-4">
                <label for="contacusto" class="form-label">Conta Custo</label>
                <div class="input-group">
                    <input id="contacusto" name="contacusto" type="number" class="form-control codtexto" value="<? echo $rowimpostos['CONTACUSTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'natop','contacustoselect');">
                    <input id="contacustoselect" name="contacustoselect" type="text" class="form-control" value="<? if (isset($rowimpostos['CONTACUSTO'])) echo executasqlcampo('select a_nome from custos where custos =0'.$rowimpostos['CONTACUSTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="contacusto" onkeyup="buscaCampo(event,$(this),'natop')">
                </div>
            </div>
            <div class="col-md-4">
                <label for="departamento" class="form-label">C. Custo</label>
                <div class="input-group">
                    <input id="departamento" name="departamento" type="number" class="form-control codtexto" value="<? echo $rowimpostos['DEPARTAMENTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'ccustofin','departamentoselect');">
                    <input id="departamentoselect" name="departamentoselect" type="text" class="form-control " value="<? if (isset($rowimpostos['DEPARTAMENTO'])) echo executasqlcampo('select a_nome from departamento where depto =0'.$rowimpostos['DEPARTAMENTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="departamento" onkeyup="buscaCampo(event,$(this),'ccustofin')">
                </div>
            </div>
        </div>
    </form>
    <div id="cpc-anexo" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="cpc-listagem" class="row g-1 cpc-abas" style="display:none">
    </div>
</div>