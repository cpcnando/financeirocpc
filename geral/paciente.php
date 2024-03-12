<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/fatura.php";
    $_SESSION['ACESSO'] = 'Pacientes';
    include __DIR__."/../sgbd/acesso.php";
    $tela = 'geral/paciente';
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from paciente where codigopac =0".$indice = filter_input(INPUT_GET, 'indice', FILTER_SANITIZE_NUMBER_INT);
     foreach ($fatura->query($sql) as $rowpaciente) {} 
     if (isset($rowpaciente['CODIGOPAC'])) $rowpaciente['CODIGOPAC'] = number_format(($rowpaciente['CODIGOPAC'] ?? '0'),0,'','');
?>

<div class="card container my-2" id="cpc-topo">
    <div class="row card-head h3 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <div class="input-group text-center">
                <span class="input-group-text cpcnoprint"><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                <select class="form-select form-select-sm cpcnoupdate" id="abaitem" value="aba-dados" onchange="if ($(this).val() === 'documentos') { $('.cpc-abas').hide(); $('#cpc-anexo').show(); showMain('paciente<?php echo $rowpaciente['CODIGOPAC'] ?? '' ?>', 'cpc-anexo', 'geral/bancoimagem.php?indice='); } else if ($(this).val() === 'listagem') { $('.cpc-abas').hide(); $('#header-fixo').hide(); $('#cpc-listagem').show(); showMain('<?php echo $_SESSION['ACESSO']; ?>', 'cpc-listagem', 'geral/lista.php?tipo='); } else if ($(this).val() === 'todos') { $('.cpc-abas').hide();  $('.aba-cad').show(); } else { $('.cpc-abas').hide();$('#header-fixo').show();$('.' + $(this).val()).show(); }">
                    <option value="aba-dados" selected>Dados</option>
                    <option value="aba-documentacao">Documentação</option>
                    <option value="aba-extra">Extra</option>
                    <option value="aba-observacao">Observação</option>
                    <option value="todos">Todos</option>
                    <? if (($rowpaciente['CODIGOPAC'] ?? '') != '') { ?>
                    <option disabled><hr></option>
                    <option value="aba-servicos">Serviços</option>
                    <option value="documentos">Docs Digitais</option>                    
                    <? }  ?>
                    <option value="listagem">Listagem</option> 
                </select>
            </div>                
            
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-evenly cpcnoprint mb-2"> 
        <? if ($rowacesso['DML_I'] === 'S') { ?>
        <button type="button" id="incluir" onclick="insertform($('#formpaciente'),'a_nome');" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="fa fa-plus"></i> Incluir
        </button>
        <? } if ($rowacesso['DML_U'] === 'S') { ?>
        <button onclick="editform($('#formpaciente'),'a_nome');" id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowpaciente['CODIGOPAC'] ?? '') == '') echo 'disabled'?>>
            <i class="fa fa-pencil"></i> Editar
        </button>
        <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
        <button onclick="dmlitem($('#formpaciente'),'geral/dml','','geral/paciente');" id="salvar" class="btn btn-outline-success btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" disabled>
            <i class="fa fa-check"></i> Salvar
        </button>
        <? } if ($rowacesso['DML_D'] === 'S') { ?>
        <button onclick="deleteitem('fatura', 'paciente', 'codigopac', $('#codigopac').val(),'','incluir');" id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowpaciente['CODIGOPAC'] ?? '') == '') echo 'disabled'?>>
            <i class="fa fa-trash"></i> Deletar
        </button>
        <?} ?>
        <div class="dropdown">
            <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Outros
            </button>
            <ul class="dropdown-menu">
                <li><a role="reset" class="dropdown-item" href="#">Cancelar</a></li>
                <li><a class="dropdown-item" role="button" onclick="Imprimir('./impressos/registro_pac.php?indice=<?echo $rowpaciente['CODIGOPAC']?>','imp_pac')" id="imp_pac">Imprimir Registro</a></li>                
            </ul>
        </div>
    </div>

</div>


