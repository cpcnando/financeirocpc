<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/almoxa.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from entra1 where numero =0".$_GET['indice'];
     foreach ($almoxa->query($sql) as $rowentra1) {}
?>
<div class="container mb-1 mt-1">
    <div class="cpcnoprint">
        <button class="mt-1 btn btn-outline-primary" id="nav-cpc-entrada" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-item" aria-selected="true" onclick="$('.cpc-tabs').hide(); $('#cpc-dados').show(); $(this).addClass('active');" onblur="$(this).removeClass('active');">Dados</button>
        <button class="mt-1 btn btn-outline-primary <? if (($rowentra1['NUMERO'] ?? '') == '') echo ' collapse"'?>" id="nav-cpc-parcela" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-pront" aria-selected="false" onclick="$('.cpc-tabs').hide(); $('#cpc-financeiro').show(); $(this).addClass('active');" onblur="$(this).removeClass('active');" aria-controls="nav-pront" aria-selected="false">Financeiro</button>
        <button class="mt-1 btn btn-outline-primary" id="nav-cpc-nat-operacao" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-item" aria-selected="flase" onclick="$('.cpc-tabs').hide(); $('#cpc-listagem').show(); $(this).addClass('active');" onblur="$(this).removeClass('active');">Listagem</button>
        <button class="mt-1 btn btn-outline-primary" id="nav-cpc-nat-operacao" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-item" aria-selected="flase" onclick="$('.cpc-tabs').hide(); $('#cpc-documentos').show(); $(this).addClass('active');" onblur="$(this).removeClass('active');">Documentos</button>
    </div>
