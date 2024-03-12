<?php
if (isset($_SESSION['config']['pacs']['sgbd'])) {
    $pacs = new PDO($_SESSION['config']['pacs']['sgbd'], $_SESSION['config']['pacs']['usuario'], $_SESSION['config']['pacs']['senha']);
    //if ((isset($_POST['tipo'])) || (isset($_GET['delid'])))
    // if (isset($_SESSION['ID_CPC']))
    // {
    //     $dmllog = "select * from logvariavel('".$_SESSION["SISTEMANOME"]." Web','".$_SESSION['config']['versao']."',".$_SESSION['ID_CPC']."); ";
    //     foreach ($pacs->query($dmllog) as $rowlog) {}
    // }
}
?>