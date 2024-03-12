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
    <title>Alguns de Nossos Clientes</title>
    <?php include "scriptheaderapp.php"?>    
</head>
<body style="color: #e5e5e5;">
<div class="container">
    <h1 class="text-center mt-2" style="color: #807e7e; font-size: 20px;">Alguns de Nossos Clientes</h1>
    <div class="row mt-2">
        <?
            $sql = "SELECT * FROM empresa where app = 'S' order by ordem, EMPRESA_RAZAOSOCIAL ";
            foreach ($suporte->query($sql) as $rowclientes) {
        ?>
        <div class="col-6 col-lg-6 mt-2">
            <div class="card shadow rounded-3" style="border: none; cursor: pointer; height: 190px;" onclick="$('#exampleModal<?php echo $rowclientes['EMPRESA_CODIGO']?>').modal('show');">
                <div class=" p-4">
                    <div class="card-icon card-icon-large"></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0 text-center"><img src="<? echo $rowclientes['IMAGEMAPP'];?>" class="img-fluid rounded" alt=""></h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">

                        <div class="col-12 text-right text-center" style="font-size: 13px;">
                            <span><? echo $rowclientes['EMPRESA_RAZAOSOCIAL'];?></span>
                        </div>
                    </div>
                    <div class="text-center mt-3" style="font-size: 12px;">                        
                        <? echo $rowclientes['EMPRESA_CIDADE'];?>               
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal<?php echo $rowclientes['EMPRESA_CODIGO']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="heigt: 90%;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $rowclientes['EMPRESA_RAZAOSOCIAL']?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                        <img class="img-fluid rounded text-center" src="<?php echo $rowclientes['IMAGEMAPP']?>" alt="">
                    <hr>
                        <div class="text-center mt-3" style="font-size: 12px;">                        
                            <? echo $rowclientes['DESCRICAO'];?>               
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