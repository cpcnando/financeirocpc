
<?
 include "headermain.php";
 include "sgbd/fatura.php";


if ($_GET['indice'] == 'tela_add')
{
?>    
    <a onclick="ajustaAltura('S'); window.print(); ajustaAltura('N');"  class="card p-1 m-1 text-center">Imprimir</a>
    <a class="card p-1 m-1 text-center" onclick="$('#tela_acesso').click()">Cancelar</a>
<?
}

else if ($_GET['indice'] == 'evolucao')
{
    $sql = "select descricao datahora, evolucao, tipo from evolucaonova(".$_SESSION['CODIGOCPS'].",".$_SESSION['PROF'].",'".$_SESSION['TIPOEVOL']."')";
    foreach ($fatura->query($sql) as $rowlistaevol)
    {  

?>
    <a onclick="showMain('<? echo $rowlistaevol['EVOLUCAO']; ?>','cpc-alta-dados','altadados.php?dml=I&indice='); showMain('<? echo $rowlistaevol['EVOLUCAO']; ?>','cpc-alta-apoio','altaapoio.php?indice='); showMain('<? echo $rowlistaevol['EVOLUCAO']; ?>','cpc-alta-lista','altalista.php?indice=');" data-rel="back"><? echo $rowlistaevol['DATAHORA'] ?></a>
<? }
}

else if ($_GET['indice'] === 'favorito')
{
    echo  "<div class='text-center sticky-top' style='background-color: #008898; color: #fff; padding:5px; cursor:context-menu'>Favoritos/Recentes</div>";
    $sql ="select first 20 * from favoritosistema(". $_SESSION['SISTEMA'] .",".$_SESSION['ID_CPC'].") order by favorito desc, ordem desc, descricao";
    foreach ($fatura->query($sql) as $rowsistema)
     {
    ?>
     <a href onclick="<? echo $rowsistema['COMANDO']?>" class="card p-1 popup-item dropdown-item" style="border:none; border-radius: 0px"><div class="d-flex align-items-center <? if ($rowsistema['FAVORITO'] === 'S') echo 'text-primary' ?>"><i class="<?php echo $rowsistema['ICONE']; ?> me-2" style="color: #008898"></i><?php echo $rowsistema['DESCRICAO']; ?></div></a> 
<? }
}

else if ($_GET['indice'] === 'info')
{
    echo  "<div class='text-center sticky-top' style='background-color: #008898; color: #fff; padding:5px; cursor:context-menu'><i class='fa-solid fa-user-shield me-2'></i>".$_SESSION["USUARIONOME"]."</div>";
?>
    <a href onclick="showMain('geral/senhaupdate');" class="card p-1 popup-item dropdown-item" style="border:none; border-radius: 0px"><div class="d-flex align-items-center"><i class="fa-solid fa-key me-2"></i>Alterar senha</div></a>
    <a href onclick="inputbox('Senha','inputpassword','','cpcMain'); $('#listapopupcpc').hide()" class="card p-1 popup-item dropdown-item" style="border:none; border-radius: 0px"><div class="d-flex align-items-center"><i class="fa-solid fa-user-lock me-2"></i>Bloquear tela</div></a>
    <a href onclick="showMain('geral/atalho');" class="card p-1 popup-item dropdown-item" style="border:none; border-radius: 0px"><div class="d-flex align-items-center"><i class="fa-solid fa-arrow-down-short-wide me-2"></i>Atalhos</div></a>
    <a id="sair" href="logout.php" target="_top"  class="card p-1 popup-item dropdown-item" style="border:none; border-radius: 0px"><div class="d-flex align-items-center"><i class="fa-solid fa-right-from-bracket me-2"></i>Sair do sistema</div></a>
<?
}

