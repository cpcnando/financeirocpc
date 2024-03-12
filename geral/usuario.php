<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../funcoes.php";
    include __DIR__."/../sgbd/fatura.php";
    $_SESSION['ACESSO'] = 'Usuários';
    include __DIR__."/../sgbd/acesso.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from usuarios where codigo =0".$_GET['indice'];
     foreach ($fatura->query($sql) as $rowusuarios) {
     if (isset($rowusuarios['CODIGO'])) $rowusuarios['CODIGO'] = number_format(($rowusuarios['CODIGO'] ?? '0'),0,'','');
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
                                                                                                                                                                                                                                                showMain('usuarios<?php echo $rowusuarios['CODIGO'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice=');
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
                    <? if (($rowusuarios['CODIGO'] ?? '') != '') { ?>
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
        <button id="incluir" type="button" onclick="insertform($('#formusuarios'),'a_nome');" class="btn btn-outline-primary btn-sm cpcnoprint incluir d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus me-sm-1"></i><div class="cpc-nomobile"><strong><u>I</u></strong>ncluir</div>
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint editar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowusuarios['CODIGO'] ?? '') == '') echo 'disabled'?> onclick="editform($('#formusuarios'),'a_nome');">
            <i class="fa fa-pencil me-sm-1"></i><div class="cpc-nomobile"><strong><u>E</u></strong>ditar</div>
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button id="salvar" class="btn btn-outline-success btn-sm cpcnoprint salvar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" disabled  onclick="dmlitem($('#formusuarios'),'geral/dml','','geral/usuario');">
            <i class="fa fa-check me-sm-1"></i><div class="cpc-nomobile"><strong><u>S</u></strong>alvar</div>
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint deletar d-inline-flex d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowusuarios['CODIGO'] ?? '') == '') echo 'disabled'?> onclick="deleteitem('fatura', 'usuarios', 'codigo', $('#codigo').val(),'','incluir');">
            <i class="fa fa-trash me-sm-1"></i><div class="cpc-nomobile">Deletar</div>
        </button>
        <?} ?>
        <a class="btn btn-outline-warning  btn-sm cpcnoprint outro" onmouseup="showMain('tela_add','listapopupcpc','./listapopup_get.php?indice=');">
            ...
        </a>
        <div>
            <button type="button" class="btn btn-primary btn-sm navfirst" data-bs-toggle="tooltip" title="Primeiro registro" onclick="navegador('F','geral/usuario',$('#formusuarios'))"><i class="fa-solid fa-backward-step"></i></button>
            <button type="button" class="btn btn-primary btn-sm navprior" data-bs-toggle="tooltip" title="Registro Anterior" onclick="navegador('P','geral/usuario',$('#formusuarios'))"><i class="fa-solid fa-caret-left"></i></button>
            <button type="button" class="btn btn-primary btn-sm navnext" data-bs-toggle="tooltip" title="Próximo registro"  onclick="navegador('N','geral/usuario',$('#formusuarios'))"><i class="fa-solid fa-caret-right"></i></button>
            <button type="button" class="btn btn-primary btn-sm navlast" data-bs-toggle="tooltip" title="Último registro"   onclick="navegador('L','geral/usuario',$('#formusuarios'))"><i class="fa-solid fa-forward-step"></i></button>
        </div>
    </div>
