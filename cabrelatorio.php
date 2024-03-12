<?php
// Define o caminho para o arquivo de texto
$arquivo = 'C:/cpc/modelos/cabecalho.txt';

// Verifica se o arquivo existe
if(file_exists($arquivo)) 
    // Lê o conteúdo do arquivo
    $conteudo = file_get_contents($arquivo);
?>
<div style="min-width:100vw"><? echo $conteudo ?></div>