<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/fatura.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from empresas where codigo =0".$_GET['indice'];
     foreach ($fatura->query($sql) as $rowempresa) {}
     if (isset($rowempresa['CODIGO'])) $rowempresa['CODIGO'] = number_format(($rowempresa['CODIGO'] ?? '0'),0,'','');
?>
<div class="card my-2 container">
    <div class="card-head h3 text-center">
        Cadastro de Empresa
    </div>
</div>

<div class="cpc-empresa">
    <div class="container cpc-tabs" id="cpc-dados" style="overflow-y: auto;height: calc(100vh - 190px);">
        <div class="card">
            <div class="cpcnoprint">
                <nav class="nav nav-tabs d-flex justify-content-evenly" role="tablist">                        
                    <button class="nav-link active p-2" id="nav-cpc-chamado" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-item" aria-selected="true" onclick="$('.cpc-tabs').hide(); $('#cpc-dados').show(); ">Dados</button>
                    <button class="nav-link p-2" id="nav-cpc-chamado-resp" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-item" aria-selected="flase" onclick="$('.cpc-tabs').hide(); $('#cpc-anexo').show(); ">Documentos</button>
                </nav>
            </div>

            <div class="card-body">                
                <form name="formempresa" id="formempresa" action="geral/dml.php" class="row g-3" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="tipodml" name="tipodml" value="empresas">                    
                    <div class="col-2">
                        <label class="form-label">Cód</label>
                        <div class="input-group">
                        <input type="text" class="form-control pk text-end" name="codigo" id="codigo" value="<? if (isset($rowempresa['CODIGO'])) echo number_format(($rowempresa['CODIGO'] ?? '0'),0,'',''); ?>" onchange="" readonly>
                        <span class="input-group-text"><a href="" onclick="inputbox('Código','inputnumber','geral/empresa','cpcMain')"><i class="fa fa-search"></i></a></span>
                        </div>
                    </div>                    
                    <div class="col-4">
                        <label class="form-label">Nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="razaosocial" id="razaosocial" value="<? echo $rowempresa['RAZAOSOCIAL'] ?? '' ?>" required  >
                            <span class="input-group-text"><a href="" onclick="inputbox('Empresa','input_empresa','geral/empresa','cpcMain')"><i class="fa fa-search"></i></a></span>
                        </div>
                        
                    </div>
                    <div class="col-3">
                        <label class="form-label">CNPJ</label>
                        <input type="text" class="form-control" name="cnpj" id="cnpj" value="<? echo $rowempresa['CNPJ'] ?? '' ?>" maxlength="2">
                    </div>
                    <div class="col-3">
                        <label class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" uf="uf" cidade="cidade" bairro="bairro" logradouro="endereco" id="cep" value="<? echo $rowempresa['CEP'] ?? '' ?>" maxlength="8" onblur="cepBusca($(this))" readonly>
                    </div>
                    <div class="col-3">
                        <label class="form-label">UF</label>
                        <input type="text" class="form-control" name="uf" id="uf" value="<? echo $rowempresa['UF'] ?? '' ?>" maxlength="2">
                    </div>
                    <div class="col-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" value="<? echo $rowempresa['CIDADE'] ?? '' ?>">
                    </div>
                    <div class="col-3">
                        <label class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" value="<? echo $rowempresa['BAIRRO'] ?? '' ?>">
                    </div>
                    <div class="col-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" value="<? echo $rowempresa['ENDERECO'] ?? '' ?>">
                    </div>
                    <div class="col-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="<? echo $rowempresa['TELEFONE'] ?? '' ?>">
                    </div>
                    <div class="col-12 d-flex justify-content-evenly cpcnoprint">
                        <button type="button" id="incluir" onclick="insertform($('#formempresa'),'razaosocial');" class="btn btn-outline-primary btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fa fa-plus"></i> Incluir
                        </button>
                        <button onclick="editform($('#formempresa'),'razaosocial');" id="editar" class="btn btn-outline-secondary btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowempresa['CODIGO'] ?? '') == '') echo 'disabled'?>>
                            <i class="fa fa-pencil"></i> Editar
                        </button>
                        <button onclick="dmlitem($('#formempresa'),'geral/dml','','geral/empresa');" id="salvar" class="btn btn-outline-success btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" disabled>
                            <i class="fa fa-check"></i> Salvar
                        </button>
                        <button onclick="deleteitem('fatura', 'empresas', 'codigo', $('#codigo').val(),'','incluir');" id="deletar" class="btn btn-outline-danger btn-sm cpcnoprint" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowempresa['CODIGO'] ?? '') == '') echo 'disabled'?>>
                            <i class="fa fa-trash"></i> Deletar
                        </button>
                        <a href="#popupNested" class="btn btn-outline-warning  btn-sm cpcnoprint" style="color: #ffffff" onmouseup="showMain('tela_add','listapopup','./listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true"  data-bs-toggle="tooltip" data-bs-placement="top">
                            ...
                        </a>
                    </div>
                </form> 
            </div>
        </div>
    </div>               


</div>            

