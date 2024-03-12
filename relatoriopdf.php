<head>
<title>asdsda<title>
</head>
<?php 

include "sgbd/imagens.php";
session_start();

$pronto = 'N';
while ($pronto != 'S')
{
  sleep(1);
  $sqldoc = "select relatorio, status from relatoriopdf(". $doc .")";
  foreach ($imagens->query($sqldoc) as $rowdoc) {}

if  ($rowdoc['STATUS'] == 'OK') $pronto = 'S';
else {
    $imagens->commit();
    sleep(2);
}

}

header('Content-type: application/pdf');
header("Expires: Sun, 25 Jul 1997 06:02:34 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Title: Documento CPC");
echo $rowdoc['RELATORIO'];

?>