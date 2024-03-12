<?
    include __DIR__."/../funcoes.php";
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Movimento Bancário/Caixa';
    include __DIR__."/../sgbd/acesso.php";
?>
<div class="linha-com-nome">
    <hr><span class="nome-no-meio">Parcela/Rateio</span>
</div>
<input type="hidden" id="sel_movcustos" name="sel_movcustos" value="">
<div class="col-md-12 d-flex justify-content-evenly cpcnoprint cpc-abas-padrao cpc-barra-acao">
    <? if ($rowacesso['DML_I'] === 'S') { ?>
    <button type="button" id="incluir_movcustos"  class="btn btn-outline-primary btn-sm cpcnoprint incluir" data-bs-toggle="tooltip" data-bs-placement="top" onclick=" $('#form_movcustos0').show(); insertform($('#form_movcustos0'),'depto0','_movcustos'); $('#ind_movcustos0').attr('class','fa fa-plus'); $('#salvar_movcustos').attr('disabled', false); carregando(false);">
        <i class="fa fa-plus"></i> <strong><u>I</u></strong>ncluir
    </button>
    <? } if ($rowacesso['DML_U'] === 'S') { ?>
    <button onclick="editform($('.forms'));" id="editar_movcustos" class="btn btn-outline-secondary btn-sm cpcnoprint editar" data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="fa fa-pencil"></i> <strong><u>E</u></strong>ditar
    </button>
    <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
    <button id="salvar_movcustos" class="btn btn-outline-success btn-sm cpcnoprint salvar" data-bs-toggle="tooltip" data-bs-placement="top" disabled onclick="$('.formgrid').click(); showMain('<?php echo $_GET['indice'] ?? '' ?>', 'aba-item', 'financeiro/movcustos.php?indice=',null,'incluir_movcustos'); ">
        <i class="fa fa-check"></i> <strong><u>S</u></strong>alvar
    </button>
    <? } if ($rowacesso['DML_D'] === 'S') { ?>
    <button onclick="deleteitem('financeiro', 'movcustos', 'sequencia',$('#sel_movcustos').val(),'form_movcustos'+$('#sel_movcustos').val());" id="deletar_movcustos" class="btn btn-outline-danger btn-sm cpcnoprint deletar" data-bs-toggle="tooltip" data-bs-placement="top" disabled>
        <i class="fa fa-trash"></i> Deletar
    </button>
    <?} ?>
