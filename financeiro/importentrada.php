<?
    include __DIR__."/../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../sgbd/almoxa.php";
    $_SESSION['ACESSO'] = 'Importar Notas de Entradas do Estoque';
    include __DIR__."/../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card my-2">
    <div class="row card-head h4 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
            <button class="btn btn-primary ms-5 cpcnoprint" type="button" data-bs-toggle="offcanvas" data-bs-target="#formimportentrada" aria-controls="formimportentrada">Filtrar</button>
            <span onclick="$('#fav_acesso').click()" tabindex="-1"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
                <button type="button" class="btn btn-primary cpcnoprint" onclick="$('.form-check-input:not(:checked)').click();">Importar Todas</button>
                <button type="button" class="btn btn-primary cpcnoprint" onclick="$('.form-check-input:checked').click();">Desimportar Todas</button>
        </div>
    </div>
</div>
<div class="card card-body container collapse" >
    <div class="modal-body">
        <form method="post" action="financeiro/dml.php" id="formentraitem" name="formentraitem" enctype="multipart/form-data">                    
            <input type="hidden" id="tipodml" name="tipodml" value="entraitem">
            <div class="row">
                <div class="col-md-3">
                    <label for="conta" class="form-label">Conta Corrente</label>
                    <select class="form-select" name="conta" id="conta" required value="">
                        <option></option>
                        <? $_SESSION['listagem'] = 'fin_conta'; include __DIR__."\..\listagem.php" ?>
                    </select>
                </div>
                <div class="col-md-3 ms-auto">
                    <label for="tipobaixa" class="form-label">Tipo de Baixa</label>
                    <select class="form-select" name="tipobaixa" id="tipobaixa" required value="">
                        <option></option>
                        <option>Caixa</option>
                        <option>Cheque</option>
                        <option>Pix</option>
                        <option>Debito em Conta</option>                            
                        <option>TED</option>
                        <option>Tranferência</option>
                        <option>Crédito em Conta</option>
                        <option>Boleto</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data da Baixa</label>
                    <input type="date" class="form-control" name="data">
                </div>
                <div class="col-md-3 ">
                    <label class="form-label">Conciliaçãoo</label>
                    <input type="date" class="form-control" name="baixa">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Total da Baixa</label>
                    <input type="text" class="form-control" id="totalbaixa">
                </div>
                <div class="col-md-3 ">
                    <label class="form-label">Lote</label>
                    <input type="text" class="form-control" name="lote" id="">
                </div>
            
                <div class="col-md-3">
                    <label for="" class="form-label">Nominal a</label>
                    <input type="text" class="form-control" name="portador">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Valor Total</label>
                    <input type="text" class="form-control" name="valor_total" id="valor_total">
                </div>                      
                <div class="col-md-12">
                    <label for="" class="form-label">Histórico</label>
                    <textarea type="text" rows="2" class="form-control" name="historico"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-around m-2 card">
                <button type="button" class="btn btn-primary" onclick="dmlitem($('#formentraitem'),'financeiro/dml', 'atualizar_baixa');">Baixar</button>
            </div>
        </form>
    </div>
</div>

<form action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" id="formimportentrada" name="formimportentrada" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="baixa">
    <input type="hidden" name="campomarcado" id="campomarcado" value="">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">    
        <div class="col-12">
            <label for="inputAddress2" class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data1" id="data" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 7  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data2" id="baixa" value="<? echo date('Y-m-d') ?>" maxlength="100" size="100">
        </div>
        
        <div class="row m-2" role="group">
            <label class="form-label">Status</label>
            <select class="form-select cpcsave" name="status" id="tipo_select" value="N">
                <option  value="">Todos</option>
                <option value="N">Não Importadas</option>
                <option value="S">Importadas</option>
            </select>
        </div>
        <div class="col-sm-12" role="group">
            <label class="form-label">Cliente/Fornec</label>
            <select class="form-select cpcsave" name="clifor" id="clifor" value="">
            <option></option>
            <? $_SESSION['listagem'] = 'etq_fornecedor'; include __DIR__."\..\listagem.php" ?>
            </select>
        </div> 
        <button class="btn btn-success mt-2 w-100" for="Atualizar" id="atualizar_baixa" onclick="sqlitem($('#formimportentrada'),'financeiro/importentrada','cpcMain');">Atualizar</button>
    </div>
