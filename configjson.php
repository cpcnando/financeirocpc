<?
include "headermain.php";


// $config = json_decode(file_get_contents('C:\cpcUsers\areis\OneDrive\Documentos\CPC\web\config.json'), true);
$config = json_decode(file_get_contents('C:\cpc\json\config.json'), true);

// Verifique se o arquivo foi lido corretamente
if ($config === null) {
    die('O arquivo de configuração não pode ser lido ou não é um JSON válido.');
}

$_SESSION['config'] =  $config;

 ?>
