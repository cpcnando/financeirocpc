<?
    include __DIR__."/../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Baixa de Títulos';
    include __DIR__."/../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card contsainer my-2 cpcnoprint">
    <div class="row card-head h4 text-center mts-1">
        <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-outline-primary ms-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#formbaixa" aria-controls="formbaixa">
            <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-filter me-sm-1"></i><div class="cpc-nomobile">Filtrar</div></div>
            </button>
            <span class="cpcnoprint" onclick="$('#fav_acesso').click()" tabindex="-1"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
            <input type="text" name="buscar" id="buscar" class="form-control form-control-sm cpcnoprint" onkeyup="filtraTabela($(this).val(),'listabaixa')" placeholder="Pesquisar..." style="min-width:80px; max-width:200px">
            <button type="button" class="btn btn-outline-primary" onclick="$('.form-check-input:not(:checked):visible').click(); atualizaCampo('desmarcarbaixa',this,'0')">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-regular fa-square-check me-sm-1"></i><div class="cpc-nomobile">Marcar</div></div>
            </button>
            <button type="button" class="ms-1 btn btn-outline-primary" onclick="$('.form-check-input:checked:visible').click();">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-regular fa-square me-sm-1"></i><div class="cpc-nomobile">DesMarcar</div></div>
            </button>
            <button type="button" class="ms-2 btn btn-primary" onclick="$('#campomarcado').val('<? echo $_SESSION['ID_CPC']; ?>'); sqlitem($('#formbaixa'),'financeiro/baixa','cpcMain',undefined,'campototal');">
                <div class="d-inline-flex d-flex align-items-center"><i class="fa-solid fa-arrows-to-dot me-sm-1"></i><div class="cpc-nomobile">Ir Baixa</div></div>
            </button>
        </div>
    </div>
</div>
<div style="overflow-y:visible">
    <div class="card card-body container" <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] == '')) echo 'style="display:none"'; ?>>
        <div class="modal-body">
            <form method="post" action="financeiro/dml.php" id="formbaixatitulo" name="formbaixatitulo" enctype="multipart/form-data">                    
                <input type="hidden" id="tipodml" name="tipodml" value="baixatitulo">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Conta Corrente</label>
                        <select class="form-select cpcsave" name="conta" id="conta" required value="">
                            <option></option>
                            <? $_SESSION['listagem'] = 'fin_conta'; include __DIR__."\..\listagem.php" ?>
                        </select>
                    </div>
                    <div class="col-6 ms-auto">
                        <label class="form-label">Tipo de Baixa</label>
                        <select class="form-select cpcsave" name="tipobaixa" id="tipobaixa" required value="">
                            <option></option>
                            <option>Caixa</option>
                            <option>Cheque</option>
                            <option>Pix</option>
                            <option>Debito em Conta</option>                            
                            <option>TED</option>
                            <option>Tranferência</option>
                            <option>Crédito em Conta</option>
                            <option>Boleto</option>
                            <option>CNAB</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Data da Baixa</label>
                        <input type="date" class="form-control  cpcsave" name="data" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Conciliaçãoo</label>
                        <input type="date" class="form-control cpcsave" name="baixa">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Total da Baixa</label>
                        <input type="text" class="form-control text-end" id="totalbaixa" readonly tipocpc="moeda">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Lote</label>
                        <input type="text" class="form-control" name="lote" id="">
                    </div>                
                    <div class="col-6">
                        <label for="" class="form-label">Nominal a</label>
                        <input type="text" class="form-control" name="portador">
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Histórico</label>
                        <textarea type="text" rows="2" class="form-control" name="historico" id="historico"></textarea>
                    </div>
                </div>
                    <button type="button" class="btn btn-primary w-100 mt-2" onclick="dmlitem($('#formbaixatitulo'),'financeiro/dml', 'atualizar_baixa');">Baixar</button>
            </form>
        </div>           
    </div>
</div>

