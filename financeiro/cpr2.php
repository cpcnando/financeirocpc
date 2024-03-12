<?
    include __DIR__."/../funcoes.php";
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Cadastro de Contas a Receber';
    include __DIR__."/../sgbd/acesso.php";
?>
<div class="linha-com-nome">
    <hr><span class="nome-no-meio">Parcela</span>
</div>
<input type="hidden" id="sel_cpr2" name="sel_cpr2" value="">
<div class="col-md-12 d-flex justify-content-evenly cpcnoprint cpc-abas-padrao cpc-barra-acao">
    <? if ($rowacesso['DML_I'] === 'S') { ?>
    <button id="incluir_cpr2" type="button" class="btn btn-outline-primary btn-sm cpcnoprint incluir" data-bs-toggle="tooltip" data-bs-placement="top" onclick=" $('#form_cpr20').toggle(); insertform($('#form_cpr20'),'documento0','_cpr2'); $('#ind_cpr20').attr('class','fa fa-plus'); $('#salvar_cpr2').attr('disabled', false); carregando(false); $('#cpr3').text('');">
        <i class="fa fa-plus"></i> <strong><u>I</u></strong>ncluir
    </button>
    <? } if ($rowacesso['DML_U'] === 'S') { ?>
    <button id="editar_cpr2" class="btn btn-outline-secondary btn-sm cpcnoprint editar" data-bs-toggle="tooltip" data-bs-placement="top" onclick="editform($('.formcpr2'));">
        <i class="fa fa-pencil"></i> <strong><u>E</u></strong>ditar
    </button>
    <? } if (($rowacesso['DML_U'] === 'S') || ($rowacesso['DML_I'] === 'S')) { ?>
    <button id="salvar_cpr2" class="btn btn-outline-success btn-sm cpcnoprint salvar" data-bs-toggle="tooltip" data-bs-placement="top" disabled onclick="$('div .formcpr2').click();">
        <i class="fa fa-check"></i> <strong><u>S</u></strong>alvar
    </button>
    <? } if ($rowacesso['DML_D'] === 'S') { ?>
    <button id="deletar_cpr2" class="btn btn-outline-danger btn-sm cpcnoprint deletar" data-bs-toggle="tooltip" data-bs-placement="top" disabled onclick="deleteitem('financeiro', 'cpr2', 'numero',$('#sel_cpr2').val(),'form_cpr2'+$('#sel_cpr2').val()); $('#cpr3').text('');">
        <i class="fa fa-trash"></i> Deletar
    </button>
    <?} ?>
