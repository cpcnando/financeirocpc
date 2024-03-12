<?
 include "headermain.php";
 include "configjson.php";
 include "sgbd/suporte.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informativos</title>
    <?php include "scriptheaderapp.php"?>    
</head>
<body style="color: #e5e5e5;">
<div class="container">
    <h1 class="text-center mt-2" style="color: #807e7e; font-size: 20px;">Informativos</h1>
    <div class="row mt-2">
        <?
            $sql = "SELECT * FROM informativos where ativo = 'S' order by ordem desc";
            foreach ($suporte->query($sql) as $rowinformativo) {
        ?>
   
        <div class="col-12 col-lg-12 mt-2">
            <div class="card shadow rounded-3" style="border: none; cursor: pointer; height: <?php if ($rowinformativo['PRINCIPAL'] === 'S'){ echo '3';} else {echo '2';}?>00px;" onclick="$('#exampleModal<?php echo $rowinformativo['INDICE']?>').modal('show');">
                <div class=" p-4">                  
                    <div class="row">    
                        <div class="col-<?php if ($rowinformativo['PRINCIPAL'] === 'S'){ echo '12';} else {echo '6';}?>">
                            <h5 class="card-title mb-0 text-<?php if ($rowinformativo['PRINCIPAL'] === 'S'){ echo 'center';} else {echo 'left';}?>"><img src="<? echo $rowinformativo['IMAGEMAPP'];?>" <?php if ($rowinformativo['PRINCIPAL'] === 'S'){ echo 'left';} else {echo 'style="width:100px; margin-top:10px;"';}?> class="img-fluid rounded" alt=""></h5>
                        </div>
                        <div class="col-<?php if ($rowinformativo['PRINCIPAL'] === '12'){ echo 'center';} else {echo '6';}?>">                
                            <span style="font-size: 13px;"><? echo $rowinformativo['DESCRICAO'];?></span>                      
                        </div>
                    </div>
                    <div class="text-left mt-3" style="font-size: 12px;">                        
                        <? echo $rowinformativo['SUB_DESCRICAO'];?>               
                    </div>
                    <div class="text-end mt-2 mb-2" style="font-size: 12px;">                        
                        <a href="" style="padding:3px;color: #807e7e; background-color:#efefef; border-radius:5px;">Continuar Lendo</a>               
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal<?php echo $rowinformativo['EMPRESA_CODIGO']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="heigt: 90%;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $rowinformativo['EMPRESA_RAZAOSOCIAL']?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                        <img class="img-fluid rounded text-center" src="<?php echo $rowinformativo['IMAGEMAPP']?>" alt="">
                    <hr>
                        <div class="text-center mt-3" style="font-size: 12px;">                        
                            <? echo $rowinformativo['DESCRICAO'];?>               
                        </div>                    
                </div>                
                </div>
            </div>
        </div>
        <? } ?>
    </div>
    <?php include "scriptfooter.php"?>    
</body>
</html>