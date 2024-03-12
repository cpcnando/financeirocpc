<?
include __DIR__."/../headermain.php";
include __DIR__."/fatura.php";

$sql = "select * from acessosistema(".$_SESSION['SISTEMA'].",".$_SESSION['ID_CPC'].",'".$_SESSION['ACESSO']."','S')";
foreach ($fatura->query($sql) as $rowacesso) {
  $_SESSION['ACESSONOME']  = $rowacesso['ACESSONOME'];
  $_SESSION['ACESSOICONE'] = $rowacesso['ACESSOICONE'];

}
if ($rowacesso['DML_Q'] !== 'S'){
  include __DIR__."/../acessonegado.php";
  exit;
}
$favorito = $rowacesso['FAVORITO'];
?>
<input type="hidden" id="tela_acesso" onclick="<? echo $rowacesso['COMANDO'] ?>">
<input type="hidden" id="favorito_icone" value="<? echo $rowacesso['FAVORITO'] ?>">

<input type="hidden" id="fav_acesso" onclick="atualizaCampo('favorito','<? echo $_SESSION['ACESSO'] ?>','<? echo $_SESSION['ACESSO'] ?>','texto',true); $('#acessoicone').toggleClass('text-primary')">
