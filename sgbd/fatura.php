<?php
if (isset($_SESSION['config']['fatura']['sgbd'])) {
    $fatura = new PDO($_SESSION['config']['fatura']['sgbd'], $_SESSION['config']['fatura']['usuario'], $_SESSION['config']['fatura']['senha']);
    if (isset($_SESSION['ID_CPC']))
    {
        $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
        foreach ($fatura->query($dmllog) as $rowlog) {}
    }
}
?>