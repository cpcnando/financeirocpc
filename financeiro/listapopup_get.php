<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();

if ($_GET['indice'] == 'fin_menu')
{
?>
<div class="list-group">
    <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" aria-current="true" style="border:none" data-bs-toggle="collapse" data-bs-target="#menucadastro" aria-expanded="true" aria-controls="collapseExample">
    Cadastro<i class="fa-solid fa-angles-right ms-4"></i></a>
    </a>
    <div class="list-group collapse" id="menucadastro">
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/conta');"style="border:none" class="list-group-item list-group-item-action ms-4">Contas/Caixa</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/clifor');"style="border:none" class="list-group-item list-group-item-action ms-4">Cliente/Fornecedor</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/natop');" style="border:none"class="list-group-item list-group-item-action ms-4">Natureza de Opera��o</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/ccusto');"style="border:none" class="list-group-item list-group-item-action ms-4">Centro de Custos</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/grupoclifor');" style="border:none"class="list-group-item list-group-item-action ms-4">Grupo Cli/For</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/tipobaixa');"style="border:none" class="list-group-item list-group-item-action ms-4">Tipo de Baixa</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/imposto');" style="border:none"class="list-group-item list-group-item-action ms-4">Imposto</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('geral/usuario');" style="border:none"class="list-group-item list-group-item-action ms-4">Usu�rio</a></li>
    </div>
</div>
<div class="list-group mt-1">
    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="border:none" aria-current="true" data-bs-toggle="collapse" data-bs-target="#menulancamento" aria-expanded="false" aria-controls="collapseExample">
    Lan�amentos<i class="fa-solid fa-angles-right ms-4"></i>
    </a>
    <div class="list-group collapse" id="menulancamento">
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>        
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/baixa','cpcMain',undefined,'#listabaixa');" style="border:none"class="list-group-item list-group-item-action ms-4">Baixa de T�tulos</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('P','cpcMain','financeiro/cpr.php?tipocpr=')" style="border:none"class="list-group-item list-group-item-action ms-4">Contas a Pagar</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('R','cpcMain','financeiro/cpr.php?tipocpr=')" style="border:none"class="list-group-item list-group-item-action ms-4">Contas a Receber</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/transferencia');"style="border:none" class="list-group-item list-group-item-action ms-4">Transfer�ncia</a></li>
        <li class="ms-2"><a href=""  onclick="showMain('financeiro/importentrada','cpcMain',undefined,'#listaimportentrada');"style="border:none" class="list-group-item list-group-item-action ms-4">Importar Entradas do Estoque</a></li>
    </div>
