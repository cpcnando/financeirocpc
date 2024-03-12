<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
// $mensagem= "<span class='close'>&times;</span><div class='bg-cpc-verdeclaro h3'>Registro inserido com sucesso.</div>";
//*********************************************Tabela escalaglasgow***************************************
if ((isset($_GET['tabela'])) && ($_GET['tabela'] != ""))
{
  if ($_GET['banco'] == 'suporte') include "sgbd/suporte.php";
  if ($_GET['banco'] == 'fatura') include "sgbd/fatura.php";
  if ($_GET['banco'] == 'contabil') include "sgbd/contabil.php";
  if ($_GET['banco'] == 'almoxa') include "sgbd/almoxa.php";
  if ($_GET['banco'] == 'pacs') include "sgbd/pacs.php";
  if ($_GET['banco'] == 'imagens') include "sgbd/imagens.php";
  if ($_GET['banco'] == 'financeiro') include "sgbd/financeiro.php";
  if ($_GET['banco'] == 'folha') include "sgbd/folha.php";
  if (($_GET['dml']) == 'D')
    $dml = "delete from ".$_GET['tabela']." where ".$_GET['campo']." = ?";
  if (($_GET['tipo']) == 'pacs')
    $dml = "update ".$_GET['tabela']." set ativo = 'N' where pk = ?";
  $data = array($_GET['pk']);  
  if ($_GET['banco'] == 'suporte')    $dmlcmd = $suporte->prepare($dml);
  if ($_GET['banco'] == 'fatura')     $dmlcmd = $fatura->prepare($dml);
  if ($_GET['banco'] == 'contabil')     $dmlcmd = $contabil->prepare($dml);
  if ($_GET['banco'] == 'almoxa')     $dmlcmd = $almoxa->prepare($dml);
  if ($_GET['banco'] == 'pacs')       $dmlcmd = $pacs->prepare($dml);
  if ($_GET['banco'] == 'financeiro') $dmlcmd = $financeiro->prepare($dml);
  if ($_GET['banco'] == 'imagens') $dmlcmd = $imagens->prepare($dml);
  if ($_GET['banco'] == 'folha') $dmlcmd = $folha->prepare($dml);
  
  
  try{
    $dmlcmd->execute($data);  
    echo 'sucesso';
}catch(PDOException $e){
  echo $dml;
  echo "</br>";
    echo $e->getMessage();
}  
}
?>