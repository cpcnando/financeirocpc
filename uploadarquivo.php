<?php
$target_dir = "uploads/"; // Pasta onde os arquivos ser�o salvos
$target_file = $target_dir . basename($_FILES["arquivo"]["name"]); // Caminho completo do arquivo
$uploadOk = 1; // Flag para indicar se o upload foi bem-sucedido

// Verifica se o arquivo j� existe
if (file_exists($target_file)) {
    echo "Desculpe, o arquivo j� existe.";
    $uploadOk = 0;
}

// Verifica o tamanho m�ximo do arquivo (aqui, 5MB)
if ($_FILES["arquivo"]["size"] > 5000000) {
    echo "Desculpe, o arquivo � muito grande. O tamanho m�ximo permitido � 5MB.";
    $uploadOk = 0;
}

// Verifica se $uploadOk � 0 devido a um erro
if ($uploadOk == 0) {
    echo "Desculpe, o seu arquivo n�o p�de ser enviado.";
// Se tudo estiver certo, tenta fazer o upload
} else {
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        echo "O arquivo ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])). " foi enviado com sucesso.";
    } else {
        echo "Desculpe, houve um erro ao enviar o arquivo.";
    }
}
?>
