<?php
if (isset($_SESSION['config']['folha']['sgbd'])) {
    $folha = new PDO($_SESSION['config']['folha']['sgbd'], $_SESSION['config']['folha']['usuario'], $_SESSION['config']['folha']['senha']);
    if (isset($_SESSION['ID_CPC']))
    {
        $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
        foreach ($folha->query($dmllog) as $rowlog) {}
    }
}
?>