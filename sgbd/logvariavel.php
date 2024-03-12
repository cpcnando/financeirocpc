<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();

include "sgbd/fatura.php";

date_default_timezone_set('America/Bahia');

if (isset($_SESSION["CODIGOCPS"]))
{
    $sqllog = "SELECT * FROM VARIAVELBD('CPS','".$_SESSION['CODIGOCPS']."')";
    foreach ($fatura->query($sqllog) as $rowlog) {}    
}

if (isset($_SESSION["CODIGOPAC"]))
{
    $sqllog = "SELECT * FROM VARIAVELBD('PACIENTE','".$_SESSION['CODIGOPAC']."')";
    foreach ($fatura->query($sqllog) as $rowlog) {}
}

$sqllog = "select * from logvariavel('CPC Web','1.0.0.0',".$_SESSION['ID_CPC']."); ";
foreach ($fatura->query($sqllog) as $rowlog) {}

?>
