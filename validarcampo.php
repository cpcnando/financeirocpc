<?
  include "headermain.php";
  if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
  $mensagem="";
  $campos="";
  $requerido="";
  $visivel="";
  $necessariotexto="";
  $necessariocampo="";
  $status="S";
  //Validação do campo matricula em cps1
  if ((isset($_POST['tipodml'])) && (isset($_POST['convenio'])) && ($_POST['tipodml'] === 'cps1') && ($_POST['campo'] === 'matricula') && ($_POST['convenio'] !== '') && ($_POST['matricula'] != '')){
    include "sgbd/fatura.php";
    $sql = "select first 1 tamanhomat from convenio where convenio =0".$_POST['convenio'];
    foreach ($fatura->query($sql) as $rowvalidacampo)
    {
      if (($rowvalidacampo['TAMANHOMAT'] != strlen($_POST['matricula'])) && ($rowvalidacampo['TAMANHOMAT'] != ''))
      {
        $mensagem = "A matrícula '".$_POST['matricula']."' que tem ".strlen($_POST['matricula'])." dígitos precisa ter '".$rowvalidacampo['TAMANHOMAT']."' dígitos.";
        $status = 'N';
      }
    }
  }

  //Validação do campo codigoamb em cps2
  if (($_POST['tipodml'] === 'cps2') && ($_POST['campo'] === 'codigoamb') && ($_POST['codigoamb'] !== '')){
    include "sgbd/fatura.php";
    $sql = "select first 1 * from SERVICOSCONVENIO(0".$_POST['convenio'].", 'now', ".$_POST['codigopla'].") where a_codamb = '".$_POST['codigoamb']."'";
    foreach ($fatura->query($sql) as $rowvalidacampo)
    {
      $sql = "select first 1 valor,filme,co from valoramb('".$_POST['codigoamb']."',".$_POST['convenio'].",'N','now',".$_POST['codigopla'].",0) ";
      foreach ($fatura->query($sql) as $rowvalor){
        $unitario = $rowvalor['VALOR'];
        $valor = $unitario*$_POST['quantidade'];
      }
  
      $campos = ',"campos": [ { "campo": "valor", "valor": "'.$valor.'", "sempre": "S" },{ "campo": "a_quantida", "valor": "'.$unitario.'", "sempre": "S" },{ "campo": "codigoserv", "valor": "'.$rowvalidacampo['CODIGOSERV'].'", "sempre": "S" }]';

    }
  }

  //Validação do campo matricula em cps1
  if (($_POST['tipodml'] === 'cps1') && ($_POST['campo'] === 'codigopac') && ($_POST['codigopac'] !== '')){
    include "sgbd/fatura.php";
    $sql = "select first 1 convenio,matricula from paciente where codigopac =0".$_POST['codigopac'];
    foreach ($fatura->query($sql) as $rowvalidacampo)
    {
      $campos = ',"campos": [ { "campo": "convenio", "valor": "'.$rowvalidacampo['CONVENIO'].'", "sempre": "N"},{ "campo": "matricula", "valor": "'.$rowvalidacampo['MATRICULA'].'", "sempre": "N" }]';
    }
  }

  //Validação do campo matricula em cps1
  if (($_POST['tipodml'] === 'cps1') && ($_POST['campo'] === 'medresp') && ($_POST['medresp'] !== '')){
    include "sgbd/fatura.php";
    $sql = "select max(especialidade) especialidade from defprof1 where a_medicos =".$_POST['medresp']." having count(*) = 1";
    foreach ($fatura->query($sql) as $rowvalidacampo)
    {
      $campos = ',"campos": [ { "campo": "especialidade", "valor": "'.$rowvalidacampo['ESPECIALIDADE'].'", "sempre": "S"}]';
    }
  }

?>
{
   "requerido" : "<? echo $requerido ?>",
   "necessario":{
        "texto" : "<? echo $necessariotexto ?>",
        "campo" : "<? echo $necessariocampo ?>"
    },
   "visivel" : "<? echo $visivel ?>",
    "status" : "<? echo $status ?>",
    "mensagem":{
        "texto" : "<? echo $mensagem ?>",
        "botao" : "OK",
        "tipo" : "alerta10"
    }
    <? echo $campos ?>
  }