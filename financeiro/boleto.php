<?
    include __DIR__."/../headermain.php";
    $_SESSION['BOLETO'] = $_GET['tipo'];
    include __DIR__."/../assets/boletophp-master/boleto_bradesco.php"; 
?>
