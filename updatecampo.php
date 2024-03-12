<?php
    include __DIR__."/headermain.php";
if (session_status() != PHP_SESSION_ACTIVE)
session_start();

if(isset($_POST['tipo']) && ($_POST['tipo'] == 'baixastatus')) {
    
    include __DIR__."/sgbd/financeiro.php";
        if ($_POST['valor'] == 'true') $valor = $_SESSION['ID_CPC']; else $valor = 'null';
        
        $dml = "update cpr2 set marcado =".$valor." where numero =".$_POST['pk'];
        try{
            
            $dmlcmd = $financeiro->prepare($dml);
            $dmlcmd->execute();
            $financeiro->commit();  
            echo 'sucesso';
        }catch(PDOException $e){
            echo $e->getMessage();
        }          
     
}

if(isset($_POST['tipo']) && ($_POST['tipo'] == 'desmarcarbaixa')) {
    include __DIR__."/sgbd/financeiro.php";        
    $dml = "update cpr2 set marcado = null where marcado ='0".$_SESSION['ID_CPC']."'";
    try{
        $dmlcmd = $financeiro->prepare($dml);
        $dmlcmd->execute();
        $financeiro->commit();  
        echo 'sucesso';
    }catch(PDOException $e){
            echo $e->getMessage();
    }          
}

if(isset($_POST['tipo']) && ($_POST['tipo'] == 'baixavalor')) {
    include __DIR__."/sgbd/financeiro.php";
    $dml = "update cpr2 set baixar =".$_POST['valor']." where numero =".$_POST['pk'];
    try{
        $dmlcmd = $financeiro->prepare($dml);
        $dmlcmd->execute();
        $financeiro->commit();  
        echo 'sucesso';
    }catch(PDOException $e){
        echo $e->getMessage();
    }          
}


if(isset($_POST['tipo']) && ($_POST['tipo'] == 'importentrada')) {
    
    include __DIR__."/sgbd/almoxa.php";
        if ($_POST['valor'] == 'true') $valor = 'S'; else $valor = 'N';
        
        $dml = "update entra1 set importada ='".$valor."' where numero =".$_POST['pk'];
        try{
            $dmlcmd = $almoxa->prepare($dml);
            $dmlcmd->execute();
            $almoxa->commit();  
            echo 'sucesso';
        }catch(PDOException $e){
            echo $e->getMessage();
        }          
     
}




if(isset($_POST['tipo']) && ($_POST['tipo'] == 'status')) {
    
    include __DIR__."/sgbd/pacs.php";                
        $dml = "update study set status ='".$_POST['valor']."' where pk =".$_POST['pk'];
        try{
            $dmlcmd = $pacs->prepare($dml);
            $dmlcmd->execute();
            $pacs->commit();  
            echo 'sucesso';
        }catch(PDOException $e){
            echo $e->getMessage();
        }          
     
}


if(isset($_POST['tipo']) && ($_POST['tipo'] == 'chamadovalidar')) {
    include __DIR__."/sgbd/suporte.php";
        if ($_POST['valor'] == 'true') $valor = 'S'; else $valor = 'N';
        $dml = "update ajuda set validar ='".$valor."' where indice =".$_POST['pk'];
        try{
            $dmlcmd = $suporte->prepare($dml);
            $dmlcmd->execute();
            $suporte->commit();  
            echo 'sucesso';
        }catch(PDOException $e){
            echo $e->getMessage();
        }          
     
}


if(isset($_POST['tipo']) && ($_POST['tipo'] == 'estudodelete')) {
    include __DIR__."/sgbd/pacs.php";        
        $dml = "update study set ativo ='N' where pk =".$_POST['pk'];
        try{
            $dmlcmd = $pacs->prepare($dml);
            $dmlcmd->execute();
            $pacs->commit();  
            echo 'sucesso';
        }catch(PDOException $e){
            echo $e->getMessage();
        }          
     
}


if(isset($_POST['tipo']) && ($_POST['tipo'] == 'senhaupdate')) {
    include __DIR__."/sgbd/fatura.php";
    $dml = "update usuarios set senha ='".$_POST['valor']."' where codigo =".$_SESSION['ID_CPC'];
    try{
        $dmlcmd = $fatura->prepare($dml);
        $dmlcmd->execute();
        $fatura->commit();  
        echo 'sucesso';
    }catch(PDOException $e){
        echo $e->getMessage();
    }          
}

if(isset($_POST['tipo']) && ($_POST['tipo'] == 'favorito')) {
    include __DIR__."/sgbd/fatura.php";
    $dml = "update ".$_SESSION["SISTEMATABELAACESSO"]." set favorito = iif(coalesce(favorito,'N') = 'S','N','S') where OPERADOR = ".$_SESSION['ID_CPC']." and programa = '".iconv("UTF-8",  "ISO-8859-1",$_POST['pk'])."'";
    echo $dml;
    try{
        $dmlcmd = $fatura->prepare($dml);
        $dmlcmd->execute();
        $fatura->commit();  
        echo 'sucesso';
    }catch(PDOException $e){
        echo $e->getMessage();
    }          
}

if(isset($_POST['tipo']) && ($_POST['tipo'] == 'senhalock')) {
    include __DIR__."/sgbd/fatura.php";
    
    $sql = "SELECT nome FROM loginapp('".$_SESSION['ID_CPC']."','".$_POST['valor']."','".$_SESSION['SISTEMA']."')";
    
    try {
        foreach ($fatura->query($sql) as $row) {
            if (($row['NOME'] ?? '') != '') {
                echo 'sucesso';
                alert('sucesso');
            } else {
                echo 'Senha Errada';
                alert('errado');
            }
        }
    } catch (PDOException $e) {
        echo $sql;
        echo $e->getMessage();
    }
    }



?>
