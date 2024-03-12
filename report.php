<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
include "sgbd/fatura.php";

date_default_timezone_set('America/Bahia');
include "scriptheader.php" ?>
<style>
    .paginaa4{
        width: 756px;
        height: 1058px;
    }
    .cabecalho{
        width: 100%;
    }
    .imgatual{
        height: 100px;
        width: 100px;
    }
    .cpc-alta-item-rel {
	max-width: 100%;
	margin: 0 auto;
	display: grid;
	grid-template-columns: repeat( 4, auto );
	grid-gap: 5px;
    vertical-align: middle;
    }
    @page {
    size: 21cm *cm;
    margin: 5mm 5mm 5mm 5mm; /* change the margins as you want them to be. */
}
</style>
<html>
<body onload="window.print();">
<div class="paginaa4">
    <div class="cabecalho">
            <div class="d-flex justify-content-between align-items-center">
                <? 
                    $sqlempresa = "SELECT first 1 logo,razaosocial FROM empresas order by codigo desc";

                    foreach ($fatura->query($sqlempresa) as $rowempresa)
                    {
                        //echo '<img alt="" class="imgatual" src="data:image/bmp;base64,'.base64_encode( $rowfoto['LOGO'] ).'"/>';
                    }                                    
                ?>
                <img alt="" class="imgatual" src="data:image/bmp;base64,<? echo base64_encode( $rowempresa['LOGO']) ?>"/>
                <div class="text-center d-flex flex-column justify-content-between">
                        <div class="font-weight-bold h5"><? echo $rowempresa['RAZAOSOCIAL']; ?></div>
                        <div>Prontuário:<? echo $_SESSION['CODIGOPAC']; ?></div>
                        <div class="font-weight-bold h5">Evolução do Paciente: <? echo $_SESSION['evolucaoenf'] ?></div>
                </div>
                <div class="h6">
                <? echo 'CPS: '.$_SESSION['CODIGOCPS']; ?>
                </div>
                </div>

    </div>
    <hr>
    <div class="cabecalho d-flex justify-content-between media">
        <? $sqlpac = "SELECT first 1 codigopac,a_nome, nasc, sexo,(select ano from idade_calc(paciente.nasc,current_date)) idade,(select a_datafat from cps1 where codigocps = ".$_SESSION['CODIGOCPS'].") ADMISSAO FROM paciente where codigopac = ".$_SESSION['CODIGOPAC'];
            foreach ($fatura->query($sqlpac) as $rowpac) {}
        ?>
        <div><b>Prontuário</b></b><br><? echo $_SESSION['CODIGOPAC']; ?></div>
        <div><b>Nome</b><br><? echo $rowpac['A_NOME']; ?></div>
        <div><b>Nasc</b><br><? echo date('d/m/Y', strtotime($rowpac['NASC'])); ?></div>
        <div><b>Sexo</b><br><? echo $rowpac['SEXO']; ?></div>
        <div><b>Idade</b><br><? echo $rowpac['IDADE']; ?></div>
        <div><b>Admissão</b><br><? echo date('d/m/Y', strtotime($rowpac['ADMISSAO'])); ?></div>
    </div>
    <hr>
    <div class="cabecalho">
        <? $sql =   "select cast(evolucao as integer) evolucao, datahora,tipoevol,".
                    "(select a_nome from usuarios where codigo =evolucaoenf.user1) USUARIO,".
                    "(select texto from RTF_CONVERT(evolucaoenf.HISTORIA_ADMISSAO)) HISTORIA_ADMISSAO,".
                    "(select texto from RTF_CONVERT(evolucaoenf.PROBLEMAS)) PROBLEMAS,".
                    "(select texto from RTF_CONVERT(evolucaoenf.SUSP_DIAGNOSTICA)) SUSP_DIAGNOSTICA,".
                    "(select texto from RTF_CONVERT(evolucaoenf.CONTEUDO)) CONTEUDO,".
                    "(select texto from RTF_CONVERT(evolucaoenf.PLANO_CONDUTA)) PLANO_CONDUTA,".
                    "(select texto from RTF_CONVERT(evolucaoenf.OBSERVACAO)) OBSERVACAO from evolucaoenf inner join cps1 on (evolucaoenf.evolucao = 0".$_SESSION['evolucaoenf']." and cps1.codigopac = 0".$_SESSION['CODIGOPAC']." and evolucaoenf.codigocps = cps1.codigocps) ";
            foreach ($fatura->query($sql) as $rowevoldados)
            {}
        ?>
        <div class="border text-center h6"><b>História</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['HISTORIA_ADMISSAO'];?></textarea></div>
        <div class="border text-center h6"><b>Exame Físico</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['PROBLEMAS'];?></textarea></div>
        <div class="border text-center h6"><b>Suspeita Diagnóstica</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['SUSP_DIAGNOSTICA'];?></textarea></div>
        <div class="border text-center h6"><b>Evolução</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['CONTEUDO'];?></textarea></div>

        <? $sql =   "select classe, coalesce(quantidade,1) quantidade, descricao,inicio, fim, observacao from altaitem where alta = 0".$_SESSION['evolucaoenf']." order by classe, inicio";
            $classe="";
            foreach ($fatura->query($sql) as $rowevolitem)
            {
                if ($classe != $rowevolitem['CLASSE']) {
                    if ($classe != "") echo "</div>";
        ?>
        <div class="cpc-alta-item-rel">
            <div class="border text-center h6"><b>Qtde</b></div>
            <div class="border text-center h6"><b><? echo $rowevolitem['CLASSE'] ?></b></div>
            <div class="border text-center h6"><b>Inicio</b></div>
            <div class="border text-center h6"><b>Final</b></div>
            <? $classe = $rowevolitem['CLASSE']; } ?>
            
                <div class="text-end" style="font-size: 13px;"><? echo $rowevolitem['QUANTIDADE'] ?></div>
                <div style="font-size: 13px;"><? echo $rowevolitem['DESCRICAO'] ?><br><? echo $rowevolitem['OBSERVACAO'] ?></div>
                <div class="text-end" style="font-size: 13px;"><? echo date('d/m/Y', strtotime($rowevolitem['INICIO'])) ?></div>
                <div class="text-end" style="font-size: 13px;"><? echo date('d/m/Y', strtotime($rowevolitem['FIM'])) ?></div>
            
            <? } ?>
        </div>
        <div class="border text-center h6"><b>Conduta</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['PLANO_CONDUTA'];?></textarea></div>
        <div class="border text-center h6"><b>Observação</b></div>
        <div style="font-size: 13px;"><textarea class="textarea100"><? echo $rowevoldados['OBSERVACAO'];?></textarea></div>
    </div>
    <div class="cabecalho text-center d-flex flex-column justify-content-center" style="height:150px">
        <div></div>
        <div class="border-top border-3">Médico Teste<br>CRM 3433</div>
    </div>
</div>
<? include "scriptfooter.php" ?>
</body>
</html