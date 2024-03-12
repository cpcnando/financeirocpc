<?
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/fatura.php";
?>
<div class="linha-com-nome">
    <hr>
    <span class="nome-no-meio"></span>
</div>
<div class="card">
    <div class="card-header" >
        <form action="." method="post"  id="formlista" name="formlista">
            <input type="hidden" name="tipodml" value="<? echo $_GET['tipo'] ?>">            
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title"><?php echo $_GET['tipo'] ?><span class="badge bg-primary"></span></h5>
                <button type="button" class="btn btn-primary btn-sm" onclick="GerarPDF('<?php echo $_GET['tipo'] ?>','tabelalista')">PDF <i class="fa-regular fa-file-pdf"></i></button>
            </div>
            <hr>
            <div class="row g-1 cpcnoprint">
                <div class="col-md-9">
                    <label class="form-label">Busca</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="filtro" id="filtro" placeholder="Digite...">
                        <span class="input-group-text" id=""><i class="fa-solid fa-magnifying-glass" onclick="sqlitem($('#formlista'),'geral/listatabela','tabelalista');"></i></span>  
                    </div>

                </div>
                <div class="col-md-3">
                    <label class="form-label">Campo</label>
                    <select class="form-select cpcnoupdate" name="campobusca" id="campobusca" required value="">
                        <?php
                        $sql = "SELECT NOMECAMPO, NOMEDESCRICAO FROM PROGRAMASTIPO_CAMPO WHERE PROGRAMA ='".$_GET['tipo']."' AND BUSCAR = 'S' ORDER BY ORDEM";
                        foreach ($fatura->query($sql) as $rowconsulta) {                      
                        ?>
                        <option value="<?php echo $rowconsulta['NOMECAMPO']?>"><?php echo $rowconsulta['NOMEDESCRICAO']?></option>                    
                        <? }?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="tabelalista">
        <div class="title text-center"><h5>Listagem de <?php echo $_GET['tipo'] ?></h5></div>
        <hr>
        <?php include "listatabela.php"?>
    </div>
</div> 