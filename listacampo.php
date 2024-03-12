
<?
 include "headermain.php";
 //include "sgbd/pacs.php";
 include "sgbd/fatura.php";
 include "sgbd/contabil.php";
 include "sgbd/financeiro.php";
 include "sgbd/almoxa.php";
 include "sgbd/suporte.php";
 include "sgbd/folha.php";



 if ($_POST['tipo'] === 'paciente'){
  $sql = "select first 50 cast(codigopac as integer) cod, a_nome desc,nasc from paciente where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?> | <? echo date('d/m/Y',strtotime($rowlistacampo['NASC'])) ?></a>

<? } }


else if ($_POST['tipo'] === 'cid'){
  $sql = "select first 50 cid10 cod, descr desc from cid where descr containing '".$_POST['valor']."' or cid10 containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }


else if ($_POST['tipo'] === 'substancia'){
  $sql = "select first 50 sub_codix cod, sub_desc desc from substancias where sub_desc containing '".$_POST['valor']."' order by 2";
  
  foreach ($almoxa->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }


//*********************************************Tabela substancia***************************************
else if ($_POST['tipo'] === 'substancia'){
  $sql = "select first 50 sub_codix cod , sub_desc desc from substancias where sub_desc containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela nometabela***************************************
else if ($_POST['tipo'] === 'nometabela'){
  $sql = "select first 50 indice cod , descricao desc from nometabela where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($folha->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }


//*********************************************Tabela motivoDev***************************************
else if ($_POST['tipo'] === 'motivoDev'){
  $sql = "select first 50 indice cod , nome desc from motivodevolucao where nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela grupoclifor***************************************
else if ($_POST['tipo'] === 'grupoclifor'){
  $sql = "select first 50 indice cod , descricao desc from grupofornec where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela motivoCompra***************************************
else if ($_POST['tipo'] === 'motivoCompra'){
  $sql = "select first 50 indice cod , nome desc from motivocompra where nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela medida***************************************
else if ($_POST['tipo'] === 'medida'){
  $sql = "select first 50 unidade cod , nome desc from medidas where nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela classiProd***************************************
else if ($_POST['tipo'] === 'classiProd'){
  $sql = "select first 50 classe cod , nome desc from classes where nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela ccusto***************************************
else if ($_POST['tipo'] === 'ccusto'){
  $sql = "select first 50 ccusto cod , a_nome desc from ccusto where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

    
//*********************************************Tabela departamento***************************************
else if ($_POST['tipo'] === 'departamento'){
  $sql = "select first 50 indice cod , descricao desc from departamento where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($folha->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }



else if ($_POST['tipo'] === 'profserv'){
  $sql = "select first 50 a_medicos cod , a_nome desc from medicos where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }



else if ($_POST['tipo'] === 'especialidade'){
  $sql = "select first 50 codesp cod, nome desc from especialidade where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }



else if ($_POST['tipo'] === 'especialidadecps'){
  if ($_POST['campoextra'] === '') $_POST['campoextra'] = '0';
  $sql = "select first 50 especialidade.codesp cod, especialidade.nome desc from defprof1 inner join especialidade on (especialidade.codesp = defprof1.especialidade and defprof1.a_medicos = ".$_POST['campoextra'].") where especialidade.nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }



else if ($_POST['tipo'] === 'procserv'){
  if ($_POST['campoextra'] === '') $_POST['campoextra'] = '0';
  $sql = "select first 50 a_codamb cod, a_nome desc from SERVICOSCONVENIO(".$_POST['campoextra'].", 'now', 1) where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }



else if ($_POST['tipo'] === 'paciente_pacs'){
  $sql = "select first 50 cast(pk as integer) codigopac, alphabetic_name nome from PERSON_NAME where alphabetic_name containing '".$_POST['valor']."' order by 2";
  
  foreach ($pacs->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGOPAC'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['NOME'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['NOME'] ?></a>

<? } }




else if ($_POST['tipo'] === 'ajuda_empresa'){
  $sql = "select first 50 EMPRESA_cnpj codigopac, empresa_razaosocial nome from empresa where empresa_razaosocial containing '".$_POST['valor']."' order by 2";
  
  foreach ($suporte->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGOPAC'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['NOME'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['NOME'] ?></a>

<? } }


else if ($_POST['tipo'] === 'consultorio'){
  $sql = "select first 50 cast(sala as integer) codigo, nome descricao from sala where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }



else if ($_POST['tipo'] === 'proggoverno'){
  $sql = "select first 50 cast(codigo as integer) codigo, descricao from proggoverno where descricao containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }





else if ($_POST['tipo'] === 'matcoleta'){
  $sql = "select first 50 cast(indice as integer) codigo, nome descricao from matcoleta where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'convenio'){
  $sql = "select first 50 convenio, a_nome from convenio where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CONVENIO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['A_NOME'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['A_NOME'] ?></a>

<? } }


else if ($_POST['tipo'] === 'tabelahon'){
  $sql = "select first 50 numero, descricao from tabelahon where descricao containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['NUMERO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'grupomed'){
  $sql = "select first 50 a_grupom codigo, a_nomegrupo descricao from grupomed where a_nomegrupo containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'grupotera'){
  $sql = "select first 50 a_grupoteura codigo, a_nome descricao from grupotera where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }




else if ($_POST['tipo'] === 'feriado'){
  $sql = "select first 50 a_data codigo, a_nome descricao from feriado where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo date('Y.m.d', strtotime($rowlistacampo['CODIGO'])) ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }



else if ($_POST['tipo'] === 'contabil'){
  $sql = "select first 50 codigo, nome descricao from contabil where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }



else if ($_POST['tipo'] === 'estabelecimento'){
  $sql = "select first 50 indice codigo, nome descricao from solicitante where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }




else if ($_POST['tipo'] === 'custofin'){
  $sql = "select first 50 centrocusto codigo, nome descricao from centrocusto where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($contabil->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }




else if ($_POST['tipo'] === 'medicosolicitante'){
  $sql = "select first 50 indice codigo, nome descricao from medicosolicitante where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'motivoglosa'){
  $sql = "select first 50 numero codigo, a_nome descricao from motivoglosa where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }

//*********************************************Tabela usuario***************************************
else if ($_POST['tipo'] === 'usuario'){
  $sql = "select first 50 codigo cod , a_nome desc from usuarios where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($fatura->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

else if ($_POST['tipo'] === 'depto'){
  $sql = "select first 50 depto codigo, nome descricao from depto where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'equipmed'){
  $sql = "select first 50 codigo codigo, descricao descricao from equipmed where descricao containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'modalidade'){
  $sql = "select first 50 indice codigo, nome descricao from modalidade where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'moedastab'){
  $sql = "SELECT first 50 a_codmoe codigo , a_nome descricao FROM moedastab where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['DESCRICAO'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['DESCRICAO'] ?></a>

<? } }


else if ($_POST['tipo'] === 'servicos'){
  $sql = "select first 50 codigoserv, a_nome from servicos where a_nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGOSERV'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['A_NOME'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['A_NOME'] ?></a>

<? } }

else if ($_POST['tipo'] === 'conta'){
  $sql = "select first 50 conta cod , a_nome desc from contas where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo)
  {

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }


else if ($_POST['tipo'] === 'empresa'){
  $sql = "select first 50 codigo, razaosocial from empresas where razaosocial containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['RAZAOSOCIAL'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['RAZAOSOCIAL'] ?></a>

<? } }


else if ($_POST['tipo'] === 'unidadenegocio'){
  $sql = "select first 50 codigo, nome from unidadenegocio where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($fatura->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="$('#<? echo $_POST['componente'] ?>').val('<? echo $rowlistacampo['CODIGO'] ?>'); $('#<? echo $_POST['componente'] ?>select').val('<? echo $rowlistacampo['NOME'] ?>'); $('.dropdown-menu').removeClass('show');"><? echo $rowlistacampo['NOME'] ?></a>

<? } }


//*********************************************Tabela produtos***************************************
else if ($_POST['tipo'] === 'etq_produto'){
  $sql = "select first 50 numero cod , a_nome desc from produtos where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['COD'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }



//*********************************************Tabela imposto***************************************
else if ($_POST['tipo'] === 'imposto'){
  $sql = "select first 50 sequencia cod , descricao desc from impostos where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }

//*********************************************Tabela natop***************************************
else if ($_POST['tipo'] === 'natop'){
  $sql = "select first 50 custos cod , a_nome desc from custos where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }


//*********************************************Tabela tipobaixa***************************************
else if ($_POST['tipo'] === 'tipobaixa'){
  $sql = "select first 50 tipobaixa cod , descricao desc from tipobaixa where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo)
  {

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }


else if ($_POST['tipo'] === 'grupoclifor'){
  $sql = "select first 50 indice cod , descricao desc from grupofornec where descricao containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }

//*********************************************Tabela fornecedor***************************************
else if ($_POST['tipo'] === 'fornecedor'){
  $sql = "select first 50 fornecedor cod , nome desc from cadastro where nome containing '".$_POST['valor']."' order by 2";

  foreach ($almoxa->query($sql) as $rowlistacampo) {
?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>
<? } }


else if ($_POST['tipo'] === 'ccustofin'){
  $sql = "select first 50 depto cod , a_nome desc from departamento where a_nome containing '".$_POST['valor']."' order by 2";

  foreach ($financeiro->query($sql) as $rowlistacampo)
  {

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['DESC'] ?></a>

<? } }




else if ($_POST['tipo'] === 'planocontas'){
  $sql = "select first 50 codigocontabil cod, nome as desc, contas from planocontas where nome containing '".$_POST['valor']."' order by 2";
  
  foreach ($contabil->query($sql) as $rowlistacampo)
  {  

?>
<a href class="dropdown-item" onclick="buscaCampoItem('<? echo $_POST['componente'] ?>','<? echo $rowlistacampo['COD'] ?>','<? echo $rowlistacampo['DESC'] ?>')"><? echo $rowlistacampo['CONTAS']." - ".$rowlistacampo['DESC'] ?></a>
<? } } 

//include "estoque/listacampo.php";
 include $_SESSION['SISTEMAPASTA']."/listacampo.php";
?>