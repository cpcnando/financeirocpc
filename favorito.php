<?
 include "headermain.php";
 include "sgbd/fatura.php";
 
if (($_SESSION["SISTEMA"] !=='10' ) && ($_SESSION["SISTEMA"] !=='65' )){ ?>
<div class="container text-center" style="overflow-y: auto; height:calc(100vh - 140px)">
    <div class="row d-flex justify-content-evenly m-2">

<?
   $sql ="select first 20 * from favoritosistema(". $_SESSION['SISTEMA'] .",".$_SESSION['ID_CPC'].") order by favorito desc, ordem desc, descricao";
   foreach ($fatura->query($sql) as $rowsistema)
    {
   ?>
        <div class="card p-1 m-1 text-center <? if ($rowsistema['FAVORITO'] === 'S') echo 'text-primary' ?>" style="width:140px; cursor:pointer" onclick="<? echo $rowsistema['COMANDO']?>"><i class="<? echo $rowsistema['ICONE'] ?> fa-2xl m-4" style="color: #008898"></i><p><? echo $rowsistema['DESCRICAO'] ?></div>
<? }
?>
    </div>
</div>
<? } ?>