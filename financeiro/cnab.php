<?php
include __DIR__."/../headermain.php";
// Definir o nome do arquivo para download
$nomeDoArquivo = $_GET['file'];

// Definir o conte�do do arquivo
if (strpos($_GET['file'],'_'.$_SESSION['ID_CPC'].'.txt'))
    $conteudo = file_get_contents('C:\\cpc\\file\\'.$_GET['file']);
else{
    $conteudo = "Acesso negado ao arquivo";
    unlink('C:\\cpc\\file\\'.$nomeDoArquivo);
    $nomeDoArquivo = "acessonegado.txt";
}

// Definir cabe�alhos para for�ar o download
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $nomeDoArquivo . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($conteudo));

// Limpar o buffer de sa�da do sistema e enviar o conte�do
ob_clean();
flush();
echo $conteudo;

// Finalizar o script para prevenir envio de dados adicionais
unlink('C:\\cpc\\file\\'.$nomeDoArquivo);
exit;
?>