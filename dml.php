<?
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
include "sgbd/fatura.php";
$mensagem= "<span class='close'>&times;</span><div class='bg-cpc-verdeclaro h3'>Registro inserido com sucesso.</div>";
//*********************************************Tabela escalaglasgow***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalaglasgow"))
{
  $dml = "update or insert into escalaglasgow (ocular,verbal,motora,pupila,codigocps,data) values (?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['ocular'], $_POST['verbal'], $_POST['motora'], $_POST['pupila'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaglasgow***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cpslaudo2"))
{
  $dml = "update or insert into cpslaudo2 (indice, statusexame, situacaoexame, laudopadrao, laudo) values (?, ?, ?, ?, ?) matching (indice)";
  $data = array($_POST['indice'], $_POST['statusexame'], $_POST['situacaoexame'], $_POST['laudopadrao'], $_POST['laudo']);  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalabraden***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalabraden"))
{
  $dml = "update or insert into escalabraden (percepcao, humildade, atividade, mobilidade, nutricao, friccao, oxigenacao,codigocps,data) values (?, ?, ?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['percepcao'], $_POST['humildade'], $_POST['atividade'], $_POST['mobilidade'], $_POST['nutricao'], $_POST['friccao'], $_POST['oxigenacao'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaapache***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalaapache"))
{
  $dml = "update or insert into escalaapache (temperatura,pressao,fc,fr,oxigenio,ph,na,k,crea,hema,leuco,glasgow,idade,cronica,codigocps,data) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['temperatura'], $_POST['pressao'], $_POST['fc'], $_POST['fr'], $_POST['oxigenio'], $_POST['ph'], $_POST['na'], $_POST['k'], $_POST['crea'], $_POST['hema'], $_POST['leuco'], $_POST['glasgow'], $_POST['idade'], $_POST['cronica'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalamorse***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalamorse"))
{
  $dml = "update or insert into escalamorse (QUEDA, DIAGNOSTICO, CAMINHAR, INTRAVENOSA, POSTURA, MENTAL,codigocps,data) values (?, ?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['queda'], $_POST['diagnostico'], $_POST['caminhar'], $_POST['intravenosa'], $_POST['postura'], $_POST['mental'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalasofa***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalasofa"))
{
  $dml = "update or insert into escalasofa (sng,resp,gastro,cardio,plaqueta,renal,codigocps,data) values (?, ?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['sng'], $_POST['resp'], $_POST['gastro'], $_POST['cardio'], $_POST['plaqueta'], $_POST['renal'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalatiss***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalatiss"))
{
  
  $dml = "update or insert into uti_tiss28 (monitorizacao_basica, laboratorio, medicacao_unica, medicacao_intravenosa, cuidados_rotina, cuidados_frequentes, dreno, pic, ventilacao_mecanica,  suporte_ventilatorio, cuidados_vias_aereas, fisio_aspiracao, dva, dva_multiplas,  volemica, pam, swan_gans, cvc, pcr, dialise, diurese, diuretico, alcalose,  nutricao, enteral, intervencao_simples, intervencao_multipla, cirurgia, codigocps,data) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['monitorizacao_basica'], $_POST['laboratorio'], $_POST['medicacao_unica'], $_POST['medicacao_intravenosa'], $_POST['cuidados_rotina'], $_POST['cuidados_frequentes'], $_POST['dreno'], $_POST['pic'], $_POST['ventilacao_mecanica'], $_POST['suporte_ventilatorio'], $_POST['cuidados_vias_aereas'], $_POST['fisio_aspiracao'], $_POST['dva'], $_POST['dva_multiplas'], $_POST['volemica'], $_POST['pam'], $_POST['swan_gans'], $_POST['cvc'], $_POST['pcr'], $_POST['dialise'], $_POST['diurese'], $_POST['diuretico'], $_POST['alcalose'], $_POST['nutricao'], $_POST['enteral'], $_POST['intervencao_simples'], $_POST['intervencao_multipla'], $_POST['cirurgia'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalamews***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalamews"))
{
  $dml = "update or insert into escalamews (fr, pas, fc, temp, snc, codigocps,data) values (?, ?, ?, ?, ?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['fr'], $_POST['pas'], $_POST['fc'], $_POST['temp'], $_POST['snc'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalarass***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalarass"))
{
  $dml = "update or insert into escalarass (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaflebite***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalaflebite"))
{
  $dml = "update or insert into escalaflebite (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaHH***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalahh"))
{
  $dml = "update or insert into escalahh (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaasa***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalaasa"))
{
  $dml = "update or insert into escalaasa (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaKPS***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalakps"))
{
  $dml = "update or insert into escalakps (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalaFISHER***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalafisher"))
{
  $dml = "update or insert into escalafisher (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalabalthazar***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "escalabalthazar"))
{
  $dml = "update or insert into escalabalthazar (valor,codigocps,data) values (?, ?, ?) matching (codigocps, data)";
  $data = array($_POST['valor'], $_SESSION['codigocps'],str_replace("/",".",$_POST['data']));  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela escalabalthazar***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cpsimpresso"))
{
  $dml = "update or insert into cpsimpresso (a_medicos, titulo, texto, codigocps, data, indice) values (?, ?, ?, ?, ?, ?) matching (codigocps, indice)";
  $data = array($_SESSION['PROF'], $_POST['titulo'], $_POST['texto'], $_SESSION['codigocps'],date("Y-m-d H:i:s"), $_POST['indice']);  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela cps6***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cps6"))
{
  $dml = "update or insert into cps6 (procedimento, observacao, qtde, codigocps6, sequencia) values (?, ?, ?, ?, ?) matching (codigocps6, sequencia)";
  $data = array($_POST['procedimento'], $_POST['observacao'], $_POST['qtde'], $_SESSION['codigocps'], $_POST['sequencia']);  
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);
}
//*********************************************Tabela altaitem***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "altaitem"))
{
  $dml = "update or insert into altaitem (inicio, fim, descricao,observacao, alta, indice) values (?, ?, ?, ?, ?, ?) matching (alta, indice)";
  $data = array(str_replace("/",".",$_POST['inicio']), str_replace("/",".",$_POST['fim']), $_POST['descricao'], $_POST['observacao'], $_SESSION['evolucaoenf'], $_POST['indice']);
  $dmlcmd = $fatura->prepare($dml);
  $dmlcmd->execute($data);  
}
//*********************************************Tabela evolucaoenf***************************************
elseif ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "evolucaoenf"))
{  
    if ($_SESSION['COMANDO'] === 'ALTA')
    {
      $dml2 = "alta";
      $dml = "update or insert into evolucaoenf (evolucao,historia_admissao, problemas,susp_diagnostica, conteudo, plano_conduta,observacao) values (?, ?, ?, ?, ?, ?, ?) matching (evolucao) returning evolucao";
      $data = array($_POST['evolucao'],$_POST['historia_admissao'],$_POST['problemas'], $_POST['susp_diagnostica'],$_POST['conteudo'],$_POST['plano_conduta'],$_POST['observacao']);
      try
      {
      $dmlcmd = $fatura->prepare($dml);
      $dmlcmd->execute($data);
      }
      catch( PDOException $Exception ) {
        $mensagem = "<div class='d-flex justify-content-between align-items-center'><span class='btn close'>&times;</span><div class='h3'>ATENÇÃO</div><span class='btn close'>&times;</span></div><p class='h3 bg-danger bg-gradient'>".$Exception->getMessage()."</po>" ;
      }
     // if (!$dmlcmd)
    }
    else
    {
      $dml = "update or insert into evolucaoenf (evolucao, conteudo, plano_conduta,observacao) values (?, ?, ?, ?) matching (evolucao) returning evolucao";
      $dml2 = "evolu";
      $data = array($_POST['evolucao'],$_POST['conteudo'],$_POST['plano_conduta'],$_POST['observacao']);  
      $dmlcmd = $fatura->prepare($dml);
      $dmlcmd->execute($data);
    }
}

if ($mensagem != "")
{
?>

<div id="content">
<?
  echo $mensagem;

?>
</div>
<? } ?>