<form action="." method="post" class="btn-group d-flex justify-content-between mb-3 offcanvas offcanvas-start" role="group" aria-label="Button group with nested dropdown" tabindex="-1" id="formbaixa" name="formbaixa" aria-labelledby="offcanvasLabel">
    <input type="hidden" name="tipodml" value="baixa">
    <input type="hidden" name="campomarcado" id="campomarcado" value="">
    <div class="offcanvas-header d-flex justify-content-between bg-success">
        <div><i class="<? echo $_SESSION['ACESSOICONE']; ?> me-2"></i></div>
        <h5 class="offcanvas-title" id="offcanvasLabel">Filtro</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">    
        <div class="col-12">
            <label class="form-label">De</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data1" id="data1" value="<? echo date("Y-m-d", strtotime(date("m.d.y"). ' - 30  days')) ?>" maxlength="100" size="100" required>
        </div>
        <div class="col-12">
            <label class="form-label">Até</label>
            <input type="date" class="form-control cpcsave" placeholder="" name="data2" id="data2" value="<? echo date('Y-m-d') ?>" maxlength="100" size="100">
        </div>
        
        <div class="row m-2" role="group">
            <label class="form-label">Tipo de Data</label>
            <select class="form-select cpcsave" name="tipo_data" id="tipo_data" required value="">
                <option value="cpr1.emissao">Emissão</option>
                <option value="cpr2.previsao" selected>Previsão</option>
                <option value="cpr2.vencimento">Vencimento</option>
                <option value="cpr2.databaixa">Baixa</option>
            </select>
        </div>

        <div class="row m-2" role="group">
            <label class="form-label">Tipo</label>
            <select class="form-select cpcsave" name="tipo" id="tipo_select" >
                <option  value="PR">Todos</option>
                <option value="R">A Receber</option>
                <option value="P">A Pagar</option>
            </select>
        </div>
        
        <div class="row m-2" role="group">
            <label class="form-label">Status Baixa</label>
            <select class="form-select cpcsave" name="status" id="status" required value="">
                <option>Todos</option>
                <option value="P"  selected>Pendente</option>
                <option value="B">Só Baixados</option>
            </select>
        </div>
        <div class="col-sm-12" role="group">
            <label class="form-label">Cliente/Fornec</label>
            <select class="form-select cpcsave" name="clifor" id="clifor" value="">
            <option></option>
            <? $_SESSION['listagem'] = 'etq_cadastro'; include __DIR__."\..\listagem.php" ?>
            </select>
        </div> 
        <button class="btn btn-success m-1 w-100" for="Atualizar" id="atualizar_baixa" onclick="sqlitem($('#formbaixa'),'financeiro/baixa','cpcMain');">Atualizar</button>
    </div>
