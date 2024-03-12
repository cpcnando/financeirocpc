<?php
$target_dir = "uploads/"; // Pasta onde os arquivos serão salvos
$target_file = $target_dir . basename($_FILES["arquivo"]["name"]); // Caminho completo do arquivo
$uploadOk = 1; // Flag para indicar se o upload foi bem-sucedido

// Verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Desculpe, o arquivo já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho máximo do arquivo (aqui, 5MB)
if ($_FILES["arquivo"]["size"] > 5000000) {
    echo "Desculpe, o arquivo é muito grande. O tamanho máximo permitido é 5MB.";
    $uploadOk = 0;
}

// Verifica se $uploadOk é 0 devido a um erro
if ($uploadOk == 0) {
    echo "Desculpe, o seu arquivo não pôde ser enviado.";
// Se tudo estiver certo, tenta fazer o upload
} else {
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        echo "O arquivo ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])). " foi enviado com sucesso.";
    } else {
        echo "Desculpe, houve um erro ao enviar o arquivo.";
    }
}
?>
