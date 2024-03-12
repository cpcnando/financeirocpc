<?php
if (isset($_SESSION['config']['financeiro']['sgbd'])) {
    $financeiro = new PDO($_SESSION['config']['financeiro']['sgbd'], $_SESSION['config']['financeiro']['usuario'], $_SESSION['config']['financeiro']['senha']);
    if (isset($_SESSION['ID_CPC']))
    {
        $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
        foreach ($financeiro->query($dmllog) as $rowlog) {}
    }
}
?>