if ($_GET['indice'] == 'pacs')
{
?>
    <a onclick="showMain('','cpc-alta-dados','altadados.php?dml=I&indice=');"> <i class="fa fa-solid fa-user me-2"></i> <? echo $_SESSION["USUARIONOME"]; ?></a>    
    <a onmouseup="showMain('geral/senhaupdate');"><i class="fa-solid fa-eye-slash me-2"></i>Alterar senha</a>    
    <a onclick="inputbox('Senha','inputpassword','','cpcMain')">Bloquear tela</a>
    <a onclick="showMain('pacs/downloads','cpcMain',undefined);">Downloads</a>
    <a href="logout.php" target="_top" >Sair do sistema</a>
<?
}
if ($_GET['indice'] == 'cadastro')
{
    //$sql = "select descricao datahora, evolucao, tipo from evolucaonova(".$_SESSION['CODIGOCPS'].",".$_SESSION['PROF'].",'".$_SESSION['TIPOEVOL']."')";
    //foreach ($fatura->query($sql) as $rowlistaevol)
    {

?>
    <a onclick="showMain('syshosp/cad_profissional');" data-rel="back">Profissional</a>
    <a onclick="showMain('','cpc-alta-dados','altadados.php?dml=I&indice='); showMain('','cpc-alta-apoio','altaapoio.php?indice='); showMain('','cpc-alta-lista','altalista.php?indice=');" data-rel="back">Convenio</a>
    <a onclick="showMain('','cpc-alta-dados','altadados.php?dml=I&indice='); showMain('','cpc-alta-apoio','altaapoio.php?indice='); showMain('','cpc-alta-lista','altalista.php?indice=');" data-rel="back">Agenda</a>
    <a href="logout.php" target="_top" >Sair do sistema</a>
<? }
}

elseif ($_GET['indice'] == 'impresso')
{
?>
    <a onclick="showMain('0','impressodados','impresso_get.php?dml=I&indice=');" data-rel="back">Em Branco</a>

<? $sql = "SELECT titulo, tipo FROM impressolista(".$_SESSION['ID_CPC'].") ORDER BY TITULO, tipo";
    foreach ($fatura->query($sql) as $rowlistaimpresso)
    {  

?>
    <a onclick="showMain('<? echo $rowlistaimpresso['TITULO']; ?>','impressodados','impresso_get.php?dml=I&indice=');" data-rel="back"><? echo $rowlistaimpresso['TITULO'] ?></a>
<? }
}

elseif ($_GET['indice'] == 'solicitacoes')
{
    $sql = "select * from cps6nova(".$_SESSION['CODIGOCPS'].",".$_SESSION['PROF'].") WHERE DESCRICAO <> ''";
    foreach ($fatura->query($sql) as $rowlistacps6)
    {
?>
    <a onclick="showMain('<? echo $rowlistacps6['PRESCRICAO']; ?>','cpc-solicitacoes-dados','solicitacoesdados.php?dml=I&indice='); showMain('0','solicitacoeslista','solicitacoeslista.php?indice='); showMain('<? echo $rowlistacps6['PRESCRICAO']; ?>','solicitacoesbusca','solicitacoesbusca.php?indice=');  document.getElementById('busca').focus();" data-rel="back"><? echo $rowlistacps6['DESCRICAO'] ?></a>
<? }
}
elseif ($_GET['indice'] == 'prescricao')
{
    $sql = "select * from prescricaonova(".$_SESSION['CODIGOCPS'].",".$_SESSION['PROF'].") WHERE DESCRICAO <> ''";
    foreach ($fatura->query($sql) as $rowlistaprescricao)
    {
?>
    <a onclick="showMain('<? echo $rowlistaprescricao['PRESCRICAO']; ?>','cpc-prescricao-dados','prescricaodados.php?dml=I&indice='); setTimeout(function(){ showMain('0','cpc-prescricao-lista','prescricaolista.php?indice='); showMain('<? echo $rowlistaprescricao['PRESCRICAO']; ?>','cpc-prescricao-view','prescricaoview.php?indice='); },1000)" data-rel="back"><? echo $rowlistaprescricao['DESCRICAO'] ?></a>
<? }
}
// if ($_SESSION['SISTEMA'] == 40) include "financeiro/listapopup_get.php";
// if ($_SESSION['SISTEMA'] == 40) include "estoque/listapopup_get.php";
// if ($_SESSION['SISTEMA'] == 40) include "laudo/listapopup_get.php";
// if ($_SESSION['SISTEMA'] == 90) include "atende/listapopup_get.php";
include $_SESSION['SISTEMAPASTA']."/listapopup_get.php";
?>