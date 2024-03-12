<?
    include __DIR__."/../headermain.php";
    include "sgbd/financeiro.php";
    $_SESSION['ACESSO'] = 'Transferência entre Contas';
    include __DIR__."/../sgbd/acesso.php";
?>
<div id="cpc-topo" class="card container my-2 cpcnoprint">
    <div class="row card-head h4 text-center mt-1">
        <div class="col-12 d-flex justify-content-evenly">
                <span class="cpcnoprint" onclick="$('#fav_acesso').click()" tabindex="-1"><i id="acessoicone" class="<? echo $_SESSION['ACESSOICONE']; ?> me-2 <? global $favorito; if ($favorito === 'S') echo 'text-primary' ?>" style="cursor: pointer"></i><? echo $_SESSION['ACESSONOME']; ?></span>
        </div>
    </div>
</div>
<div class="cpc-chamados">
    <div class="container cpc-tabs card" id="cpc-chamado">
        <div class="card-body">                
            <form name="formtransferencia" id="formtransferencia" action="financeiro/dml.php" class="row g-3" enctype="multipart/form-data" method="post">
                <input type="hidden" id="tipodml" name="tipodml" value="transferencia">
                <input type="hidden" id="numerocpr" name="numerocpr" value="">

                <div class="card-header text-center h4">Conta Origem</div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputState" class="form-label">De</label>
                    <select class="form-select" name="conta1" id="conta1" required value="">
                    <option></option>
                    <? $sql = "SELECT CONTA INDICE, A_NOME DESCRICAO FROM CONTAS WHERE ATIVO= 'S' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="campoprioridade" class="form-label">C. Custo</label>
                    <select class="form-select" required name="depto1" id="depto1" value="">
                    <option></option>
                    <? $sql = "SELECT DEPTO INDICE, A_NOME DESCRICAO FROM DEPARTAMENTO WHERE ATIVO= 'S' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputState" class="form-label">Nat. Operação</label>
                    <select  class="form-select" required name="no1" id="no1" value="">
                    <option></option>
                    <? $sql = "SELECT CUSTOS INDICE, A_NOME DESCRICAO FROM CUSTOS WHERE ATIVO= 'S' AND TIPOCONTA = 'Nulo' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>

                <div class="card-header text-center h4">Conta Destino</div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputState" class="form-label">De</label>
                    <select class="form-select" name="conta2" id="conta2" required value="">
                    <option></option>
                    <? $sql = "SELECT CONTA INDICE, A_NOME DESCRICAO FROM CONTAS WHERE ATIVO= 'S' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="campoprioridade" class="form-label">C. Custo</label>
                    <select class="form-select" required name="depto2" id="depto2" value="">
                    <option></option>
                    <? $sql = "SELECT DEPTO INDICE, A_NOME DESCRICAO FROM DEPARTAMENTO WHERE ATIVO= 'S' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputState" class="form-label">Nat. Operação</label>
                    <select class="form-select" required name="no2" id="no2" value="">
                    <option></option>
                    <? $sql = "SELECT CUSTOS INDICE, A_NOME DESCRICAO FROM CUSTOS WHERE ATIVO= 'S' AND TIPOCONTA = 'Nulo' ORDER BY 2";
                    foreach ($financeiro->query($sql) as $rowlistaimpresso)
                    {  
                    ?>
                        <option value="<? echo $rowlistaimpresso['INDICE']; ?>"><? echo $rowlistaimpresso['DESCRICAO']; ?></option>
                    <? } ?>                            
                    </select>
                </div>
                
                <div class="card-header text-center h4">Dados</div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputAddress2" class="form-label">Data</label>
                    <input type="date" class="form-control" placeholder="" name="data" id="data" value="<? echo date('Y-m-d') ?>" maxlength="100" size="100">
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputAddress2" class="form-label">Baixa</label>
                    <input type="date" class="form-control" placeholder="" name="baixa" id="baixa" value="<? echo date('Y-m-d') ?>" maxlength="100" size="100">
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="inputAddress2" class="form-label">Valor</label>
                    <input type="number" class="form-control" placeholder="Valor da Transferência" name="valor" id="valor" value="" maxlength="100" size="100" required>
                </div>
                <div class="mb-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Histórico</label>
                    <textarea class="form-control" required rows="2" name="historico" id="historico">Transf. na data</textarea>
                </div>
                <div class="col-12 d-flex justify-content-evenly">
                <div class="col-md-6 text-center">   
                        <button onmouseup="dmlitem($('#formtransferencia'),'financeiro/dml','transfcancelar');" id="salvar" class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Salvar/Confirmar">
                            <i class="bi bi-check-all"></i> Transferir 
                        </button>
                    </div>                    
                    <div class="col-md-6 text-center">                
                        <button  onclick=" " id="transfcancelar" class="btn btn-outline-warning" type="reset" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar/Voltar">
                            <i class="bi bi-check-all"></i> Cancelar
                        </button>
                    </div>  
                </div>
            </form>
        </div>
    </div>               


</div>            

