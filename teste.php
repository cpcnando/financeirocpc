<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/financeiro.php";
    include __DIR__."/../sgbd/almoxa.php";
    $tipo = '';
    if ($_GET['indice'] ?? '' !== '') {
        $tipo = executasqlcampo("select tipo from cpr1 where numerocpr =0".$_GET['indice'],$financeiro);
        if ($tipo !== '')
            $_GET['tipocpr'] = $tipo;
    }
    if ($_GET['tipocpr'] === 'P') {
        $_SESSION['ACESSO'] = 'Cadastro de Contas a Pagar';
        $tipo = 'P';
    }
    else if ($_GET['tipocpr'] === 'R') {
        $_SESSION['ACESSO'] = 'Cadastro de Contas a Receber';
        $tipo = 'R';
    }
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from cpr1 where numerocpr =0".$_GET['indice']." and tipo = '".$tipo."'";
     foreach ($financeiro->query($sql) as $rowcpr1) {
     if (isset($rowcpr1['NUMEROCPR'])) $rowcpr1['NUMEROCPR'] = number_format(($rowcpr1['NUMEROCPR'] ?? '0'),0,'','');
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
                                                                                                                                                                                                                                                showMain('cpr1<?php echo $rowcpr1['NUMEROCPR'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'listagem') {
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;');
                                                                                                                                                                                                                                                $('#header-fixo').hide();
                                                                                                                                                                                                                                                $('#cpc-listagem').show();
                                                                                                                                                                                                                                                showMain('<?php echo $rowcpr1['CLIFOR'] ?? '0' ?>', 'cpc-listagem', 'financeiro/rel_tela/cpr_lista.php?tipo=<? echo $tipo ?>&indice=');
                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                              else if ($(this).val() === 'aba-item') { 
                                                                                                                                                                                                                                                $('.cpc-barra-acao').attr('style','display:none !important;'); 
                                                                                                                                                                                                                                                $('#header-fixo').show(); 
                                                                                                                                                                                                                                                $('#aba-item').show(); 
                                                                                                                                                                                                                                                showMain('<?php echo $rowcpr1['NUMEROCPR'] ?? '' ?>', 'aba-item', 'financeiro/cpr2.php?indice='); 
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
                    <option value="aba-imposto">Impostos</option>
                    <option value="todos">Todos</option>
                    <? if (($rowcpr1['NUMEROCPR'] ?? '') != '') { ?>
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
        <button id="incluir" type="button" onclick="insertform($('#formcpr1'),'clifor');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowcpr1['NUMEROCPR'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formcpr1'),'clifor');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formcpr1'),'financeiro/dml','','financeiro/cpr');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowcpr1['NUMEROCPR'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('financeiro', 'cpr1', 'numerocpr', $('#numerocpr').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','financeiro/cpr',$('#formcpr1'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','financeiro/cpr',$('#formcpr1'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','financeiro/cpr',$('#formcpr1'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','financeiro/cpr',$('#formcpr1'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formcpr1" name="formcpr1" action="financeiro/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="financeiro">
        <input id="tipodml" name="tipodml" type="hidden" value="cpr1">
        <input id="dml" name="dml" type="hidden" value="Q">
        <input id="tipo" name="tipo" type="hidden" value="<? echo $tipo ?>">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2">
                <label for="numerocpr" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formcpr1\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="numerocpr" name="numerocpr" type="text" class="form-control pk text-end" value="<? if (isset($rowcpr1['NUMEROCPR'])) echo number_format(($rowcpr1['NUMEROCPR']),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','financeiro/cpr','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <label for="clifor" class="form-label">Cli/Fornec</label>
                <div class="input-group">
                    <input id="clifor" name="clifor" type="number" class="form-control codtexto" value="<? echo $rowcpr1['CLIFOR'] ?? ''; ?>" required readonly onchange="campoLista($(this),'fornecedor','cliforselect');">
                    <input id="cliforselect" name="cliforselect" type="text" class="form-control " value="<? if (isset($rowcpr1['CLIFOR'])) echo executasqlcampo('select nome from cadastro where fornecedor =0'.$rowcpr1['CLIFOR'],$almoxa) ?? ''; ?>" required readonly autocomplete="off" compcodigo="clifor" onkeyup="buscaCampo(event,$(this),'fornecedor')">
                </div>
            </div>
            <div class="col-md-2 col-6">
                <label for="emissao" class="form-label">Emissão</label>
                <input id="emissao" name="emissao" type="date" class="form-control" value="<? if (isset($rowcpr1['EMISSAO'])) echo date('Y-m-d', strtotime($rowcpr1['EMISSAO'])) ?>" required readonly>
            </div>
            <div class="col-md-2 col-6">
                <label for="valor" class="form-label">Valor</label>
                <input id="valor" name="valor" type="text" class="form-control recebimento" value="<? if (isset($rowcpr1['VALOR'])) echo number_format($rowcpr1['VALOR'],2,',',''); ?>" style="text-align:right;"  required  readonly tipocpc="moeda">
            </div>                        
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-2">
                <label for="competencia" class="form-label">Competência</label>
                <input id="competencia" name="competencia" type="date" class="form-control" value="<? if (isset($rowcpr1['COMPETENCIA'])) echo date('Y-m-d', strtotime($rowcpr1['COMPETENCIA'])) ?>" required readonly>
            </div>
            <div class="col-md-2">
                <label for="vencimento" class="form-label">Vencimento</label>
                <input id="vencimento" name="vencimento" type="date" class="form-control" value="<? if (isset($rowcpr1['VENCIMENTO'])) echo date('Y-m-d', strtotime($rowcpr1['VENCIMENTO'])) ?>" required readonly>
            </div>
            <div class="col-md-2">
                <label for="referencia" class="form-label">Referência</label>
                <input id="referencia" name="referencia" type="text" class="form-control" value="<? echo $rowcpr1['REFERENCIA'] ?? '' ?>" maxlength="20"  readonly>
            </div>
            <div class="col-md-3">
                <label for="tipodoc" class="form-label">Tipo Doc</label>
                <select id="tipodoc" name="tipodoc" class="form-select" value="<? echo rtrim($rowcpr1['TIPODOC']) ?? ''; ?>" required disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_tipodoc'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="documento" class="form-label">Documento</label>
                <div class="input-group">
                    <input id="documento" name="documento" type="text" class="form-control" value="<? echo $rowcpr1['DOCUMENTO'] ?? '' ?>" maxlength="20"  readonly>
                    <a class="input-group-text cpcnoprint" onclick="inputbox('Documento','input_cprdoc','financeiro/cpr','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-12">
                <label for="historico" class="form-label">Histórico</label>
                <textarea id="historico" name="historico" class="form-control" rows="3" required readonly><? echo $rowcpr1['HISTORICO'] ?? ''; ?></textarea>
            </div>            
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-imposto" style="display:none">
            <div class="linha-com-nome">
                <hr><span class="nome-no-meio">Impostos/Outros</span>
            </div>
            <div class="col-md-2">
                <label for="irrf" class="form-label">IRRF</label>
                <input id="irrf" name="irrf" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['IRRF'])) echo number_format($rowcpr1['IRRF'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="pis" class="form-label">PIS</label>
                <input id="pis" name="pis" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['PIS'])) echo number_format($rowcpr1['PIS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="cofins" class="form-label">COFINS</label>
                <input id="cofins" name="cofins" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['COFINS'])) echo number_format($rowcpr1['COFINS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="cofins" class="form-label">INSS</label>
                <input id="inss" name="inss" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['INSS'])) echo number_format($rowcpr1['INSS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="csl" class="form-label">CSL</label>
                <input id="csl" name="csl" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['CSL'])) echo number_format($rowcpr1['CSL'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="iss" class="form-label">ISS</label>
                <input id="iss" name="iss" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['ISS'])) echo number_format($rowcpr1['ISS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="taxajuros" class="form-label">JUROS</label>
                <input id="taxajuros" name="taxajuros" type="text" class="form-control recebimento" value="<? if (isset($rowcpr1['TAXAJUROS'])) echo number_format($rowcpr1['TAXAJUROS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="icms" class="form-label">ICMS</label>
                <input id="icms" name="icms" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['ICMS'])) echo number_format($rowcpr1['ICMS'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="piscofinscsll" class="form-label">Outros</label>
                <input id="piscofinscsll" name="piscofinscsll" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['PISCOFINSCSLL'])) echo number_format($rowcpr1['PISCOFINSCSLL'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="glosa" class="form-label">Glosa</label>
                <input id="glosa" name="glosa" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['GLOSA'])) echo number_format($rowcpr1['GLOSA'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="desconto" class="form-label">Desconto</label>
                <input id="desconto" name="desconto" type="text" class="form-control pagamento" value="<? if (isset($rowcpr1['DESCONTO'])) echo number_format($rowcpr1['DESCONTO'],2,',',''); ?>" default="0" style="text-align:right;"  readonly tipocpc="moeda">
            </div>
            <div class="col-md-2">
                <label for="desconto" class="form-label">Total</label>
                <input id="resultado" name="desconto" type="text" class="form-control travado" value="" default="0" style="text-align:right;"  readonly tipocpc="moeda" tabindex="-1">
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
    $('.recebimento, .pagamento').on('change', function() {$('#calculasoma').click();});
    $('#calculasoma').click();
"></div>
<div id="calculasoma" onclick="
    // Função para calcular o resultado

    //console.log('load');
    //$('.recebimento, .pagamento').on('change', function() {$('#calculasoma').click();});
    var somaRecebimento = 0;
    var somaPagamento = 0;
    // Somar valores dos inputs com a classe 'recebimento'
    $('.recebimento').each(function() {
        var valor = $(this).val();
        valor = valor.replace('.', '');
        valor = valor.replace(',', '.');
        if (valor.length !== 0) {
            somaRecebimento += parseFloat(valor);
        }
    });

    // Somar valores dos inputs com a classe 'pagamento'
    $('.pagamento').each(function() {
        var valor = $(this).val();
        valor = valor.replace('.', '');
        valor = valor.replace(',', '.');
        if (valor.length !== 0) {
            somaPagamento += parseFloat(valor);
        }
    });

    // Calcular o resultado (recebimentos - pagamentos)

    var resultado = somaRecebimento - somaPagamento;
    resultado = resultado.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    // Alimentar o resultado em um input específico, por exemplo, '#resultado'
    $('#resultado').val(resultado);
    // Remove a class loadcpc para a função ser executada somente uma vez
        
    "></div>