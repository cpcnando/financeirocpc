<?

include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/financeiro.php";
include __DIR__."/../sgbd/almoxa.php";
foreach ($_POST as $key => $value) {
  $_POST[$key] = mb_convert_encoding($_POST[$key], 'ISO-8859-1', 'UTF-8');
}

//*********************************************Procedure transferencia***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "baixatitulo"))
{
   $sql = "SELECT * FROM baixatitulo('".$_POST['tipobaixa']."',".$_POST['conta'].",'".$_POST['data']."','".$_POST['baixa']."',null,'','".$_POST['lote']."','".$_POST['portador']."','".$_POST['historico']."',".$_SESSION['ID_CPC'].")";
   $sql = str_replace("''", "null",$sql);
   //echo $sql;
   try{
    foreach ($financeiro->query($sql) as $row)
    { 
      if ($_POST['tipobaixa'] === 'CNAB') {
        if ($_POST['lote'] === ''){
          echo "Necessario preencher um lote";
          exit;
        }
        $nomearquivo = 'CNAB_'.$_POST['lote'].'_'.$_SESSION['ID_CPC'].'.txt';
        if (file_exists('C:\\cpc\\file\\'.$nomearquivo)) 
          unlink('C:\\cpc\\file\\'.$nomearquivo);
        $conteudo = $row['DETALHE'];
        // Definir cabeçalhos para forçar o download
        $resultado = file_put_contents('C:\\cpc\\file\\'.$nomearquivo,$conteudo);
        // Limpar o buffer de saída do sistema e enviar o conteúdo
        //ob_clean();
        //flush();
        //echo $conteudo;
        if($resultado) {
          echo "Arquivo gerado com sucesso. <a target='_new' href='financeiro/cnab.php?file=".$nomearquivo."'>".$nomearquivo."</a>";
        }
        else
          echo "Erro ao criar o arquivo";
        // Finalizar o script para prevenir envio de dados adicionais
        exit;
      }
    }  
    $financeiro->commit();
      echo 'sucesso';
  }catch(PDOException $e){
      echo $e->getMessage();
  }  

}
//*********************************************Procedure baixatitulo***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "transferencia"))
{
   $sql = "SELECT texto FROM transferencia(".$_POST['conta1'].",".$_POST['depto1'].",".$_POST['no1'].",".$_POST['conta2'].",".$_POST['depto2'].",".$_POST['no2'].",'".$_POST['data']."','".$_POST['baixa']."',".$_POST['valor'].",'".$_POST['historico']."',".$_SESSION['ID_CPC'].")";
  //  echo $sql;
   try{
    foreach ($financeiro->query($sql) as $row)
    {}  
    $financeiro->commit();
      echo 'sucesso';
  }catch(PDOException $e){
      echo $e->getMessage();
  }  

}
//*********************************************Tabela movimen***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "movimen"))
{
  if ($_POST['numero'] ==='') $_POST['numero'] = '-123456';
  $dml = "update or insert into movimen (numero,conta,data1,data2,tipo,valor,portador,historico,user1) values (?, ?, ?, ?, ?, ?, ?, ?, ?) matching (numero) returning numero";
  $data = array($_POST['numero'], $_POST['conta'], $_POST['data1'], $_POST['data2'], $_POST['tipo'], $_POST['valor'], $_POST['portador'], $_POST['historico'], $_SESSION['ID_CPC']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['NUMERO'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela cpr1***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cpr1"))
{
  if ($_POST['numerocpr'] ==='') $_POST['numerocpr'] = '-123456';
  $dml = "update or insert into cpr1 (numerocpr,clifor,emissao,competencia,vencimento,referencia,tipo,tipodoc,documento,valor, historico, irrf, pis, cofins, inss, glosa, csl, desconto, iss, taxajuros, icms, piscofinscsll, user1) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) matching (numerocpr) returning numerocpr";
  $data = array($_POST['numerocpr'], $_POST['clifor'], $_POST['emissao'], $_POST['competencia'], $_POST['vencimento'], $_POST['referencia'], $_POST['tipo'], $_POST['tipodoc'], $_POST['documento'], $_POST['valor'], $_POST['historico'], $_POST['irrf'], $_POST['pis'], $_POST['cofins'], $_POST['inss'], $_POST['glosa'], $_POST['csl'], $_POST['desconto'], $_POST['iss'], $_POST['taxajuros'], $_POST['icms'], $_POST['piscofinscsll'], $_SESSION['ID_CPC']);

  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['NUMEROCPR'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela cpr2***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cpr2"))
{
  if ($_POST['numero'] ==='') $_POST['numero'] = '-123456';
  $dml = "update or insert into cpr2 (numero,numerocpr,documento,vencimento,previsao,parcela,user1,baixar) values (?, ?, ?, ?, ?, ?, ?, ?) matching (numero) returning numerocpr";
  $data = array($_POST['numero'], $_POST['numerocpr'], $_POST['documento'], $_POST['vencimento'], $_POST['previsao'], $_POST['parcela'], $_SESSION['ID_CPC'], $_POST['parcela']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['NUMEROCPR'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela movcustos***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "cpr3"))
{
  //$_POST['tipo'] = '1'; $_POST['prioridade'] = '1'; $_POST['classificacao'] = '1';  
  if ($_POST['sequencia'] ==='') $_POST['sequencia'] = '0';
  $dml = "update or insert into cpr3 (sequencia,numerocpr,indicecpr2, custos,depto,valor) values (?, ?, ?, ?, ?, ?) matching (sequencia) returning indicecpr2";
  $data = array($_POST['sequencia'], $_POST['numerocpr'], $_POST['indicecpr2'], $_POST['custos'], $_POST['depto'], $_POST['valor']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['INDICECPR2'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela contas***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] === "contas"))
{
  if ($_POST['conta'] ==='') $_POST['conta'] = '0';
  $dml = "update or insert into CONTAS (conta, a_nome, tipo, depto, contas, a_agencia,a_nome1,observacao, ativo, user1) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) matching (conta) returning conta";
  $data = array($_POST['conta'], $_POST['a_nome'], $_POST['tipo'], $_POST['depto'], $_POST['contas'], $_POST['a_agencia'], $_POST['a_nome1'], $_POST['observacao'], $_POST['ativo'], $_SESSION['ID_CPC']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['CONTA'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela movcustos***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "movcustos"))
{
  //$_POST['tipo'] = '1'; $_POST['prioridade'] = '1'; $_POST['classificacao'] = '1';  
  if ($_POST['sequencia'] ==='') $_POST['sequencia'] = '0';
  $dml = "update or insert into movcustos (sequencia,numero,custos,depto,valor,observacao) values (?, ?, ?, ?, ?, ?) matching (sequencia) returning numero";
  $data = array($_POST['sequencia'], $_POST['numero'], $_POST['custos'], $_POST['depto'], $_POST['valor'], $_POST['observacao']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['NUMERO'];;
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela custos***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "custos"))
{
  if ($_POST['custos'] ==='') $_POST['custos'] = '-123456';
  $dml = "update or insert into custos (custos,a_nome,contas,resultado,tipocusto,listar,tipoconta,contabilx,ativo) values (?, ?, ?, ?, ?, ?, ?, ?, ?) matching (custos) returning custos";
  $data = array($_POST['custos'], $_POST['a_nome'], $_POST['contas'], $_POST['resultado'], $_POST['tipocusto'], $_POST['listar'], $_POST['tipoconta'], $_POST['contabilx'], $_POST['ativo']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['CUSTOS'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela departamento***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "departamento"))
{
  if ($_POST['depto'] ==='') $_POST['depto'] = '-123456';
  $dml = "update or insert into departamento (depto,a_nome,ativo,resultado,contas,receita) values (?, ?, ?, ?, ?, ?) matching (depto) returning depto";
  $data = array($_POST['depto'], $_POST['a_nome'], $_POST['ativo'], $_POST['resultado'], $_POST['contas'], $_POST['receita']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['DEPTO'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

//*********************************************Tabela grupofornec***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "grupofornec"))
{
  if ($_POST['indice'] ==='') $_POST['indice'] = '-1';
  $dml = "update or insert into grupofornec (indice,descricao) values (?, ?) matching (indice) returning indice";
  $data = array($_POST['indice'], $_POST['descricao']);
  $dmlcmd = $almoxa->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['INDICE'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}


//*********************************************Tabela TIPOBAIXA***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "tipobaixa"))
{
  if ($_POST['tipobaixa'] ==='') $_POST['tipobaixa'] = '-1';
  $dml = "update or insert into tipobaixa (tipobaixa,descricao, tipodoc, contadebito, contacredito) values (?, ?, ?, ?, ?) matching (tipobaixa) returning tipobaixa";
  $data = array($_POST['tipobaixa'], $_POST['descricao'], $_POST['tipodoc'], $_POST['contadebito'], $_POST['contacredito']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['TIPOBAIXA'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}



//*********************************************Tabela IMPOSTOS***************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "impostos"))
{
  if ($_POST['sequencia'] ==='') $_POST['sequencia'] = '-1';
  $dml = "update or insert into impostos (sequencia, descricao, atividade, dias, tipovenc, diasema, data,acumula,incidimposto,minimorecolhido,maximorecolhido,fornecedor,contacusto,tipo,departamento) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?) matching (sequencia) returning sequencia";
  $data = array($_POST['sequencia'], $_POST['descricao'], $_POST['atividade'], $_POST['dias'], $_POST['tipovenc'], $_POST['diasema'], $_POST['data'],$_POST['acumula'], $_POST['incidimposto'], $_POST['minimorecolhido'], $_POST['maximorecolhido'], $_POST['fornecedor'],$_POST['contacusto'], $_POST['tipo'], $_POST['departamento']);
  $dmlcmd = $financeiro->prepare($dml);  
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.$row['SEQUENCIA'];
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

?>