</div>
<div id="cpc-autoheight" class="card container" style="overflow-y: auto;">
    <form id="formusuarios" name="formusuarios" action="geral/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input id="tipodml" name="tipodml" type="hidden" value="usuarios">
        <input id="tiposgbd" name="tiposgbd" type="hidden" value="fatura">
        <input id="dml" name="dml" type="hidden" value="Q">
        <div id="header-fixo" class="row g-1 cpc-abas-padrao">
            <div class="col-md-2 col-4">
                <label for="codigo" class="form-label" <?php if ($_SESSION['config']['dev'] == 'S') echo 'onclick="listarNomesCampos(\'formusuarios\')"'; ?>>Cod</label>
                <div class="input-group">
                <input id="codigo" name="codigo" type="text" class="form-control pk text-end" value="<? if (isset($rowusuarios['CODIGO'])) echo number_format(($rowusuarios['CODIGO']),0,'',''); ?>" readonly>
                <a class="input-group-text cpcnoprint pesquisar" onclick="inputbox('Código','inputnumber','geral/usuario','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
            <div class="col-md-10 col-8">
                <label for="a_nome" class="form-label">Nome Completo</label>
                <div class="input-group">
                    <input id="a_nome" name="a_nome" type="text" class="form-control" value="<? echo $rowusuarios['A_NOME'] ?? '' ?>" readonly required oninput="$(this).val($(this).val().toUpperCase())" size="100">
                    <a class="input-group-text cpcnoprint" onclick="inputbox('Usuario','input_usuario','geral/usuario','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-2">
                <label for="apelido" class="form-label">Apelido</label>
                <input id="apelido" name="apelido" type="text" class="form-control" value="<? echo $rowusuarios['APELIDO'] ?? '' ?>" maxlength="30"  readonly>
            </div>
            <div class="col-md-2">
                <label for="cep" class="form-label">CEP</label>
                <input id="cep" name="cep" type="text" class="form-control" value="<? echo $rowusuarios['CEP'] ?? '' ?>" uf="uf" cidade="cidade" bairro="bairro" logradouro="endereco" onchange="cepBusca($(this))" readonly tipocpc="cep">
            </div>
            <div class="col-md-2">
                <label for="uf" class="form-label">UF</label>
                <select id="uf" name="uf" class="form-select" value="<? echo $rowusuarios['UF'] ?? ''; ?>" default="BA" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_uf'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input id="cidade" name="cidade" type="text" class="form-control" value="<? echo $rowusuarios['CIDADE'] ?? '' ?>" maxlength="20"  readonly>
            </div>
            <div class="col-md-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input id="bairro" name="bairro" type="text" class="form-control" value="<? echo $rowusuarios['BAIRRO'] ?? '' ?>" maxlength="20"  readonly>
            </div>
            <div class="col-md-4">
                <label for="endereco" class="form-label">Endereço</label>
                <input id="endereco" name="endereco" type="text" class="form-control" value="<? echo $rowusuarios['ENDERECO'] ?? '' ?>" maxlength="50"  readonly>
            </div>
            <div class="col-md-2">
                <label for="telefone1" class="form-label">Telefone</label>
                <input id="telefone1" name="telefone1" type="text" class="form-control" value="<? if (isset($rowusuarios['TELEFONE1'])) echo number_format($rowusuarios['TELEFONE1'],2,',',''); ?>" readonly tipocpc="tel">
            </div>
            <div class="col-md-2">
                <label for="celular" class="form-label">Celular</label>
                <input id="celular" name="celular" type="text" class="form-control" value="<? if (isset($rowusuarios['CELULAR'])) echo number_format($rowusuarios['CELULAR'],2,',',''); ?>" readonly required tipocpc="cel">
            </div>
            <div class="col-md-3">
                <label for="a_cpf" class="form-label">CPF</label>
                <input id="a_cpf" name="a_cpf" type="text" class="form-control cpf" value="<? echo $rowusuarios['A_CPF'] ?? '' ?>" readonly  tipocpc="cpf" onchange="validarCPF($(this));">
            </div>
            <div class="col-md-1 btn btn-outline-secondary">
                <label for="ativo" class="form-label">ativo</label><br>
                <input id="ativo" name="ativo" type="checkbox" class="form-check-input" checado="S" nchecado="N" default="S" <? if (($rowusuarios['ATIVO'] ?? '') === "S") echo 'checked' ?> disabled><br>
            </div>
        </div>
    </form>
    <div id="cpc-anexo" class="row g-1 cpc-abas" style="display:none">
    </div>
    <div id="cpc-listagem" class="row g-1 cpc-abas" style="display:none">
    </div>
</div>