</form>
<div id="cpc-autoheight" style="overflow: auto;">
    <table id="listaimportentrada" class="table table-hover table-sm tabelareport" style="min-width:1440px">
        <thead class="tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th class="min-w-125px">Código</th>
                <th class="min-w-125px">Sel</th>
                <th class="min-w-125px">Fornecedor</th>
                <th class="min-w-125px">CNPJ</th>                
                <th class="min-w-125px">N. Fiscal</th>
                <th class="min-w-125px">Data</th>
                <th class="min-w-125px">Total</th>
                <th class="min-w-125px">Desconto</th>
                <th class="min-w-125px">Liquido</th>
                <th class="min-w-125px">Empenho</th>
                <th class="min-w-125px">Estoque</th>
                <th class="min-w-125px">Dt Import</th>
                <th class="min-w-125px">Cód C.P.</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 tabelabody">
        <?
                if (!(isset($_POST['clifor']))) $_POST['clifor'] ='';
                if (!(isset($_POST['status']))) $_POST['status'] ='N';
                if (!(isset($_POST['data2']))) $_POST['data2'] = date("d.m.Y");
                if (!(isset($_POST['data1']))) $_POST['data1'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 7  days'));
                if ((isset($_POST['campomarcado'])) && ($_POST['campomarcado'] != ''))
                $_POST['tipo'] = $_SESSION['ID_CPC'];
                $sql = "select entra1.numero, entra1.numeronf, entra1.clifor, cadastro.nome, cadastro.cgc, entra1.data, entra1.total, entra1.desconto, entra1.empenho, entra1.stok, entra1.dataimport, entra1.importada, entra1.lancafin from entra1 inner join cadastro on (cadastro.fornecedor = entra1.clifor) where entra1.data between '".str_replace('/','.',$_POST['data1'])."' and '".str_replace('/','.',$_POST['data2'])."' and tipoentrada = '1'";
                // echo $sql;
                    if ($_POST['status'] == 'S') {
                        $sql = $sql." and importada = 'S'";
                    }else if ($_POST['status'] == 'N'){
                        $sql = $sql." and coalesce(importada,'N') ='N'";
                    }
                    if ($_POST['clifor'] != '')
                    $sql = $sql." and entra1.clifor = ".$_POST['clifor'];
            foreach ($almoxa->query($sql) as $row) 
            {
        ?>
        <tr>
            <td class="text-datatables"><? echo number_format($row['NUMERO'],0,'','') ?></td>
            <td class="text-center form-switch">                
                <input class="form-check-input" id='status<? echo $row['NUMERO'] ?>' type="checkbox" onclick="atualizaCampo('importentrada',this,'<? echo $row['NUMERO']; ?>',undefined,true)" name="darkmode" value="S" <? if ($row['IMPORTADA'] == 'S') echo 'checked'; ?>>
            </td>                    
            <td class="text-datatables"><? echo $row['NOME'] ?></td>
            <td class="text-datatables"><? echo $row['CGC'] ?></td>
            <td class="text-datatables"><? echo $row['NUMERONF'] ?></td>
            <td class="text-datatables"><? if ($row['DATA'] != '') echo  date('d/m/Y', strtotime($row['DATA'])) ?></td>
            <td class="text-datatables"><? echo number_format($row['TOTAL'],2,',','.') ?></td>
            <td class="text-datatables"><? echo number_format($row['DESCONTO'],2,',','.') ?></td>
            <td class="text-datatables"><? echo number_format($row['TOTAL'] - $row['DESCONTO'],2,',','.') ?></td>
            <td class="text-datatables"><? echo $row['EMPENHO'] ?></td>
            <td class="text-datatables"><? echo $row['STOK'] ?></td>
            <td class="text-datatables"><? if ($row['DATAIMPORT'] != '') echo  date('d/m/Y', strtotime($row['DATAIMPORT'])) ?></td>
            <td class="text-datatables"><? echo number_format($row['LANCAFIN'],0,'','') ?></td>
            
        </tr>
        <? } ?>
        </tbody>
    </table>
</div>

