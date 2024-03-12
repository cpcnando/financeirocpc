<?
    include __DIR__."/../funcoes.php";
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Cadastro de Contas a Receber';
    include __DIR__."/../sgbd/acesso.php";
    $numerocpr = executasqlcampo("select numerocpr from cpr2 where numero =0".$_GET['indice'],$financeiro);
?>
<div class="linha-com-nome">
    <hr><span class="nome-no-meio">Rateio</span>
</div>
<input type="hidden" id="sel_cpr3" name="sel_cpr3" value="">
<div class="col-md-12 d-flex justify-content-evenly cpcnoprint cpc-abas-padrao cpc-barra-acao">
    <? if ($rowacesso['DML_I'] === 'S') { ?>
    <button id="incluir_cpr3" type="button" class="btn btn-outline-primary btn-sm cpcnoprint incluir" data-bs-toggle="tooltip" data-bs-placement="top" onclick=" $('#form_cpr30').toggle(); insertform($('#form_cpr30'),'depto0','_cpr3'); $('#ind_cpr30').attr('class','fa fa-plus'); $('#salvar_cpr3').attr('disabled', false); carregando(false);">
        <i class="fa fa-plus"></i> <strong><u>I</u></strong>ncluir
    </button>
    <? } if ($rowacesso['DML_U'] === 'S') { ?>
    <button id="editar_cpr3" class="btn btn-outline-secondary btn-sm cpcnoprint editar" data-bs-toggle="tooltip" data-bs-placement="top" onclick="editform($('.formcpr3'));">
        <i class="fa fa-pencil"></i> <strong><u>E</u></strong>ditar
    </button>
    <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
    <button id="salvar_cpr3" class="btn btn-outline-success btn-sm cpcnoprint salvar" data-bs-toggle="tooltip" data-bs-placement="top" disabled onclick="$('div .formcpr3').click();">
        <i class="fa fa-check"></i> <strong><u>S</u></strong>alvar
    </button>
    <? } if ($rowacesso['DML_D'] === 'S') { ?>
    <button onclick="deleteitem('financeiro', 'cpr3', 'sequencia',$('#sel_cpr3').val(),'form_cpr3'+$('#sel_cpr3').val());" id="deletar_cpr3" class="btn btn-outline-danger btn-sm cpcnoprint deletar" data-bs-toggle="tooltip" data-bs-placement="top" disabled>
        <i class="fa fa-trash"></i> Deletar
    </button>
    <?} ?>
