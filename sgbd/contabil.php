<?php
if (isset($_SESSION['config']['contabil']['sgbd'])) {
    $contabil = new PDO($_SESSION['config']['contabil']['sgbd'], $_SESSION['config']['contabil']['usuario'], $_SESSION['config']['contabil']['senha']);
    if (isset($_SESSION['ID_CPC']))
    {
        $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
        foreach ($contabil->query($dmllog) as $rowlog) {}
    }
}
?>