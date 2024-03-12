<?
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/imagens.php";
?>
<div class="linha-com-nome">
    <hr>
    <span class="nome-no-meio">Docs Digitais</span>
</div>
<div class="card" >
    <div class="card-body" > 
        <h5 class="card-title">Documentos em anexo <span class="badge bg-primary"><?echo $row['INDICE']  ?? '' ?></span></h5>
        <div class="cpc-anexochamado row banco_imagem">
            <form name="bancoimagem" id="bancoimagem" action="atend/dml.php" class="row g-3" enctype="multipart/form-data" method="post"  accept-charset="iso-8859-1">
                <input type="hidden" id="tipodml" name="tipodml" value="anexos">
                <input type="hidden" id="tipo" name="tipo" value="<? echo $_GET['indice'] ?>">                
                <div class="col-md-12"> 
                    <div class="input-group">               
                        <input class="form-control" type="file" name="anexo[]" id="anexo" > 
                        <span class="input-group-text btn btn-primary" style="cursor:pointer" onclick="dmlitem($('#bancoimagem'),'atende/dml','null','geral/bancoimagem','cpc-anexo');">Enviar</span>
                    </div>
                    
                </div>            
                <?php                             
                    $sql = "select * from imagens where tipo = '".$_GET['indice']."'";                    
                    foreach ($imagens->query($sql) as $rowanexo) 
                    {
                ?>
                    <div class="card m-4" id="card<?php echo $rowanexo['NUMERO']?>" style="width: 18rem;">
                        <div style="max-height: 200px; overflow: hidden; min-height: 200px">
                            <a href="geral/arquivo.php?ext=<?php echo $rowanexo['EXTENSAO'] ?? '' ; ?>&indice=<?php echo $rowanexo['NUMERO']; ?>" target=_new>
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <img id="myImg" class="card-img-top mx-auto my-auto img-fluid" src="data:image/png;base64,<?php echo base64_encode($rowanexo['IMAGEM']) ?>" alt="<? echo $rowanexo['NOME'] ?>">
                                </div>
                            </a>
                        </div>
                        <p class="card-text"><input type="text" class="form-control" id="<?php echo $rowanexo['NUMERO'] ?? '' ?>" onchange="showMain($(this).val(),'cpc-vazio','atende/dml.php?pk=<?php echo $rowanexo['NUMERO']?>&imgnome=')" class="textarea100 bg-cpc-cinzaclaro" value="<? echo $rowanexo['NOME'] ?>"></p>
                        <div>
                            <div class="col-12 d-flex justify-content-around mb-2">       
                                <button id="salvar" class="btn btn-outline-success" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Salvar/Confirmar">
                                    <i class="bi bi-check-all"></i> Salvar 
                                </button>
                                <button onclick="deleteitem('imagens','imagens','numero','<?php echo $rowanexo['NUMERO'] ?? ''  ?>','card<?php echo $rowanexo['NUMERO']?>');" class="btn btn-danger" type="button" title="Apagar Anexo">
                                    <i class="fa fa-trash-o"></i> Apagar 
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div> 