</div>
<div class="cpc-entrada">
    <div class="container cpc-tabs" id="cpc-dados" style="overflow-y: auto;height: calc(100vh - 190px);">
        <div class="card">
            <div class="card-header h3 text-center" >            
                Cadastro de Entrada             
            </div>            
            <div class="card-body">                
                <form name="formentrada" id="formentrada" action="estoque/dml.php" class="row g-3" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="tipodml" name="tipodml" value="entra1">
                    <div class="col-sm-2 col-md-2">
                        <label class="form-label">Cód</label>
                        <div class="input-group">
                        <input type="number" class="form-control pk text-end" name="numero" id="numero" value="<? echo number_format($rowentra1['NUMERO'],0,'','') ?? ''; ?>" onchange="" readonly>
                        <span class="input-group-text"><a href="" onclick="inputbox('Código','inputnumber','estoque/entrada','cpcMain')"><i class="fa fa-search"></i></a></span>
                        </div>
                    </div>        
                    
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label">Fornecedor</label>
                        <select class="form-select" name="clifor" id="clifor" required value="<? echo $rowentra1['CLIFOR'] ?? ''; ?>" disabled>
                        <option></option>
                        <? $_SESSION['listagem'] = 'etq_fornecedor'; include __DIR__."\..\listagem.php" ?>
                                        
                        </select>
                    </div>             
                    <div class="col-sm-2 col-md-2">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" name="data" id="data" value="<? echo date('Y-m-d',strtotime($rowentra1['DATA'])) ?>" default="<? echo date('Y-m-d') ?>" required  readonly>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <label class="form-label">Hora</label>
                        <input type="time" class="form-control" name="hora" id="hora" value="<? echo date('H:i',strtotime($rowentra1['HORA'])) ?>" default="<? echo date('H:i') ?>" required  readonly>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <label class="form-label">Data NF</label>
                        <input type="date" class="form-control" name="dataentr" id="dataentr" value="<? echo date('Y-m-d',strtotime($rowentra1['DATAENTR'])) ?>" default="<? echo date('Y-m-d') ?>" readonly>
                    </div>                   
                    <div class="col-sm-12 col-md-4">
                        <label class="form-label">Centro de Custo</label>
                        <select class="form-select" name="ccusto" id="ccusto" required value="<? echo $rowentra1['CCUSTO'] ?? ''; ?>" disabled>
                        <option></option>
                        <? $_SESSION['listagem'] = 'etq_ccusto'; include __DIR__."\..\listagem.php" ?>
                                        
                        </select>
                    </div> 
                    <div class="col-sm-2 col-md-2">
                        <label class="form-label">Numero NF</label>
                        <input type="text" class="form-control" name="numeronf" id="numeronf" value="<?=$rowentra1['NUMERONF'] ?? ''?>" readonly>
                    </div>                   
                    <div class="col-sm-4 col-md-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipoentrada" id="tipoentrada" required default="1" value="<? echo $rowentra1['TIPOENTRADA'] ?? ''; ?>"  disabled>
                        <option></option>
                        <option value="1">1 - Entrada</option>
                        <option value="2">2 - Emprestimo</option>
                        <option value="3">3 - Pag. de Emprestimo</option>
                        <option value="4">4 - Devolução de Emprestimo</option>
                        <option value="5">5 - Fracionado</option>
                        <option value="6">6 - Doação</option>
                        <option value="7">7 - Consignados</option>
                        <option value="8">8 - Comodato</option>
                        <option value="9">9 - Ajuste no Estoque</option>
                        <option value="0">0 - Troca</option>
                        <option value="P">P - Trnasf. Entre Projetos</option>
                        <option value="F">F - Fundo Fixo</option>
                        <option value="B">B - Bonificação</option>                       
                        </select>
                    </div>                    
                    <div class="col-sm-4 col-md-3">
                        <label class="form-label">Destinação</label>
                        <select class="form-select" name="tipo2" id="tipo2" required default="1" value="<?=$rowentra1['TIPO2'] ?? ''; ?>"  disabled>
                        <option></option>
                            <option value="1">Aplicação Direta</option>
                            <option value="2">Ressuprimento</option>
                            <option value="3">Estoque Fornecedor</option>
                        </select>
                    </div>                                                           
                 
                    <div class="col-12 d-flex justify-content-evenly">
                        <button type="button" id="incluir" onclick="insertform($('#formentrada'),'ccusto');" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top">
                            <i class="fa fa-plus"></i> Incluir
                        </button>
                        <button onclick="editform($('#formentrada'),'conta');" id="editar" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowentra1['NUMERO'] ?? '') == '') echo 'disabled'?>>
                            <i class="fa fa-pencil"></i> Editar
                        </button>
                        <button onclick="dmlitem($('#formentrada'),'estoque/dml','','estoque/entrada');" id="salvar" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" disabled>
                            <i class="fa fa-check"></i> Salvar
                        </button>
                        <button onclick="deleteitem('almoxa', 'entra1', 'numero', $('#numero').val(),'','incluir');" id="deletar" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" <? if (($rowentra1['NUMERO'] ?? '') == '') echo 'disabled'?>>
                            <i class="fa fa-trash"></i> Deletar
                        </button>
                        <a href="#popupNested" class="btn btn-outline-warning  btn-sm"  onmouseup="showMain('fin_telas_mov','listapopup','./listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true"  data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar/Voltar">
                            ...
                        </a>
                    </div>
                </form> 
            </div>
        </div>
        <? if (($rowentra1['NUMERO'] ?? '') != '') {?>            
                <div class="card mt-1">
                    <div class="card-body " >                        
                        <div class="card-header text-center h4 mt-3">Produtos  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLabel1">Add <i class="fa-solid fa-square-plus" <? if (($rowentra1['NUMERO'] ?? '') == '') echo ' collapse"'?>></i></button></div>
                        <div id="meu-card" style="max-width: auto; max-height: calc(60vh - 80px); overflow: auto;">
                            <div id="entra2" class="mt-3">
                                <? include "entra2.php"?>
                            </div>
                        </div>
                    </div>
                </div>            
        <?}?>                                                

    </div>                              
    <div class="container cpc-tabs" id="cpc-financeiro" style="display:none">
        <div class="card">
            <div class="card-body">
            <div class="card-header text-center h4">Parcelas<a href="" onclick="$('#formentra3').toggleClass('collapse')"><i class="fa-solid fa-square-plus ms-4 <? if (($rowentra1['NUMERO'] ?? '') == '') echo ' collapse"'?>"></i></a></div>        
                <div id="meu-card" style="max-width: auto; max-height: calc(60vh - 80px); overflow: auto;">
                    <div id="entra3">
                        <? include "entra3.php"?>
                    </div>                        
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <div class="card-header text-center h4">Rateio<a href="" onclick="$('#formentra4').toggleClass('collapse')"><i class="fa-solid fa-square-plus ms-4 <? if (($rowentra1['NUMERO'] ?? '') == '') echo ' collapse"'?>"></i></a></div>        
                <div id="meu-card" style="max-width: auto; max-height: calc(60vh - 80px); overflow: auto;">
                    <div id="entra4">
                        <? include "entra4.php"?>
                    </div>                        
                </div>
            </div>
        </div>
    </div>                             
                       
</div>           




























