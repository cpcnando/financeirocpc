<?
  if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
  include __DIR__."/headermain.php";
  include __DIR__."/sgbd/fatura.php";
  include __DIR__."/sgbd/almoxa.php";
  include __DIR__."/sgbd/financeiro.php";
  include __DIR__."/sgbd/contabil.php";
  include __DIR__."/sgbd/folha.php";
  include __DIR__."/sgbd/imagens.php";
  include __DIR__."/sgbd/suporte.php";

  function executasqlcampo($sql,$sgbd){
    foreach ($sgbd->query($sql) as $rowsqlexec){return $rowsqlexec[0];}
  }

  function buscaconfigusuario($parametro)
  {
    global $fatura;
    $sql = "SELECT VALOR FROM USUARIOCONFIG WHERE SISTEMA = upper('".$_SESSION['SISTEMATITULO']."') AND PARAMETRO = '".$parametro."' AND USUARIO = '".$_SESSION['ID_CPC']."' AND (VALOR IS NOT NULL)";
    foreach ($fatura->query($sql) as $rowsqlexec){ return $rowsqlexec[0]; }
  }


  function formatarValor($valor, $mascara) {
    if ($mascara === '0') {
        return number_format($valor, 0, ',', '.');
    } else if ($mascara === '0.00') {
        return number_format($valor, 2, ',', '.');
    } else if ($mascara === '0.000') {
        return number_format($valor, 3, ',', '.');
    } else if ($mascara === '0.0') {
        return number_format($valor, 1, ',', '.');
    } else if ($mascara === 'hh:nn') {
      return date('H:i', strtotime($valor));
    } else if ($mascara === 'dd/mm/yy') {
      return date('d/m/y', strtotime($valor));
    } else if ($mascara === 'dd/mm/yyyy') {
        return date('d/m/Y', strtotime($valor));
    } else {
        return $valor;
    }
}

?>