<?
    include __DIR__."/../headermain.php";
    if (isset($_GET['filtro'])) $_SESSION['filtro'] = $_GET['filtro'];
    include __DIR__."/../sgbd/fatura.php";
?>


<div class="cpc-pacslistagem"> 
    <div class="card card-body mt-1">
        <div id="meu-card" class="container-fluid">
            <table id="laudoview" class="display table align-middle table-row-dashed fs-6 gy-5 table-striped table-hover " >
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 gs-0">
                        <th class="min-w-125px">Ord</th>
                        <th class="min-w-125px">Atalho</th>
                        <th class="min-w-125px">Descrição</th>                 
                    </tr>
                </thead>
                <tbody class="text-gray-600 ">
                    <?                      
                           $sql = "SELECT * FROM ATALHOS_WEB";
                           foreach ($fatura->query($sql) as $rowatalho) 
                        {
                    ?>
                    <tr>
                        <td class="text-datatables"><? echo $rowatalho['INDICE'] ?></td>            
                        <td class="text-datatables"><? echo $rowatalho['ATALHO'] ?></td>            
                        <td class="text-datatables"><? echo $rowatalho['DESCRICAO'] ?></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>                          
        </div>                                                       
    </div>
</div>

                    