<?
include "headermain.php";


// $config = json_decode(file_get_contents('C:\cpcUsers\areis\OneDrive\Documentos\CPC\web\config.json'), true);
$config = json_decode(file_get_contents('C:\cpc\json\config.json'), true);

// Verifique se o arquivo foi lido corretamente
if ($config === null) {
    die('O arquivo de configura��o n�o pode ser lido ou n�o � um JSON v�lido.');
}

$_SESSION['config'] =  $config;

 ?>
