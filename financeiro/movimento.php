<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Movimento Bancário/Caixa';
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from movimen where numero =0".$_GET['indice'];
     foreach ($financeiro->query($sql) as $rowmovimen) {
     if (isset($rowmovimen['NUMERO'])) $rowmovimen['NUMERO'] = number_format(($rowmovimen['NUMERO'] ?? '0'),0,'','');
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
                                                                                                                                                                                                                                                showMain('movimen<?php echo $rowmovimen['NUMERO'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'listagem') {
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;');
                                                                                                                                                                                                                                                $('#header-fixo').hide();
                                                                                                                                                                                                                                                $('#cpc-listagem').show();
                                                                                                                                                                                                                                                showMain('<?php echo $_SESSION['ACESSO']; ?>', 'cpc-listagem', 'geral/lista.php?tipo=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'aba-item') { 
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;'); 
                                                                                                                                                                                                                                                $('#header-fixo').show(); 
                                                                                                                                                                                                                                                $('#aba-item').show(); 
                                                                                                                                                                                                                                                showMain('<?php echo $rowmovimen['NUMERO'] ?? '' ?>', 'aba-item', 'financeiro/movcustos.php?indice=');
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
                    <option value="todos">Todos</option>
                    <? if (($rowmovimen['NUMERO'] ?? '') != '') { ?>
                    <option disabled><hr class="dropdown-divider"></option>
                    <option value="documentos">Docs Digitais</option>
                    <? }  ?>
                    <option value="listagem">Listagem</option>
                    <option value="aba-item">Parcela/Rateio</option>
                </select>
            </div>            
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-evenly cpcnoprint mb-2 cpc-abas-padrao cpc-barra-acao">
        <? if ($rowacesso['DML_I'] === 'S') { ?>
        <button id="incluir" type="button" onclick="insertform($('#formmovimen'),'conta');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowmovimen['NUMERO'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formmovimen'),'conta');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formmovimen'),'financeiro/dml','','financeiro/movimento');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowmovimen['NUMERO'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('financeiro', 'movimen', 'numero', $('#numero').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','financeiro/movimento',$('#formmovimen'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','financeiro/movimento',$('#formmovimen'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','financeiro/movimento',$('#formmovimen'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','financeiro/movimento',$('#formmovimen'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formmovimen" name="formmovimen" action="financeiro/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tipodml" name="tipodml" type="hidden" value="movimen">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="financeiro">
        <input id="dml" name="dml" type="hidden" value="Q">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2 col-4">
                <label for="numero" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formmovimen\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="numero" name="numero" type="text" class="form-control pk text-end" value="<? if (isset($rowmovimen['NUMERO'])) echo number_format(($rowmovimen['NUMERO']),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','financeiro/movimento','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <label for="conta" class="form-label">Conta</label>
                <div class="input-group">
                    <input id="conta" name="conta" type="number" class="form-control codtexto" value="<? echo $rowmovimen['CONTA'] ?? ''; ?>" readonly onchange="campoLista($(this),'fin_conta','contaselect');">
                    <input id="contaselect" name="contaselect" type="text" class="form-control " value="<? if (isset($rowmovimen['CONTA'])) echo executasqlcampo('select a_nome from contas where conta =0'.$rowmovimen['CONTA'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="conta" onkeyup="buscaCampo(event,$(this),'fin_conta')">
                </div>
            </div>
            <div class="col-md-2">
                <label for="data1" class="form-label">Emissão</label>
                <input id="data1" name="data1" type="date" class="form-control" value="<?= $rowmovimen['DATA1'] ? date('Y-m-d', strtotime($rowmovimen['DATA1'])) : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <label for="valor" class="form-label">Valor</label>
                <input id="valor" name="valor" type="text" class="form-control" value="<? if (isset($rowmovimen['VALOR'])) echo number_format($rowmovimen['VALOR'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-2">
                <label for="data2" class="form-label">Conciliação</label>
                <input id="data2" name="data2" type="date" class="form-control" value="<?= $rowmovimen['DATA2'] ? date('Y-m-d', strtotime($rowmovimen['DATA2'])) : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <label for="tipo" class="form-label">Tipo</label>
                <select id="tipo" name="tipo" class="form-select" value="<? echo $rowmovimen['TIPO'] ?? ''; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_io'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-8">
                <label for="portador" class="form-label">Portador</label>
                <input id="portador" name="portador" type="text" class="form-control" value="<? echo $rowmovimen['PROTADOR'] ?? '' ?>" readonly oninput="$(this).val($(this).val().toUpperCase())" size="50">
            </div>
            <div class="col-md-12">
                <label for="historico" class="form-label">Histórico</label>
                <textarea id="historico" name="historico" class="form-control" rows="3" readonly><? echo $rowmovimen['HISTORICO'] ?? ''; ?></textarea>
            </div>
                        
        </div>
    </form>
    <div id="cpc-anexo" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="cpc-listagem" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="aba-item" class="row g-1 cpc-abas" style="display:none">
    </div>
</div>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if (!isMobile) {
        if ($('#numero').val() != ''){
            $('#aba-item').show();
            showMain('<?php echo $rowmovimen['NUMERO'] ?? '' ?>', 'aba-item', 'financeiro/movcustos.php?indice=');
        }
    }
"></div>