<table class="table">
                            <thead>
                                <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                                <th>Total</th>      
                                <th class="text-end">Ações</th>                          
                                </tr>
                            </thead>
                            <tbody>
                            <?
                                $sql = "SELECT (select a_nome from produtos where numero = entra2.numero) produto, entra2.* FROM ENTRA2 WHERE entra2.entrada=0".$_GET['indice'];                                     
                                $total_entrada = 0;
                                foreach ($almoxa->query($sql) as $rowentra2)                             
                                {       
                                $total_entrada += $rowentra2['LIQUIDO'];     
                            ?>
                                    <tr id="linha<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>">
                                        <td><? echo $rowentra2['PRODUTO']?>
                                            <div class="modal fade" id="ModalProduto<?php echo (!empty($rowentra2['SEQUENCIA']) ? $rowentra2['SEQUENCIA'] : '0'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="." method="post" name="formentra2<? echo number_format($rowentra2['SEQUENCIA'], 0,'','')  ?>" id="formentra2<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>"><input type="hidden" id="tipodml" name="tipodml" value="entra2">
                                                                <input type="hidden" name="entrada" value="<? echo number_format($rowentra2['ENTRADA'], 0,'','') ?>">
                                                                <input type="hidden" name="sequencia" value="<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>">
                                                                <div class="mb-3">                                        
                                                                    <label>Produto</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control " name="numeroprod" id="numeroprod" style="max-width:100px" value="<?echo number_format($rowentra2['NUMERO'], 0, '','');?>" >
                                                                        <input type="text" class="form-control " name="numeroprodselect" id="numeroprodselect" compcodigo="numeroprod" value="<? echo $rowentra2['PRODUTO']?>" onkeyup="buscaCampo(event,$(this),'produto')" required>
                                                                        <div class="dropdown-menu position-absolute"  aria-labelledby="numeroprodselect_dd" id="numeroprodselect_dd" style="  position: absolute; top: 100%; left: 50%; transform: translateX(-50%); max-height: 50vh; overflow: auto; cursor: pointer;"></div>
                                                                    </div>
                                                                </div>                                                    
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-6">
                                                                        <label for="message-text" class="col-form-label">Quantidade</label>
                                                                        <input type="number" class="form-control" name="quantidade" id="quantidade" value="<?echo number_format($rowentra2['QUANTIDADE'],0, '','');?>" required>
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label for="message-text" class="col-form-label">Valor</label>
                                                                        <input type="number" class="form-control" name="unitario" id="unitario" value="<?echo number_format($rowentra2['UNITARIO'], 2);?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label for="message-text" class="col-form-label">Total:</label>
                                                                    <input type="number" class="form-control" name="total" id="total" value="<?echo number_format($rowentra2['QUANTIDADE']*$rowentra2['UNITARIO'], 2, ',','.');?>" readonly>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="dmlitem($('#formentra2<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>'),'estoque/dml',null,'estoque/entra2','entra2');">Salvar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><? echo number_format($rowentra2['UNITARIO'], 2); ?></td>
                                        <td><? echo number_format($rowentra2['QUANTIDADE'], 2); ?></td>
                                        <td><? echo number_format($rowentra2['QUANTIDADE']*$rowentra2['UNITARIO'], 2, ',','.'); ?></td>                                        
                                        <td class="text-end"><a data-bs-toggle="modal" data-bs-target="#ModalProduto<?echo $rowentra2['SEQUENCIA']?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button></a> <button class="btn btn-danger btn-sm" onclick="deleteitem('almoxa', 'entra2', 'sequencia','<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>','linha<? echo number_format($rowentra2['SEQUENCIA'], 0,'','') ?>');"><i class="fa fa-trash"></i></button></td>                                                                                
                                    </tr>
                                <? } ?>   
                                <td></td> 
                                <td></td> 
                                <td></td> 
                                <td></td>   
                                <td class="text-end">
                                    Total: <span class="text-end"><? echo number_format($total_entrada, 2, ',', '.')?></span>
                                </td>  
                                
                            </tbody>
                        </table>
                        <div class="modal fade" id="exampleModalLabel1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form name="formentra2" id="formentra2" >
                                        <input type="hidden" name="tipodml" value="entra2">
                                        <input type="hidden" name="entrada" value="<? echo $_GET['indice'] ?>">
                                        <input type="hidden" name="sequencia" value="0">
                                        <div class="mb-3">                                        
                                        <label for="">Produto</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control " name="numeroprod" id="numeroprod" style="max-width:100px" value="<?echo number_format($rowentra2['NUMERO'], 0, '','');?>" >
                                            <input type="text" class="form-control " name="numeroprodselect" id="numeroprodselect" compcodigo="numeroprod" value="<? echo $rowentra2['PRODUTO']?>" onkeyup="buscaCampo(event,$(this),'produto')" required>
                                            <div class="dropdown-menu position-absolute"  aria-labelledby="numeroprodselect_dd" id="numeroprodselect_dd" style="  position: absolute; top: 100%; left: 50%; transform: translateX(-50%); max-height: 50vh; overflow: auto; cursor: pointer;"></div>
                                        </div>
                                        </div>                                                    
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="message-text" class="col-form-label">Quantidade</label>
                                                <input type="number" class="form-control" name="quantidade" id="quantidade" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="message-text" class="col-form-label">Valor</label>
                                                <input type="number" class="form-control" name="unitario" id="unitario"  required>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label for="message-text" class="col-form-label">Total:</label>
                                            <input type="number" class="form-control" name="total" id="total" value="<?echo number_format($rowentra2['QUANTIDADE']*$rowentra2['UNITARIO'], 2, ',','.');?>" readonly>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="dmlitem($('#formentra2'),'estoque/dml',null,'estoque/entra2','entra2');">Salvar</button>
                                </div>
                            </div>
                        </div>
                        

