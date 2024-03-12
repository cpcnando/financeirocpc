<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/fatura.php";
    if (isset($_POST['tipodml'])) $_GET['tipo'] = $_POST['tipodml']; 
?>
        <table id="listaanaliticoconta" class="table table-hover">
            <thead class="mb-3">
                <tr class="text-start text-muted fw-bold fs-7 gs-0">
                    <!-- listar os campos -->
                    <?php
                       
                       $sql = "SELECT NOMECAMPO, NOMEDESCRICAO FROM PROGRAMASTIPO_CAMPO WHERE PROGRAMA ='".$_GET['tipo']."' AND LISTA = 'S'";
                       foreach ($fatura->query($sql) as $rowconsulta) {                      
                    ?>
                    
                    <th ><?php echo $rowconsulta['NOMEDESCRICAO']?></th>                
                    <? }?>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                    <?php
                        $sql = "SELECT SQL_LISTA, COMANDO FROM PROGRAMASTIPO WHERE PROGRAMA = '".$_GET['tipo']."' AND TIPO =  '".$_SESSION["SISTEMA"] ."' AND ATIVO = 'S'";
                        foreach ($fatura->query($sql) as $rowconsulta) {
                        $sqlconsulta = $rowconsulta['SQL_LISTA'];
                        if (isset($_POST['tipodml'])){
                            $sqlconsulta = str_replace("where 1=1", "where ".$_POST['campobusca']." containing '".$_POST['filtro']."'", $sqlconsulta);
                        }
                        if ($sqlconsulta != '')
                        foreach ($fatura->query($sqlconsulta) as $rowdados) {
                    ?>
                <tr class="">
                        <?php
                            $sql = "SELECT NOMECAMPO FROM PROGRAMASTIPO_CAMPO WHERE PROGRAMA = '".$_GET['tipo']."' AND LISTA = 'S'";
                            $qtde = 0;
                            foreach ($fatura->query($sql) as $rowcampos) {
                        ?>
                        <td <? if ($qtde === 0) { $comando = 'onclick="'.str_replace("')",".php?indice=')",$rowconsulta['COMANDO']).'"'; 
                               $comando = str_replace("('","('".$rowdados[$rowcampos['NOMECAMPO']]."','cpcMain','",$comando);
                               echo $comando.' style="cursor:pointer"';
                                } ?>><?php echo $rowdados[$rowcampos['NOMECAMPO']]; ?></td>
                        <? $qtde++;} ?>
                    <? }?>
                <? }?>
                </tr>
            <!-- fim do for da consulta -->
            </tbody>
        </table>