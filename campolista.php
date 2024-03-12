<?
    include __DIR__."/headermain.php";
  if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
  if ((isset($_POST['tipo'])) && ($_POST['tipo'] != ""))
  {
    if ($_POST['tipo'] === 'cid') {$banco = 'fatura'; $dml = "select first 1 descr from cid where cid10 = '".$_POST['valor']."'"; };
    if ($_POST['tipo'] === 'profserv') {$banco = 'fatura'; $dml = "select first 1 a_nome from medicos where a_medicos = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'procserv') {$banco = 'fatura'; $dml = "select first 1 a_nome from SERVICOSCONVENIO(".$_POST['campoextra'].", 'now', 1) where a_codamb = '".$_POST['valor']."'"; };
    if ($_POST['tipo'] === 'especialidade') {$banco = 'fatura'; $dml = "select first 1 nome a_nome from especialidade where codesp = '".$_POST['valor']."'"; };
    if ($_POST['tipo'] === 'especialidadecps') {$banco = 'fatura'; $dml = "select first 1 especialidade.nome from defprof1 inner join especialidade on (especialidade.codesp = defprof1.especialidade and defprof1.a_medicos = ".$_POST['campoextra'].") where especialidade.codesp = '".$_POST['valor']."'"; };
    if ($_POST['tipo'] === 'paciente') {$banco =  'fatura'; $dml = "select first 1 a_nome from paciente where codigopac = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'ccustocontabil') {$banco =  'contabil'; $dml = "select first 1 nome from centrocusto where centrocusto = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'ccustofin') {$banco =  'financeiro'; $dml = "select first 1 a_nome from departamento where depto = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'grupoclifor') {$banco =  'almoxa'; $dml = "select first 1 descricao from grupofornec where indice = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'fornecedor') {$banco =  'almoxa'; $dml = "select first 1 nome from cadastro where fornecedor = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'cliente') {$banco =  'almoxa'; $dml = "select first 1 nome from cadastro where fornecedor = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'clifor') {$banco =  'almoxa'; $dml = "select first 1 nome from cadastro where fornecedor = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'natop') {$banco =  'financeiro'; $dml = "select first 1 a_nome from custos where custos = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'usuario') {$banco =  'fatura'; $dml = "select first 1 a_nome from usuarios where codigo = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'fin_conta') {$banco =  'financeiro'; $dml = "select first 1 a_nome from contas where conta = 0".$_POST['valor']; };
    if ($_POST['tipo'] === 'etq_produto') {$banco =  'almoxa'; $dml = "select first 1 a_nome from produtos where numero = 0".$_POST['valor']; };
    if ($banco == 'suporte')    include "sgbd/suporte.php";
    if ($banco == 'fatura')     include "sgbd/fatura.php";
    if ($banco == 'almoxa')     include "sgbd/almoxa.php";
    if ($banco == 'financeiro') include "sgbd/financeiro.php";
    if ($banco == 'contabil')   include "sgbd/contabil.php";
    if ($banco == 'suporte')    $sgbd = $suporte;
    if ($banco == 'fatura')     $sgbd = $fatura;
    if ($banco == 'almoxa')     $sgbd = $almoxa;
    if ($banco == 'financeiro') $sgbd = $financeiro;
    if ($banco == 'contabil')   $sgbd = $contabil;
    try{
      foreach ($sgbd->query($dml) as $row) {echo $row[0];}
      
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $sgbd->commit();
}