</div>
<input type="hidden" id="ctrl_movcustos"  value="">
<div class="card container card-body mt-1"  style="border: none" id="cpc-autoheightgrid">
    <div id="meu-card" >
        <div class="cpc-grid" style="min-width:1000px; grid-template-columns: 20px repeat(3, 300px) auto">
            <div class="grid-item sticky-top sticky-left bg-cpc-verdeclaro text-center">
                <!-- <div class="dropdown" style="position:fixed">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-square-caret-down fa-xs" style="color:#FFF"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="fw-bold text-center">Exibir/Ocultar</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.colgrid-observacao').toggle();">Observação</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').show();">Exibir Todas</a></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').hide();">Ocultar Todas</a></li>
                    </ul>
                </div> -->
            </div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Centro de Custo</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Nat. Operação</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Valor</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Observação</div>
            <form></form>
            <form id="form_movcustos<? $pk = 0; echo $pk ?>" class="formgrid forms"
                onfocusout="if ($('#ind_movcustos<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') $('#ind_movcustos<? echo $pk ?>').attr('class','');"
                onchange="if (($('#ind_movcustos<? echo $pk ?>').attr('class') ==='fa-solid fa-caret-right mt-1') || ($('#ind_movcustos<? echo $pk ?>').attr('class') ==='fa fa-plus')) { $('#salvar_movcustos').attr('disabled', false); $('#ind_movcustos<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_movcustos<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_movcustos').val('<? echo $pk ?>'); $('#deletar_movcustos').attr('disabled', true); $('#ind_movcustos<? echo $pk ?>').attr('class','fa-solid fa-caret-right mt-1'); }" name="movcustos<? echo $pk ?>" style="display:none">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_movcustos<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_movcustos<? echo $pk ?>'),'financeiro/dml',''); " id="salvarmovcustos<? echo $pk ?>" class="formgrid">
                        <i id="ind_movcustos<? echo $pk ?>" class="fa-solid fa-caret-right mt-1"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml<? echo $pk ?>" name="tipodml" value="movcustos">
                        <input type="hidden" id="dml<? echo $pk ?>" name="dml" value="I">
                        <input type="hidden" id="numero<? echo $pk ?>" name="numero" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="sequencia<? echo $pk ?>" name="sequencia" value= "<? echo $pk ?>">
                        <input id="depto0" name="depto" type="number" class="form-control codtexto" readonly onchange="campoLista($(this),'ccustofin','depto0select');">
                        <input id="depto0select" name="depto0select" type="text" class="form-control " readonly autocomplete="off" compcodigo="depto0" onkeyup="buscaCampo(event,$(this),'ccustofin')">
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input id="custos0" name="custos" type="number" class="form-control codtexto" readonly onchange="campoLista($(this),'natop','custos0select');">
                        <input id="custos0select" name="custos0select" type="text" class="form-control " readonly autocomplete="off" compcodigo="custos0" onkeyup="buscaCampo(event,$(this),'natop')">
                    </div>
                </div>
                <div class="grid-item">
                    <input id="valor0" name="valor" type="text" class="form-control" style="text-align:right;" readonly tipocpc="moeda">
                </div>
                <div class="grid-item">
                    <input id="observacao0" name="observacao" type="text" class="form-control" maxlength="50" readonly onblur="$('#salvar_movcustos').click();">
                </div>            </form>
            <?
                $sql = "select * from movcustos where numero =0".$_GET['indice'];
                foreach ($financeiro->query($sql) as $rowmovcustos){
                    $pk = number_format(($rowmovcustos['SEQUENCIA'] ?? '0'),0,'','');
            ?>
            <form id="form_movcustos<? echo $pk ?>" class="formgrid forms"
                onfocusout="if ($('#ind_movcustos<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#ind_movcustos<? echo $pk ?>').attr('class',''); $('#form_movcustos<? echo $pk ?> .form-control').removeClass('bg-cpc-cinzaescuro');}"
                onchange="if ($('#ind_movcustos<? echo $pk ?>').attr('class') ==='fa-solid fa-caret-right mt-1') {$('#salvar_movcustos').attr('disabled', false); $('#ind_movcustos<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_movcustos<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_movcustos').val('<? echo $pk ?>'); $('#deletar_movcustos').attr('disabled', false); $('#ind_movcustos<? echo $pk ?>').attr('class','fa-solid fa-caret-right mt-1'); $('#form_movcustos<? echo $pk ?> .form-control').addClass('bg-cpc-cinzaescuro'); }"
                name="movcustos<? echo $pk ?>">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_movcustos<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_movcustos<? echo $pk ?>'),'financeiro/dml',''); " id="salvarmovcustos<? echo $pk ?>" class="formgrid">
                        <i id="ind_movcustos<? echo $pk ?>"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml<? echo $pk ?>" name="tipodml" value="movcustos">
                        <input type="hidden" id="dml<? echo $pk ?>" name="dml" value="Q">
                        <input type="hidden" id="numero<? echo $pk ?>" name="numero" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="sequencia<? echo $pk ?>" name="sequencia" value= "<? echo $pk ?>">
                        <input id="depto<? echo $pk ?>" name="depto" type="number" class="form-control codtexto" value="<? echo $rowmovcustos['DEPTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'ccustofin','depto<? echo $pk ?>select');">
                        <input id="depto<? echo $pk ?>select" name="deptoselect" type="text" class="form-control " value="<? if (isset($rowmovcustos['DEPTO'])) echo executasqlcampo('select a_nome from departamento where depto =0'.$rowmovcustos['DEPTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="depto<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'ccustofin')">
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input id="custos<? echo $pk ?>" name="custos" type="number" class="form-control codtexto" value="<? echo $rowmovcustos['CUSTOS'] ?? ''; ?>" readonly onchange="campoLista($(this),'natop','custos<? echo $pk ?>select');">
                        <input id="custos<? echo $pk ?>select" name="custosselect" type="text" class="form-control " value="<? if (isset($rowmovcustos['CUSTOS'])) echo executasqlcampo('select a_nome from custos where custos =0'.$rowmovcustos['CUSTOS'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="custos<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'natop')">
                    </div>
                </div>
                <div class="grid-item">
                    <input id="valor<? echo $pk ?>" name="valor" type="text" class="form-control" value="<? if (isset($rowmovcustos['VALOR'])) echo number_format($rowmovcustos['VALOR'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda">
                </div>
                <div class="grid-item">
                    <input id="observacao<? echo $pk ?>" name="observacao" type="text" class="form-control" value="<? echo $rowmovcustos['OBSERVACAO'] ?? '' ?>" maxlength="50"  readonly>
                </div>                
            </form>
            <? } ?>
        </div>
    </div>
</div>