</div>
<input type="hidden" id="ctrl_cpr2"  value="">
<div class="card container card-body mt-1"  style="border: none" id="cpc-autoheightgrid">
    <div id="meu-card" >
        <div class="cpc-grid" style="min-width:1000px; grid-template-columns: 20px repeat(6, auto)">
            <div class="grid-item sticky-top sticky-left bg-cpc-verdeclaro text-center">
                <div class="dropdown" style="position:fixed">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-square-caret-down fa-xs" style="color:#FFF"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="fw-bold text-center">Exibir/Ocultar</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.colgrid-vencimento').toggle();">Vencimento</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').show();">Exibir Todas</a></li>
                        <li><a class="dropdown-item" onclick="$('.coloculta').hide();">Ocultar Todas</a></li>
                    </ul>
                </div>
            </div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Documento</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Vencimento</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Previsão</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Parcela</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Dt Baixa</div>
            <div class="grid-item sticky-top bg-cpc-grid ps-2">Vl Baixa</div>
            <form></form>
            <form id="form_cpr2<? $pk = 0; echo $pk ?>" name="cpr2<? echo $pk ?>" class="formgrid formcpr2" style="display:none" 
                onclick="$('#cpr3').text('');"
                onchange="if (($('#ind_cpr2<? echo $pk ?>').attr('class') ==='fa fa-plus mt-1') || ($('#ind_cpr2<? echo $pk ?>').attr('class') ==='fa fa-plus')) { $('#salvar_cpr2').attr('disabled', false); $('#ind_cpr2<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_cpr2<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_cpr2').val('<? echo $pk ?>'); $('#deletar_cpr2').attr('disabled', true); $('.formcpr2 [linha]:not(.fa-i-cursor)').attr('class',''); $('#ind_cpr2<? echo $pk ?>').attr('class','fa fa-plus mt-1');  $('.formcpr2 .form-control').removeClass('bg-cpc-cinzaescuro'); $('#form_cpr2<? echo $pk ?> .form-control').addClass('bg-cpc-cinzaescuro');}">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_cpr2<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_cpr2<? echo $pk ?>'),'financeiro/dml',''); " id="salvarcpr2<? echo $pk ?>" class="formcpr2">
                        <i id="ind_cpr2<? echo $pk ?>" class="fa-solid fa-caret-right mt-1" linha="s"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml0" name="tipodml" value="cpr2">
                        <input type="hidden" id="dml0" name="dml" value="I">
                        <input type="hidden" id="numerocpr0" name="numerocpr" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="numero0" name="numero" value= "0">
                        <input type="text" class="form-control"  style="border-radius: 0px" name="documento" id="documento0" value="" maxlength="20" readonly>
                    </div>
                </div>
                <div class="grid-item">
                    <input id="vencimento<? echo $pk ?>" name="vencimento" type="date" class="form-control" readonly required>
                </div>
                <div class="grid-item">
                    <input id="previsao<? echo $pk ?>" name="previsao" type="date" class="form-control" readonly required>
                </div>
                <div class="grid-item">
                    <input id="parcela<? echo $pk ?>" name="parcela" type="text" class="form-control" style="text-align:right;" required readonly tipocpc="moeda" onblur="$('div .formcpr2').click();">
                </div>
                <div class="grid-item">
                </div>
                <div class="grid-item">
                </div>
            </form>
            <?
                $sql = "select * from cpr2 where numerocpr =0".$_GET['indice'];
                foreach ($financeiro->query($sql) as $rowcpr2){
                    $pk = number_format(($rowcpr2['NUMERO'] ?? '0'),0,'','');
            ?>
            <form id="form_cpr2<? echo $pk ?>" class="formgrid formcpr2"
                onchange="if ($('#ind_cpr2<? echo $pk ?>').attr('class') ==='fa-solid fa-caret-right mt-1') {$('#salvar_cpr2').attr('disabled', false); $('#ind_cpr2<? echo $pk ?>').attr('class','fa-solid fa-i-cursor mt-1'); }"
                onfocusin="if ($('#ind_cpr2<? echo $pk ?>').attr('class') !=='fa-solid fa-i-cursor mt-1') {$('#sel_cpr2').val('<? echo $pk ?>'); $('#deletar_cpr2').attr('disabled', false); $('.formcpr2 [linha]:not(.fa-i-cursor)').attr('class',''); $('#ind_cpr2<? echo $pk ?>').attr('class','fa-solid fa-caret-right mt-1'); $('.formcpr2 .form-control').removeClass('bg-cpc-cinzaescuro'); $('#form_cpr2<? echo $pk ?> .form-control').addClass('bg-cpc-cinzaescuro'); }"
                onclick="if ($('#indicecpr20').val() !== '<? echo $rowcpr2['NUMERO'] ?>') {showMain('<? echo $rowcpr2['NUMERO'] ?>','cpr3','financeiro/cpr3.php?indice='); }"
                name="cpr2<? echo $pk ?>">
                <div class="grid-item cpc-coluna-fixa bg-cpc-grid d-flex align-items-center justify-content-center">
                    <div onclick="if ($('#ind_cpr2<? echo $pk ?>').hasClass('fa-i-cursor')) dmlitem($('#form_cpr2<? echo $pk ?>'),'financeiro/dml',''); " id="salvarcpr2<? echo $pk ?>" class="formcpr2">
                        <i id="ind_cpr2<? echo $pk ?>" linha="s"></i>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="input-group">
                        <input type="hidden" id="tipodml<? echo $pk ?>" name="tipodml" value="cpr2">
                        <input type="hidden" id="dml<? echo $pk ?>" name="dml" value="Q">
                        <input type="hidden" id="numerocpr<? echo $pk ?>" name="numerocpr" value="<? echo $_GET['indice'] ?>">
                        <input type="hidden" id="numero<? echo $pk ?>" name="numero" value= "<? echo $pk ?>">
                        <input type="text" class="form-control"  style="border-radius: 0px" name="documento" id="documento<? echo $pk ?>" value="<? echo $rowcpr2['DOCUMENTO']; ?>" maxlength="20" readonly>
                    </div>
                </div>
                <div class="grid-item">
                    <input id="vencimento" name="vencimento" type="date" class="form-control" value="<?= $rowcpr2['VENCIMENTO'] ? date('Y-m-d', strtotime($rowcpr2['VENCIMENTO'])) : '' ?>" required readonly>
                </div>
                <div class="grid-item">
                    <input id="previsao<? echo $pk ?>" name="previsao" type="date" class="form-control" value="<?= $rowcpr2['PREVISAO'] ? date('Y-m-d', strtotime($rowcpr2['PREVISAO'])) : '' ?>" readonly>
                </div>
                <div class="grid-item">
                    <input id="parcela<? echo $pk ?>" name="parcela" type="text" class="form-control" value="<? if (isset($rowcpr2['PARCELA'])) echo number_format($rowcpr2['PARCELA'],2,',',''); ?>" style="text-align:right;" required readonly tipocpc="moeda">
                </div>
                <div class="grid-item">
                    <input id="databaixa" name="databaixa" type="date" class="form-control travado" value="<?= $rowcpr2['DATABAIXA'] ? date('Y-m-d', strtotime($rowcpr2['DATABAIXA'])) : '' ?>" readonly tabindex="-1">
                </div>
                <div class="grid-item">
                    <input id="valorbaixa" name="valorbaixa" type="text" class="form-control" value="<? if (isset($rowcpr2['VALORBAIXA'])) echo number_format($rowcpr2['VALORBAIXA'],2,',',''); ?>" style="text-align:right;"  readonly tipocpc="moeda" tabindex="-1">
                </div>                
            </form>
            <? } ?>
        </div>
        <div class="formcpr2" onclick="showMain('<?php echo $_GET['indice'] ?? '' ?>', 'aba-item', 'financeiro/cpr2.php?indice=',null,'incluir_cpr2');"></div>
        <div id="cpr3"></div>
    </div>
</div>