</div>
<input type="hidden" id="ctrl_cpr3"  value="">
<div class="card container card-body mt-1"  style="border: none" id="cpc-autoheightgrid">
    <div id="meu-card" >
        <div class="cpc-grid" style="min-width:1000px; grid-template-columns: 20px repeat(3, auto)">
            <div class="grid-item sticky-top sticky-left bg-cpc-verdeclaro text-center">
                <div class="dropdown" style="position:fixed">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-square-caret-down fa-xs" style="color:#FFF"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="fw-bold text-center">Exibir/Ocultar</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.colgrid-valor').toggle();">Valor</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').show();">Exibir Todas</a></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').hide();">Ocultar Todas</a></li>
                    </ul>
                </div>
            </div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">C. Custo</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Nat. Oper.</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Valor</div>
            <form></form>
            <form id="form_cpr3<? $pk = 0; echo $pk ?>" name="cpr3<? echo $pk ?>" style="display:none" class="formgrid formcpr3"
                onchange="if (($('#ind_cpr3<? echo $pk ?>').attr('class') ==='fa fa-plus mt-1') || ($('#ind_cpr3<? echo $pk ?>').attr('class') ==='fa fa-plus')) { $('#salvar_cpr3').attr('disabled', false); $('#ind_cpr3<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_cpr3<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_cpr3').val('<? echo $pk ?>'); $('#deletar_cpr3').attr('disabled', true); $('.formcpr3 [linha]:not(.fa-i-cursor)').attr('class',''); $('#ind_cpr3<? echo $pk ?>').attr('class','fa fa-plus mt-1');  $('.formcpr3  .form-control').removeClass('bg-cpc-cinzaescuro'); $('#form_cpr3<? echo $pk ?> .form-control').addClass('bg-cpc-cinzaescuro');}">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_cpr3<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_cpr3<? echo $pk ?>'),'financeiro/dml',''); " id="salvarcpr3<? echo $pk ?>" class="formcpr3">
                        <i id="ind_cpr3<? echo $pk ?>" class="fa fa-plus mt-1" linha="s"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml0" name="tipodml" value="cpr3">
                        <input type="hidden" id="dml0" name="dml" value="I">
                        <input type="hidden" id="indicecpr20" name="indicecpr2" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="sequencia0" name="sequencia" value= "0">
                        <input type="hidden" id="numerocpr0" name="numerocpr" value= "<? echo $numerocpr ?>">
                        <input id="depto<? echo $pk ?>" name="depto" type="number" class="form-control codtexto" value="<? echo $rowcpr3['DEPTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'ccustofin','depto<? echo $pk ?>select');">
                        <input id="depto<? echo $pk ?>select" name="deptoselect" type="text" class="form-control " value="<? if (isset($rowcpr3['DEPTO'])) echo executasqlcampo('select a_nome from departamento where depto =0'.$rowcpr3['DEPTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="depto<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'ccustofin')">
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input id="custos<? echo $pk ?>" name="custos" type="number" class="form-control codtexto" value="<? echo $rowcpr3['CUSTOS'] ?? ''; ?>" readonly onchange="campoLista($(this),'natop','custos<? echo $pk ?>select');">
                        <input id="custos<? echo $pk ?>select" name="custosselect" type="text" class="form-control " value="<? if (isset($rowcpr3['CUSTOS'])) echo executasqlcampo('select a_nome from custos where custos =0'.$rowcpr3['CUSTOS'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="custos<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'natop')">
                    </div>
                </div>
                <div class="grid-item">
                    <input type="text" class="form-control"  style="border-radius: 0px" name="valor" id="valor0" value="" tipocpc="moeda" readonly>
                </div>
            </form>
            <?
                $sql = "select * from cpr3 where indicecpr2 =0".$_GET['indice'];
                foreach ($financeiro->query($sql) as $rowcpr3){
                    $pk = number_format(($rowcpr3['SEQUENCIA'] ?? '0'),0,'','');
            ?>
            <form id="form_cpr3<? echo $pk ?>" class="formgrid formcpr3"
                onchange="if ($('#ind_cpr3<? echo $pk ?>').attr('class') ==='fa-solid fa-caret-right mt-1') {$('#salvar_cpr3').attr('disabled', false); $('#ind_cpr3<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_cpr3<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_cpr3').val('<? echo $pk ?>'); $('#deletar_cpr3').attr('disabled', false); $('.formcpr3 [linha]:not(.fa-i-cursor)').attr('class',''); $('#ind_cpr3<? echo $pk ?>').attr('class','fa-solid fa-caret-right mt-1'); $('.formcpr3  .form-control').removeClass('bg-cpc-cinzaescuro'); $('#form_cpr3<? echo $pk ?> .form-control').addClass('bg-cpc-cinzaescuro'); }"
                name="cpr3<? echo $pk ?>">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_cpr3<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_cpr3<? echo $pk ?>'),'financeiro/dml',''); " id="salvarcpr3<? echo $pk ?>" class="formcpr3">
                        <i id="ind_cpr3<? echo $pk ?>" linha="s"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml<? echo $pk ?>" name="tipodml" value="cpr3">
                        <input type="hidden" id="dml<? echo $pk ?>" name="dml" value="Q">
                        <input type="hidden" id="indicecpr2<? echo $pk ?>" name="indicecpr2" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="sequencia<? echo $pk ?>" name="sequencia" value= "<? echo $pk ?>">
                        <input type="hidden" id="numerocpr0" name="numerocpr" value= "<? echo $numerocpr ?>">
                        <input id="depto<? echo $pk ?>" name="depto" type="number" class="form-control codtexto" value="<? echo $rowcpr3['DEPTO'] ?? ''; ?>" readonly onchange="campoLista($(this),'ccustofin','depto<? echo $pk ?>select');">
                        <input id="depto<? echo $pk ?>select" name="deptoselect" type="text" class="form-control " value="<? if (isset($rowcpr3['DEPTO'])) echo executasqlcampo('select a_nome from departamento where depto =0'.$rowcpr3['DEPTO'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="depto<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'ccustofin')">

                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input id="custos<? echo $pk ?>" name="custos" type="number" class="form-control codtexto" value="<? echo $rowcpr3['CUSTOS'] ?? ''; ?>" readonly onchange="campoLista($(this),'natop','custos<? echo $pk ?>select');">
                        <input id="custos<? echo $pk ?>select" name="custosselect" type="text" class="form-control " value="<? if (isset($rowcpr3['CUSTOS'])) echo executasqlcampo('select a_nome from custos where custos =0'.$rowcpr3['CUSTOS'],$financeiro) ?? ''; ?>" readonly autocomplete="off" compcodigo="custos<? echo $pk ?>" onkeyup="buscaCampo(event,$(this),'natop')">
                    </div>
                </div>
                <div class="grid-item">
                    <input id="valor" name="valor" type="text" class="form-control" value="<? if (isset($rowcpr3['VALOR'])) echo number_format($rowcpr3['VALOR'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda">                
                </div>
                
            </form>
            <? } ?>
        </div>
        <div class="formcpr3" onclick="setTimeout(function() { showMain('<?php echo $_GET['indice'] ?? '' ?>', 'cpr3', 'financeiro/cpr3.php?indice='); },2000)"></div>
    </div>
</div>