</div>
<div class="list-group mt-1">
    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelatorio" aria-expanded="false" aria-controls="collapseExample">Relat�rios<i class="fa-solid fa-angles-right ms-2"></i></a>
    <div class="list-group collapse" id="menurelatorio">
        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelanalitico" aria-expanded="false" aria-controls="collapseExample">Analiticos
        <i class="fa-solid fa-angles-right ms-4"></i></a>
        <div class="ms-2 list-group collapse" id="menurelanalitico">
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/analitico_conta');"style="border:none" class="list-group-item list-group-item-action ms-4">Conta/Caixa</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Centro de Custos</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Natureza de Opera��o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Conta/Caixa por Data</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Rela��o dos Descontos</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Informe de Rendimento</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Exporta��o de Arquivo DMS</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Origens e Aplica��ess de Financeiro</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Reten��es por Per�odo</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Cheque Pr�-Datado</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Pagamento Antecipado</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Cheques Emitidos</a></li>
        </div>

        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelfinanceiro" aria-expanded="false" aria-controls="collapseExample">Financeiros
        <i class="fa-solid fa-angles-right ms-4"></i></a>
        <div class="ms-2 list-group collapse" id="menurelfinanceiro">
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Balan�o Contas/Caixa</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Balan�o C. Custos</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Balan�o Natureza de Opera��o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Anual por Nat. de Opera��o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
        </div>

        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelestatistico" aria-expanded="false" aria-controls="collapseExample">Estat�sticos
        <i class="fa-solid fa-angles-right ms-4"></i></a>
        <div class="ms-2 list-group collapse" id="menurelestatistico">
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Conta/Caixa</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Departamento</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Natureza de Opera��o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Linha de Tend�ncia</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">An�lise de Balan�o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Distribui��o de Faturamento Anual</a></li>
        </div>

        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelcpr" aria-expanded="false" aria-controls="collapseExample">CPR
        <i class="fa-solid fa-angles-right ms-4"></i></a>
        <div class="ms-2 list-group collapse" id="menurelcpr">
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/fluxo_caixa');"style="border:none" class="list-group-item list-group-item-action ms-4">Fluxo de Caixa</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Pagamentos e Recebimentos</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a></li>
        </div>

        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none" aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelgenerica" aria-expanded="false" aria-controls="collapseExample">Listagens Gen�ricas<i class="fa-solid fa-angles-right ms-4"></i></a>
        <div class="ms-2 list-group collapse" id="menurelgenerica">
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Clientes/Fornecedor</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Conta Corrente</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">C. Custos</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Natureza de Opera��o</a></li>
            <li class="ms-2"><a href=""  onclick="showMain('financeiro/relatorios/movimento');" style="border:none"class="list-group-item list-group-item-action ms-4">Usu�rios</a></li>
        </div>
        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelcpr" aria-expanded="false" aria-controls="collapseExample">Concilia��o Banc�ria</a>
        <a href=""  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ms-4" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menurelcpr" aria-expanded="false" aria-controls="collapseExample">Relat�rio Di�rio</a>
    </div>

</div>
<div class="list-group mt-1">
    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="border:none"aria-current="true" data-bs-toggle="collapse" data-bs-target="#menuutilitario" aria-expanded="false" aria-controls="collapseExample">
    Utilit�rios <i class="fa-solid fa-angles-right ms-4"></i>
    </a>
    <div class="list-group collapse" id="menuutilitario">
        <a href=""  onclick="showMain('financeiro/movimento');"style="border:none" class="list-group-item list-group-item-action ms-4">Movimento Banc�rio</a>
    </div>
</div>
    <!-- <a href=""  onclick="showMain('financeiro/movimento');" class="ui-btn-cpc">Movimento Banc�rio</a>
    <a href=""  onclick="showMain('financeiro/baixa','cpcMain',undefined,'#listabaixa');" class="ui-btn-cpc">Baixa de T�tulos</a>
    <a href=""  onclick="showMain('financeiro/cpr');" class="ui-btn-cpc">Contas a Pagar</a>
    <a href=""  onclick="showMain('financeiro/cpr');" class="ui-btn-cpc">Contas a Receber</a>
    <a href=""  onclick="showMain('financeiro/transferencia');" class="ui-btn-cpc">Transfer�ncia</a>
    <a href=""  onclick="showMain('financeiro/conta');" class="ui-btn-cpc">Contas/Caixa</a>
    <a href=""  onclick="showMain('financeiro/clifor');" class="ui-btn-cpc">Cliente/Fornecedor</a>
    <a href=""  onclick="showMain('financeiro/natop');" class="ui-btn-cpc">Natureza de Opera��o</a>
    <a href=""  onclick="showMain('financeiro/ccusto');" class="ui-btn-cpc">Centro de Custos</a>
    <a href=""  onclick="showMain('financeiro/grupoclifor');" class="ui-btn-cpc">Grupo Cli/For</a>
    <a href=""  onclick="showMain('financeiro/tipobaixa');" class="ui-btn-cpc">Tipo de Baixa</a>
    <a href=""  onclick="showMain('financeiro/imposto');" class="ui-btn-cpc">Impostos</a> -->
<?
}
if ($_GET['indice'] == 'fin_rel')
{
?>
    <a href=""  onclick="showMain('financeiro/relatorios/analitico');" class="ui-btn-cpc">Analitico por Conta Corrente</a>
    <a href=""  onclick="showMain('financeiro/relatorios/flu_caixa','cpcMain',undefined,'#listabaixa');" class="ui-btn-cpc">Fluxo de caixa</a>    
<?
}
?>