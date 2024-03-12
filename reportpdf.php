<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
include "sgbd/imagens.php";



if ($_GET['comando'] == 'alta') 
$sql = "select doc from rel_Cria('evolucao','".$_SESSION['evolucaoenf']."','".$_SESSION['CODIGOCPS']."',null,null)";
if ($_GET['comando'] == 'solicitacao') 
$sql = "select doc from rel_Cria('solicitacao','".$_SESSION['cps6id']."','".$_SESSION['CODIGOCPS']."',null,null)";
if ($_GET['comando'] == 'prescricao') 
$sql = "select doc from rel_Cria('prescricao','".$_SESSION['notamed']."','".$_SESSION['CODIGOCPS']."',null,null)";

foreach ($imagens->query($sql) as $rowdoc) {}


$doc = $rowdoc['DOC'];
$imagens->commit();
//echo $sql;
include "relatoriopdf.php";
