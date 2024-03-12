<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
// $mensagem= "<span class='close'>&times;</span><div class='bg-cpc-verdeclaro h3'>Registro inserido com sucesso.</div>";
//*********************************************Tabela escalaglasgow***************************************
if ((isset($_POST['sql'])) && ($_POST['sql'] != ""))
{
    include "sgbd/suporte.php";
  if ($_POST['banco'] == 'suporte') include "../sgbd/suporte.php";
  if ($_POST['banco'] == 'fatura') include "sgbd/fatura.php";
  if ($_POST['banco'] == 'almoxa') include "sgbd/almoxa.php";
  if ($_POST['banco'] == 'financeiro') include "sgbd/financeiro.php";
  if ($_POST['banco'] == 'suporte')    $sgbd = $suporte;
  if ($_POST['banco'] == 'fatura')     $sgbd = $fatura;
  if ($_POST['banco'] == 'almoxa')     $sgbd = $suporte;
  if ($_POST['banco'] == 'financeiro') $sgbd = $suporte;
  try{
    $dml = $_POST['sql'];
    foreach ($sgbd->query($dml) as $row) {echo $row[0];}
    
}catch(PDOException $e){
    echo $e->getMessage();
}  
$sgbd->commit();
}

