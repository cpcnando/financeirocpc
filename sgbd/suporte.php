<?php
if (isset($_SESSION['config']['suporte']['sgbd'])) {
    $suporte = new PDO($_SESSION['config']['suporte']['sgbd'], $_SESSION['config']['suporte']['usuario'], $_SESSION['config']['suporte']['senha']);
    // if ((isset($_POST['tipo'])) || (isset($_GET['delid'])))
    // {
    //     $dmllog = "select * from logvariavel('CPC Web','1.0.0.0',".$_SESSION['ID_CPC']."); ";
    //     foreach ($fatura->query($dmllog) as $rowlog) {}
    // }
}
?>