<div class="card container" style="overflow-y: auto;" id="cpc-autoheight">        
    <form name="formpaciente" id="formpaciente" action="geral/dml.php" class="row g-1" enctype="multipart/form-data" method="post">
        <input type="hidden" id="tipodml" name="tipodml" value="paciente">
        <div class="row g-1" id="header-fixo">
            <div class="col-md-2">
                <label class="form-label">Cód</label>
                <div class="input-group">
                <input type="text" class="form-control pk text-end" name="codigopac" id="codigopac" value="<? if (isset($rowpaciente['CODIGOPAC'])) echo number_format(($rowpaciente['CODIGOPAC'] ?? '0'),0,'',''); ?>" onchange="" readonly>
                <span class="input-group-text cpcnoprint"><a href="" onclick="inputbox('Código','inputnumber','geral/paciente','cpcMain')"><i class="fa fa-search"></i></a></span>
                </div>
            </div>                    
            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="a_nome" id="a_nome" value="<? echo $rowpaciente['A_NOME'] ?? '' ?>" maxlength=50 oninput="$(this).val($(this).val().toUpperCase())" onchange="if ($('#segurado').val() === '') $('#segurado').val($(this).val()) " required  readonly>
                    <span class="input-group-text cpcnoprint" ><a href="" onclick="inputbox('Paciente','input_paciente','geral/paciente','cpcMain')" tabindex="-1"><i class="fa fa-search"></i></a></span>
                </div>
            </div>
            <div class="col-md-3">
            <label class="form-label">Convênio</label>
                <select class="form-select" name="convenio" id="convenio" required value="<? if ((isset($rowpaciente['CONVENIO'])) && ($rowpaciente['CONVENIO'] != 0)) echo $rowpaciente['CONVENIO']; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'fat_convenio'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Matricula</label>
                <input type="number" class="form-control" name="matricula" id="matricula" value="<? echo $rowpaciente['MATRICULA'] ?? '' ?>" maxlength="30" readonly>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-dados">
            <div class="linha-com-nome m-2">
                <hr>
                <span class="nome-no-meio">Dados</span>
            </div>
            <div class="col-md-4">
                <label class="form-label">Titular</label>
                <input type="text" class="form-control" name="segurado" id="segurado" value="<? echo $rowpaciente['SEGURADO'] ?? '' ?>" maxlength="50" readonly>
            </div>
            <div class="col-md-2">
                <label for="inputState" class="form-label">Sexo</label>
                <select class="form-select" name="sexo" id="sexo" value="<? echo $rowpaciente['SEXO'] ?? ''; ?>" required disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_sexo'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Data de Nasc.</label>
                <input type="date" class="form-control" name="nasc" id="nasc" value="<?= $rowpaciente['NASC'] ? date('Y-m-d', strtotime($rowpaciente['NASC'])) : '' ?>" maxlength="8" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Celular</label>
                <input type="text" class="form-control telefone" name="celular" id="celular" value="<?= $rowpaciente['CELULAR'] ?? '' ?>" size="15" readonly>
            </div>
            <div class="col-md-1">
                <div class="input-group-text d-flex justify-content-evenly">
                    <div class="input-group-prepend">
                        <input type="checkbox" class="form-check-input" name="ativo" id="ativo" checado="S" nchecado="N" default="S" <? if (($rowpaciente['ATIVO'] ?? '') === "S") echo 'checked' ?> disabled>
                        <label class="form-check-label" for="ativo">Ativo</label>
                    </div>
                </div>
            </div> 
            <div class="col-md-2">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep" uf="uf" cidade="cidade" bairro="bairro" logradouro="endereco" id="cep" value="<? echo $rowpaciente['CEP'] ?? '' ?>" maxlength="8" onblur="cepBusca($(this))" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">UF</label>
                <select class="form-select" name="uf" id="uf"  value="<? if ((isset($rowpaciente['UF'])) && ($rowpaciente['UF'] != 0)) echo $rowpaciente['UF']; ?>" default="BA" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_uf'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" name="cidade" id="cidade" value="<? echo $rowpaciente['CIDADE'] ?? '' ?>" maxlength="100" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" value="<? echo $rowpaciente['BAIRRO'] ?? '' ?>" maxlength="20" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="endereco" value="<? echo $rowpaciente['ENDERECO'] ?? '' ?>" maxlength="50" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo Log</label>
                <select class="form-select" name="cod_logradouro" id="cod_logradouro" value="<? if ((isset($rowpaciente['COD_LOGRADOURO'])) && ($rowpaciente['COD_LOGRADOURO'] != 0)) echo $rowpaciente['COD_LOGRADOURO']; ?>" disabled>
                    <option></option>
                    <? $_SESSION['listagem'] = 'fat_tiss11'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-1">
                <label class="form-label">Num</label>
                <input type="text" class="form-control" name="numero" id="numero" value="<? echo $rowpaciente['NUMERO'] ?? '' ?>" maxlength="8" readonly>
            </div>
            <div class="col-md-5">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control" name="complemento" id="complemento" value="<? echo $rowpaciente['COMPLEMENTO'] ?? '' ?>" maxlength="20" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control telefone" name="telefone" id="telefone" value="<? echo $rowpaciente['TELEFONE'] ?? '' ?>" maxlength="15" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Trabalho (Tel)</label>
                <input type="text" class="form-control telefone" name="telefone3" id="telefone3" value="<? echo $rowpaciente['TELEFONE3'] ?? '' ?>" maxlength="15" readonly>
            </div>
            <div class="col-md-9">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control email" name="email" id="email" value="<? echo $rowpaciente['EMAIL'] ?? '' ?>" maxlength="60" readonly>
            </div>
        </div>

        <div class="row g-1 cpc-abas aba-cad aba-documentacao" style="display:none">
            <div class="linha-com-nome m-2">
                <hr>
                <span class="nome-no-meio">Documentação</span>
            </div>
            <div class="col-md-2">
                <label class="form-label">Identidade</label>
                <input type="text" class="form-control" name="identidade" id="identidade" value="<? echo $rowpaciente['IDENTIDADE'] ?? '' ?>" maxlength="15" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Org. Emissor</label>
                <input type="text" class="form-control" name="rgorgao" id="rgorgao" value="<? echo $rowpaciente['RGORGAO'] ?? '' ?>" maxlength="10" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Dt. Exp.</label>
                <input type="date" class="form-control" name="dataexpedicao" id="dataexpedicao" value="<?= $rowpaciente['DATAEXPEDICAO'] ? date('Y-m-d', strtotime($rowpaciente['DATAEXPEDICAO'])) : '' ?>" maxlength="11" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">UF RG</label>
                <select class="form-select" name="rguf" id="rguf"  value="<? if ((isset($rowpaciente['RGUF'])) && ($rowpaciente['RGUF'] != 0)) echo $rowpaciente['RGUF']; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_uf'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Certidão Nasc</label>
                <input type="text" class="form-control" name="certidaonasc" id="certidaonasc" value="<? echo $rowpaciente['CERTIDAONASC'] ?? '' ?>" maxlength="40" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="a_cpf" id="a_cpf" value="<? echo $rowpaciente['A_CPF'] ?? '' ?>" maxlength="11" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Pai</label>
                <input type="text" class="form-control" name="pai" id="pai" value="<? echo $rowpaciente['PAI'] ?? '' ?>" maxlength="50" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Mãe</label>
                <input type="text" class="form-control" name="mae" id="mae" value="<? echo $rowpaciente['MAE'] ?? '' ?>" maxlength="50" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nacionalidade</label>
                <select class="form-select" name="nacionalidade" id="nacionalidade"  value="<? if ((isset($rowpaciente['NACIONALIDADE'])) && ($rowpaciente['NACIONALIDADE'] != 0)) echo $rowpaciente['NACIONALIDADE']; ?>" default="010" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_pais'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Naturalidade</label>
                <input type="text" class="form-control" name="naturalidade" id="naturalidade" value="<? echo $rowpaciente['NATURALIDADE'] ?? '' ?>" maxlength="25" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">UF Nasc</label>
                <select class="form-select" name="uf_nasc" id="uf_nasc"  value="<? if ((isset($rowpaciente['UF_NASC'])) && ($rowpaciente['UF_NASC'] != 0)) echo $rowpaciente['UF_NASC']; ?>" default="BA" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_uf'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Est. Civil</label>
                <select class="form-select" name="civil" id="civil"  value="<? echo $rowpaciente['CIVIL'] ?? '' ?>" disabled>
                <option></option>
                <? //$_SESSION['listagem'] = 'json_civil'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Escolaridade</label>
                <select class="form-select" name="escolaridade" id="escolaridade"  value="<? echo $rowpaciente['ESCOLARIDADE'] ?? ''; ?>" disabled>
                <option></option>
                <? //$_SESSION['listagem'] = 'json_escolaridade'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Trabalho</label>
                <input type="text" class="form-control" name="trabalho" id="trabalho" value="<? echo $rowpaciente['TRABALHO'] ?? '' ?>" maxlength="40" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Cor</label>
                <select class="form-select" name="cor" id="cor"  value="<? if ((isset($rowpaciente['COR'])) && ($rowpaciente['COR'] != 0)) echo $rowpaciente['COR']; ?>" disabled>
                <option></option>
                <? //$_SESSION['listagem'] = 'json_cor'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div> 
            <div class="col-md-2">
                <label class="form-label">Etnia</label>
                <select class="form-select" name="etnia" id="etnia"  value="<? if ((isset($rowpaciente['ETNIA'])) && ($rowpaciente['ETNIA'] != 0)) echo $rowpaciente['ETNIA']; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'fat_etnia'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-extra" style="display:none">
            <div class="linha-com-nome m-2">
                <hr>
                <span class="nome-no-meio">Extras</span>
            </div>
            <div class="col-md-2">
                <label class="form-label">Empresa</label>
                <input type="text" class="form-control" name="trabalho1" id="trabalho1" value="<? echo $rowpaciente['TRABALHO1'] ?? '' ?>" maxlength="50" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Validade</label>
                <input type="date" class="form-control" name="validade" id="validade" value="<?= $rowpaciente['VALIDADE'] ? date('Y-m-d', strtotime($rowpaciente['VALIDADE'])) : '' ?>" maxlength="11" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Produto</label>
                <input type="text" class="form-control" name="produto" id="produto" value="<? echo $rowpaciente['PRODUTO'] ?? '' ?>" maxlength="10" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Cadastrado em</label>
                <input type="date" class="form-control travado" name="data1" id="data1" value="<?= $rowpaciente['DATA1'] ? date('Y-m-d', strtotime($rowpaciente['DATA1'])) : '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Ult. Consulta</label>
                <input type="date" class="form-control travado" name="consulta" id="consulta" value="<?= $rowpaciente['CONSULTA'] ? date('Y-m-d', strtotime($rowpaciente['CONSULTA'])) : '' ?>" maxlength="11" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Vinc. Previdência</label>
                <select class="form-select" name="previdencia" id="previdencia"  value="<? if ((isset($rowpaciente['PREVIDENCIA'])) && ($rowpaciente['PREVIDENCIA'] != 0)) echo $rowpaciente['PREVIDENCIA']; ?>" disabled>
                <option></option>
                <? $_SESSION['listagem'] = 'json_previdencia'; include __DIR__."\..\listagem.php" ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Plano</label>
                <input type="text" class="form-control" name="plano" id="plano" value="<? echo $rowpaciente['PLANO'] ?? '' ?>" maxlength="20" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">CNS</label>
                <input type="text" class="form-control" name="cartao" id="cartao" value="<? echo $rowpaciente['CARTAO'] ?? '' ?>" maxlength="20" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">SISPrenatal</label>
                <input type="text" class="form-control" name="sisprenatal" id="sisprenatal" value="<? echo $rowpaciente['SISPRENATAL'] ?? '' ?>" maxlength="25" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Bolsa Família</label>
                <select class="form-select"name="bolsafamilia" id="bolsafamilia" value="<? echo $rowpaciente['BOLSAFAMILIA'] ?? ''?>" disabled>
                    <option value=""></option>
                    <option value="S">S</option>
                    <option value="N">N</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Área</label>
                <input type="number" class="form-control" name="area" id="area" value="<? echo $rowpaciente['AREA'] ?? '' ?>"  readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Micro Área</label>
                <input type="number" class="form-control" name="microarea" id="microarea" value="<? echo $rowpaciente['MICROAREA'] ?? '' ?>" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Gr. Sang.</label>
                <input type="text" class="form-control" name="sangue" id="sangue" value="<? echo $rowpaciente['SANGUE'] ?? '' ?>" maxlength="2" readonly>
            </div>
            <div class="col-md-2">
                <label class="form-label">Fator RH</label>
                <input type="text" class="form-control" name="fatorrh" id="fatorrh" value="<? echo $rowpaciente['FATORRH'] ?? '' ?>" maxlength="1" readonly>
            </div>
            <div class="col-md-8">
                <label class="form-label">Necessidade Especial</label>
                <input type="text" class="form-control" name="preferencia" id="preferencia" value="<? echo $rowpaciente['PREFERENCIA'] ?? '' ?>" maxlength="50" readonly>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-cad aba-observacao" style="display:none">
            <div class="linha-com-nome m-2">
                <hr>
                <span class="nome-no-meio">Observação</span>
            </div>
            <div class="col-12">
                <textarea class="form-control" rows="10" name="observacao" id="observacao"  readonly><? echo $rowmodalidade['OBSERVACAO'] ?? ''; ?></textarea>
            </div>
        </div>
        <div class="row g-1 cpc-abas aba-servicos mt-2" style="display:none">
            <div class="linha-com-nome m-2">
                <hr>
                <span class="nome-no-meio">Serviços</span>
            </div>
            <div class="col-md-2">
                <label class="form-label">Identidadex</label>
                <input type="text" class="form-control" name="identidadex" id="identidadex" value="<? echo $rowpaciente['IDENTIDADEX'] ?? '' ?>" maxlength="11" readonly>
            </div>
        </div>
    </form>     
    <div class="row g-1 cpc-abas mt-2" id="cpc-anexo" style="display:none">
    </div>                            
    <div class="row g-1 cpc-abas mt-2" id="cpc-listagem" style="display:none">
    </div>
</div>




