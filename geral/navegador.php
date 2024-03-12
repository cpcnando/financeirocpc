<?
// $_POST['sgbd'] = 'financeiro';
// $_POST['nomecampo'] = 'numerocpr';
// $_POST['tabela'] = 'cpr1';
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/".$_POST['sgbd'].".php";
include __DIR__."/../funcoes.php";
if ($_POST['sgbd'] === 'suporte')    $sgbd = $suporte;
if ($_POST['sgbd'] === 'folha')    $sgbd = $folha;
if ($_POST['sgbd'] === 'fatura')     $sgbd = $fatura;
if ($_POST['sgbd'] === 'contabil')     $sgbd = $contabil;
if ($_POST['sgbd'] === 'almoxa')     $sgbd = $almoxa;
if ($_POST['sgbd'] === 'pacs')       $sgbd = $pacs;
if ($_POST['sgbd'] === 'financeiro') $sgbd = $financeiro;
if ($_POST['sgbd'] === 'imagens') $sgbd = $imagens;

if ($_POST['tipo']=== 'F')
    $pk = executasqlcampo("select first 1 ".$_POST['nomecampo']." from ".$_POST['tabela']." order by ".$_POST['nomecampo']." asc",$sgbd);
else if ($_POST['tipo']=== 'L')
    $pk = executasqlcampo("select first 1 ".$_POST['nomecampo']." from ".$_POST['tabela']." order by ".$_POST['nomecampo']." desc",$sgbd);
else if ($_POST['tipo']=== 'P')
    $pk = executasqlcampo("select first 1 ".$_POST['nomecampo']." from ".$_POST['tabela']." where ".$_POST['nomecampo']." < ".$_POST['valorcampo']." order by ".$_POST['nomecampo']." desc",$sgbd);
else if ($_POST['tipo']=== 'N')
    $pk = executasqlcampo("select first 1 ".$_POST['nomecampo']." from ".$_POST['tabela']." where ".$_POST['nomecampo']." > ".$_POST['valorcampo']." order by ".$_POST['nomecampo']." asc",$sgbd);

echo "sucesso".$pk;
?>
