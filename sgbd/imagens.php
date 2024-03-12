<?php
if (isset($_SESSION['config']['imagens']['sgbd'])) {
    $imagens = new PDO($_SESSION['config']['imagens']['sgbd'], $_SESSION['config']['imagens']['usuario'], $_SESSION['config']['imagens']['senha']);
    // if (isset($_SESSION['ID_CPC']))
    // {
    //     $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
    //     foreach ($imagens->query($dmllog) as $rowlog) {}
    // }
}
?>