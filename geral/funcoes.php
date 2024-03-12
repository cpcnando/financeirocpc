<?php
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/fatura.php";

//****************************************TABELA USUARIOS************************************
function converteRTF($rtf) {
    global $fatura;
    $dml = "SELECT texto FROM rtf_convert(?)";
    $data = array($rtf);  
    $dmlcmd = $fatura->prepare($dml);
    try {
        $dmlcmd->execute($data);  
        $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
        return $row['TEXTO'];
    } catch (PDOException $e) {
        return substr($rtf, 0, -100);
    }  
}
?>