<?php
if (isset($_SESSION['config']['almoxa']['sgbd'])) {
    $almoxa = new PDO($_SESSION['config']['almoxa']['sgbd'], $_SESSION['config']['almoxa']['usuario'], $_SESSION['config']['almoxa']['senha']);
    if (isset($_SESSION['ID_CPC']))
    {
        $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
        foreach ($almoxa->query($dmllog) as $rowlog) {}
    }
}
?>