<?
session_start();
include  __DIR__."/../sgbd/imagens.php";

// if ($_GET['ext'] == 'jpg') header('Content-type: image/jpeg');
// if ($_GET['ext'] == 'jpeg') header('Content-type: image/jpeg');
// elseif ($_GET['ext'] == 'png') header('Content-type: image/png');
// elseif  ($_GET['ext'] == 'pdf') header('Content-type: application/pdf');
// elseif  ($_GET['ext'] == 'zip') header('Content-type: application/zip');



if (($_GET['indice'] != ''))
{
    
    $sql = "select imagem, contenttype,nome,extensao from imagens where numero = ".$_GET['indice'];
    foreach($imagens->query($sql) as $row){}
    header('Content-type: '.$row['CONTENTTYPE']);
    if ($row['EXTENSAO'] == 'mp4')
    header('Content-Disposition: attachment; filename="'.$row['NOME'].'.'.$row['EXTENSAO'].'"');
    echo $row['IMAGEM'];
   
}


?>
