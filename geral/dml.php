<?
include __DIR__."/../headermain.php";
foreach ($_POST as $key => $value) {
  $_POST[$key] = mb_convert_encoding($_POST[$key], 'ISO-8859-1', 'UTF-8');
}
include __DIR__."/../sgbd/almoxa.php";
include __DIR__."/../sgbd/fatura.php";
//****************************************TABELA USUARIIOS************************************
if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "usuarios"))
{ 
  
  if ($_POST['codigo'] ==='') $_POST['codigo'] = '-1';
  $dml = "update or insert into usuarios (codigo, a_nome, medico, apelido, cep, uf, cidade, bairro, endereco, celular, sexo, nascimento, funcao, matricula, a_cpf, senha, expira, horainicio, horafim, dataadmissao, email, smtp, smtpsenha) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) matching (codigo) returning codigo";
  $data = array($_POST['codigo'], $_POST['a_nome'], $_POST['medico'], $_POST['apelido'], $_POST['cep'], $_POST['uf'], $_POST['cidade'], $_POST['bairro'], $_POST['endereco'], $_POST['celular'], $_POST['sexo'], $_POST['nascimento'], $_POST['funcao'], $_POST['matricula'], $_POST['a_cpf'], $_POST['senha'], $_POST['expira'], '31.01.1999 '.str_replace('T',' ',$_POST['horainicio']), '31.01.1999 '.str_replace('T',' ',$_POST['horafim']), $_POST['dataadmissao'], $_POST['email'], $_POST['smtp'], $_POST['smtpsenha']);
  $dmlcmd = $fatura->prepare($dml);    
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.number_format($row['CODIGO'], 0,'','');
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}

if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "paciente"))
{
  
  if ($_POST['codigopac'] ==='') $_POST['codigopac'] = '-1';
  $dml = "update or insert into paciente (codigopac,a_nome,segurado,convenio,cep,uf,cidade,bairro,endereco,celular,sexo,nasc,matricula,a_cpf,email, telefone, cod_logradouro, numero, complemento, telefone3, identidade, rgorgao, dataexpedicao, rguf, certidaonasc, pai, mae, nacionalidade, naturalidade, uf_nasc, civil, escolaridade, trabalho, cor, etnia, ativo, cartao, gaveta, gaveta1, codigo, a_codigo1) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,1,1, ?, ?) matching (codigopac) returning codigopac";
  $data = array($_POST['codigopac'], $_POST['a_nome'],$_POST['segurado'], $_POST['convenio'], $_POST['cep'], $_POST['uf'], $_POST['cidade'], $_POST['bairro'], $_POST['endereco'], $_POST['celular'], $_POST['sexo'], $_POST['nasc'], $_POST['matricula'], $_POST['a_cpf'], $_POST['email'], $_POST['telefone'], $_POST['cod_logradouro'], $_POST['numero'], $_POST['complemento'], $_POST['telefone3'], $_POST['identidade'], $_POST['rgorgao'], $_POST['dataexpedicao'], $_POST['rguf'], $_POST['certidaonasc'], $_POST['pai'], $_POST['mae'], $_POST['nacionalidade'], $_POST['naturalidade'], $_POST['uf_nasc'], $_POST['civil'], $_POST['escolaridade'], $_POST['trabalho'], $_POST['cor'], $_POST['etnia'], $_POST['ativo'], $_POST['cartao'], $_SESSION['ID_CPC'], $_SESSION['ID_CPC']);
  $dmlcmd = $fatura->prepare($dml);    
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.number_format($row['CODIGOPAC'], 0,'','');
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}


if ((isset($_POST['tipodml'])) && ($_POST['tipodml'] == "empresas"))
{
  
  if ($_POST['codigo'] ==='') $_POST['codigo'] = '-1';
  $dml = "update or insert into empresas (codigo,razaosocial,cnpj,telefone,cep,uf,cidade,bairro,endereco) values (?,?,?,?,?,?,?,?,?) matching (codigo) returning codigo";
  $data = array($_POST['codigo'], $_POST['razaosocial'],$_POST['cnpj'], $_POST['telefone'], $_POST['cep'], $_POST['uf'], $_POST['cidade'], $_POST['bairro'], $_POST['endereco']);
  $dmlcmd = $fatura->prepare($dml);    
  try{
    $dmlcmd->execute($data);  
    $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
      echo 'sucesso'.number_format($row['CODIGO'], 0,'','');
  }catch(PDOException $e){
      echo $e->getMessage();
  }  
  $row = $dmlcmd->fetch(PDO::FETCH_ASSOC);
}