</form>
<div id="cpc-autoheight" style="overflow: auto;">    
    <table id="listabaixa" class="container table table-hover table-sm tabelareport" style="min-width:<? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] === '')) echo '2000'; else echo "1024" ?>px">
        <thead class="tabelahead">
            <tr class="text-start text-muted fw-bold fs-7 gs-0">
                <th>Código</th>
                <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] === '')) echo '<th class="text-center">Sel</th>'; ?>
                <th>Cli/Fornec</th>
                <th>Doc.</th>                
                <th>Ref.</th>
                <th>Emissão</th>
                <th>Vencimento</th>
                <th>Previsão</th>
                <th>Tipo</th>
                <th class="text-end">Bruto</th>
                <th>Total</th>
                <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] == '')) { ?>
                <th>CNPJ/CPF</th>
                <th>Baixa</th>
                <th>Banco/Caixa</th>
                <th class="text-end">Valor Baixa</th>
                <? } ?>
            </tr>
        </thead>
        <tbody id="cpc-autoheightgrid" class="text-gray-600 tabelabody">
        <?
                if (!(isset($_POST['tipo']))) $_POST['tipo'] ='PR';
                if (!(isset($_POST['tipo_data']))) $_POST['tipo_data'] ='cpr2.previsao';
                if (!(isset($_POST['clifor']))) $_POST['clifor'] ='';
                if (!(isset($_POST['status']))) $_POST['status'] ='P';
                if (!(isset($_POST['data2']))) $_POST['data2'] = date("d.m.Y");
                if (!(isset($_POST['data1']))) $_POST['data1'] = date("d.m.Y", strtotime(date("m.d.y"). ' - 30  days'));
                if ((isset($_POST['campomarcado'])) && ($_POST['campomarcado'] !== ''))
                $_POST['tipo'] = $_SESSION['ID_CPC'];
                $sql = "select * from baixartitulo('".$_POST['data1']."','".str_replace('/','.',$_POST['data2'])." 23:59:59','".$_POST['tipo']."','".$_POST['tipo_data']."') where 1=1 ";
                if ((isset($_POST['campomarcado'])) && ($_POST['campomarcado'] != ''))
                    $sql = $sql." and marcado = '".$_SESSION['ID_CPC']."'";
                else
                {
                    if ($_POST['status'] == 'P') {
                        $sql = $sql." and databaixa is null";
                    }else if ($_POST['status'] == 'B'){
                        $sql = $sql." and databaixa is not null";
                    }
                    if ($_POST['clifor'] != '')
                    $sql = $sql." and clifor = ".$_POST['clifor'];
                }
            $total = 0;
            $historico = '';
            foreach ($financeiro->query($sql) as $row) 
            {
                $historico .=  $row['HISTORICO']. ' ';
                $total+=$row['BAIXAR'] ?? $row['PARCELA'];
        ?>
        <tr>
            <td>
                <input type="hidden" name="tipodml" value="baixa">
                <input type="hidden" name="pk" value="<? echo $row['NUMERO'] ?>">
                <button type="button" style="font-size:12px;" class="btn btn-outline-primary" id="cpr<?php echo $row['NUMERO'] ?>" onclick="showMain(<? echo $row['NUMEROCPR'] ?>,'telapopup','financeiro/cpr.php?indice=');"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="ir para o Tí­tulo"><?php echo $row['NUMEROCPR'] ?></button>                
            </td>
            <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] === '')) { ?>
            <td class="text-center form-switch">                
                <input class="form-check-input" id='status<? echo $row['NUMERO'] ?>' type="checkbox" onclick="atualizaCampo('baixastatus',this,'<? echo $row['NUMERO']; ?>')" name="darkmode" value="<?php echo $_SESSION['ID_CPC'] ?>" <? if ($row['MARCADO'] == $_SESSION['ID_CPC']) echo 'checked'; ?>>
            </td>
            <? } ?>
            <td><? echo $row['NOMECLIFOR'] ?></td>
            <td><? echo $row['DOCUMENTO'] ?></td>
            <td><? echo $row['REFERENCIA'] ?></td>
            <td><? if ($row['EMISSAO'] != '') echo  date('d/m/Y', strtotime($row['EMISSAO'])) ?></td>
            <td><? if ($row['VENCIMENTO'] != '') echo  date('d/m/Y', strtotime($row['VENCIMENTO'])) ?></td>
            <td><? if ($row['PREVISAO'] != '') echo  date('d/m/Y', strtotime($row['PREVISAO'])) ?></td>
            <td><? echo $row['TIPO'] ?></td>
            <td class="text-end"><? echo number_format($row['PARCELA'] ,2,',','.') ?></td>
            <td><input class="form-control valorparcela" onchange="atualizaCampo('baixavalor',$(this).val().replace(/\./g, '').replace(/,/g, '.'),'<? echo $row['NUMERO']; ?>','texto')" style="text-align:right; min-width:100px" type="text" value="<? echo number_format(($row['BAIXAR'] ?? $row['PARCELA']),2,',','') ?>" <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] == '')) echo ' readonly'; ?> tipocpc="moeda"></td>
            <? if ((!isset($_POST['campomarcado'])) || ($_POST['campomarcado'] == '')) { ?>
            <td><? echo $row['CGC'] ?></td>
            <td><? if ($row['DATABAIXA'] != '') echo  date('d/m/Y', strtotime($row['DATABAIXA'])) ?></td>
            <td><? echo $row['A_NOME'] ?></td>
            <td class="text-end"><? echo number_format($row['VALORBAIXA'] ,2,',','.') ?></td>
            <? } ?>
        </tr>
        <? } ?>
        </tbody>
    </table>
    <input id="campototal" onclick="$('#historico').val('<?= $historico ?>')" class="form-control form-control-lg" style="text-align:right; min-width:100px" type="hidden" value="<? echo number_format($total,2,',','') ?>" readonly>
</div>
<div class="loadcpc" onclick="
    $('.loadcpc').removeClass('loadcpc');
    $('.valorparcela').on('change', function() {$('#calculasoma').click();});
    $('#calculasoma').click();
"></div>
<div id="calculasoma" onclick="
    // Função para calcular o resultado

    //console.log('load');
    //$('.valorparcela, .pagamento').on('change', function() {$('#calculasoma').click();});
    var soma = 0;
    // Somar valores dos inputs com a classe 'recebimento'
    $('.valorparcela').each(function() {
        var valor = $(this).val();
        valor = valor.replace('.', '');
        valor = valor.replace(',', '.');
        if (valor.length !== 0) {
            soma += parseFloat(valor);
        }
    });


    var resultado = soma;
    resultado = resultado.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    // Alimentar o resultado em um input específico, por exemplo, '#resultado'
    $('#totalbaixa').val(resultado);
    // Remove a class loadcpc para a função ser executada somente uma vez
        
    "></div>