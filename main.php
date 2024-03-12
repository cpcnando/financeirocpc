<? 
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
$_SESSION['COMANDO'] = $_GET['tela'];
include "sgbd/fatura.php";
if (
    ($_GET['tela'] === "Assistencia") ||
    ($_GET['tela'] === "Enfermagem") ||
    ($_GET['tela'] === "Escalas") ||
    ($_GET['tela'] === "Consulta") ||
    ($_GET['tela'] === "Operacional")
   )
 {
     $_SESSION['ATALHO'] = $_GET['tela'];
     include "botoes.php";
}
elseif (!isset($_SESSION['CODIGOPAC']) && ($_SESSION['COMANDO'] === 'ALTA'))
include "acessonegado.php";
elseif (str_starts_with($_SESSION['COMANDO'],'EVOLUCAO'))
{
  $_SESSION['TIPOEVOL'] = substr($_SESSION['COMANDO'],8,1);
  include "alta.php";
}
elseif ($_SESSION['COMANDO'] === 'ALTA')
{
  $_SESSION['TIPOEVOL'] = 'U';
  include "alta.php";
}
elseif (($_SESSION['COMANDO'] === 'APACHE') ||
($_SESSION['COMANDO'] === 'ASA') ||
($_SESSION['COMANDO'] === 'BALTHAZAR') ||
($_SESSION['COMANDO'] === 'BRADEN') ||
($_SESSION['COMANDO'] === 'BRADENQ') ||
($_SESSION['COMANDO'] === 'FISHER') ||
($_SESSION['COMANDO'] === 'FLEBITE') ||
($_SESSION['COMANDO'] === 'GLASGOW') ||
($_SESSION['COMANDO'] === 'ACOLHIMENTO') ||
($_SESSION['COMANDO'] === 'HH') ||
($_SESSION['COMANDO'] === 'KPS') ||
($_SESSION['COMANDO'] === 'MEWS') ||
($_SESSION['COMANDO'] === 'MORSE') ||
($_SESSION['COMANDO'] === 'RASS') ||
($_SESSION['COMANDO'] === 'SOFA') ||
($_SESSION['COMANDO'] === 'TISS')
)
{
  if ($_SESSION['COMANDO'] === 'BRADENQ') 
    include "escala/BRADEN.php";
  else
  include "escala/".$_GET['tela'].".php";
}
else if (strpos($_GET['tela'],'php'))
  include $_GET['tela'];
else
  include $_GET['tela'].".php";
?>