
<?
 include "headermain.php";
 include "sgbd/fatura.php";
 include "sgbd/contabil.php";
 include "sgbd/financeiro.php";
 include "sgbd/almoxa.php";

//*********************************************Tabela cadastro***************************************
if ($_POST['tipo'] === 'cadastro'){
    $sql = "select first 50 fornecedor cod , nome desc from cadastro where nome containing '".$_POST['valor']."' order by 2";
  
    foreach ($almoxa->query($sql) as $rowlistacampo) {
  ?>
  <a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
  <? } }
  
//*********************************************Tabela cprdoc***************************************
else if ($_POST['tipo'] === 'cprdoc'){
  $sql = "select first 50 cpr1.numerocpr cod , cpr1.documento || ' - ' || extract(day from cpr1.vencimento) || '/' || extract(month from cpr1.vencimento) || '/' || extract(year from cpr1.vencimento) || ' ' || cadastro.nome desc from cpr1 left join cadastro on (cadastro.fornecedor = cpr1.clifor) where cpr1.documento containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

  
?>