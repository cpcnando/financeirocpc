<?

include "headermain.php";
if  (
    (!isset($_SESSION["ID_CPC"])) &&
    (isset($_POST['password']))
)   
{
  include "sgbd/fatura.php";
  include "sgbd/suporte.php";
  if ($_POST['sistema'] == '10')
    $sgbd = $suporte;
  else
    $sgbd = $fatura;
    if ($_POST['sistema'] === '10')
    $sql = "SELECT * FROM loginsuporte('".$_POST['username']."','".$_POST['password']."')";
    else
    $sql = "SELECT * FROM loginapp('".$_POST['username']."','".$_POST['password']."','".$_POST['sistema']."')";
    foreach ($sgbd->query($sql) as $row)
    {  
      if ((isset($row['NOME'])) && ($row['NOME'] !== ''))
      {
          $_SESSION["USUARIONOME"] = $row['NOME'];
          $_SESSION["APP"] = $_SESSION['config']['app'];
          $_SESSION["ID_CPC"]      = $row['CODIGO'];
          $_SESSION["SISTEMA"]     = $_POST['sistema'];

          $sql = "select * from sistema where sistema_ativo ='S' and sistema_indice =".$_SESSION["SISTEMA"];
          foreach ($fatura->query($sql) as $rowsistema) {
            $_SESSION["SISTEMANOME"]  = $rowsistema['SISTEMA_DESCRICAO'];
            $_SESSION["SISTEMAPASTA"] = $rowsistema['SISTEMA_PASTA'];
            $_SESSION["SISTEMATITULO"] = $rowsistema['SISTEMA_TITULO'];
            $_SESSION["SISTEMATABELAACESSO"] = $rowsistema['SISTEMA_TABELAACESSO'];
            
        
            if (($_SESSION["SISTEMA"]) == 50)  $_SESSION["STOK"] = '1';
          }


          $_SESSION["EMAIL"]     = $row['EMAIL'];
          $_SESSION["CELULAR"]     = $row['TELEFONE'];
          $_SESSION["PAGINA"]      = 'dashboard';

          if (($_POST['sistema'] != '10') && (isset($row['MEDICO'])))  //SAPI
            $_SESSION["PROF"]      = $row['MEDICO'];
          if ($_POST['sistema'] === '10') //Suporte
            $_SESSION["CLIENTE"]      = $row['CNPJ'];
      }
      else
      {
          $_SESSION["USUARIONOME"] = '';
          $_SESSION["ID_CPC"]      = '';
          $_SESSION["PAGINA"]      = 'index';
          $_SESSION["SISTEMA"]     = '';
        }    
    }
    $sgbd->commit();
}
if ((!isset($_SESSION["ID_CPC"])) ||
($_SESSION["ID_CPC"] === '')
)
{
  include "login.php";
  exit;
}

//if ((isset($_SESSION["USUARIONOME"])) && ($_SESSION["USUARIONOME"] != '')) {
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <? include "scriptheader.php" ?>
  </head>
  <body style="overflow: hidden;" onload="$(document).attr('title', '<? echo $_SESSION['SISTEMANOME']; ?> - CPC Brasil');">
  <input type="hidden" id="cpcaba">
  <div id="loader">
  </div>
  <div id="listapopupcpc" class="listasuspensacpc card shadow"></div>
  <div id="cpc-vazio" style="display:none">
  </div>
  <div id="geral">  
    <div class="cpcsoprint"><? include "cabrelatorio.php" ?></div>
    <nav class="bg-cpc-cinzaclaro cpcnoprint">
      <div class="container-fluid">         
        <!-- <div class="m-0" id="paciente"><? if ($_SESSION["SISTEMA"] =='20') include "paciente.php" ?></div>
        <? if (($_SESSION["SISTEMA"] =='20') && (!((isset($_SESSION['codigocps'])) && ($_SESSION['codigocps'] > 0)))) { ?>
        <a href="" onclick="showMain('mapa')" class="nav-link" id="pac"><div class="cpc-circulo" style="border-color: #138898;"><img class="text-center" src="img/icon-circle1.svg"></div><div class="text-center">Paciente</div></a>
        <? } ?> -->
        <div <?  if ($_SESSION["SISTEMA"] =='11432420') echo 'class="collapse navbar-collapse"'; ?> id="navbarSupportedContent">
        
          <!-- <ul class="nav nav-pills-sm flex-column-sm mb-auto cpc-botoesmain navbar-nav-scroll d-flex justify-content-evenly" style="--bs-scroll-height: 300px;"> -->
          <!-- <ul class="mb-auto cpc-botoesmain d-flex justify-content-evenly" width="100%" style="--bs-scroll-height: 300px;"> -->
          <ul class="container text-center mb-auto d-flex justify-content-evenly" width="100%" stylse="--bs-scroll-height: 300px;">
          <a href="" onclick="showMain('favorito')" class="mt-1 cpc-nomobile" style="position: fixed; left: 20px; display: flex;justify-content: space-between;"><img src="img/logo-padrao.svg" alt="Logo da CPC"></a>
          <?  if ($_SESSION["SISTEMA"] =='10' ){
              ?>
            <li class="mt-1"><a href="" data-bs-target="#navbarSupportedContent" onclick="showMain('suporte/lista','cpcMain',undefined,'#laudoview')" class="nav-link" id="spt_lista"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/listagem.svg"></div><div class="text-center">Listagem</div></a></li>
            <?if ($_SESSION['CLIENTE'] != 'MATRIX') {?>
              <li class="mt-1"><a href="suporte/dashboard.php" target="_dashboard" data-bs-target="#navbarSupportedContent" class="nav-link" id="spt_painel"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/painel.svg"></div><div class="text-center">Painel</div></a></li>            
            <?}?>
            <li class="mt-1"><a href="logout.php" target="_top"   class="nav-link"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/configuracao.svg"></div><div class="text-center">Sair</div></a></li>
            <? }  else if ($_SESSION["SISTEMA"] =='65' ){
              ?>
            <li class="mt-1"><a href="" data-bs-target="#navbarSupportedContent" onclick="showMain('pacs/estudo','cpcMain',undefined);" class="nav-link" id="spt_lista"><div class="cpc-circulo" style="border-color: #008898;"><img class="text-center" src="img/movimento.svg"></div><div class="text-center">Exames</div></a></li>
            <li class="mt-1"><a href="" data-bs-target="#navbarSupportedContent" onclick="showMain('pacs/worklist','cpcMain',undefined);" class="nav-link" id="spt_lista"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/icon-circle5.svg"></div><div class="text-center">Worklist</div></a></li>
            <li class="mt-1"><a href="#popupNested" onmouseup="showMain('pacs','listapopup','listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true" class="nav-link"><div class="cpc-circulo" style="border-color: #008898;"><img class="text-center" src="img/icon-circle7.svg"></div><div class="text-center">Info</div></a></li>            
              <? }  else if ($_SESSION["SISTEMA"] =='20' ){
              ?>
            <li class="mt-1"><a href="" onmousedown="showMain('sapi/lista_paciente');" class="nav-link"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/paciente.svg"></div><div class="text-center">Pacientes</div></a></li>
            <li class="mt-1"><a href="" onmousedown="showMain('sapi/atendimento.php');"><div class="cpc-circulo" style="border-color: #DE1F44;"><img class="text-center" src="img/icon-circle2.svg"></div><div class="text-center">Assitência</div></a></li>
            <li class="mt-1"><a href="" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="cpc-circulo" style="border-color: #1BB91F;"><img class="text-center" src="img/icon-circle3.svg"></div><div class="text-center">Enfermagem</div></a></li>
            <li class="mt-1"><a href="" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="cpc-circulo" style="border-color: #25C1FA;"><img class="text-center" src="img/icon-circle4.svg"></div><div class="text-center">Escalas</div></a></li>
            <li class="mt-1"><a href="" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="cpc-circulo" style="border-color: var(--cpc-verde-claro);"><img class="text-center" src="img/icon-circle5.svg"></div><div class="text-center">Consulta</div></a></li>
            <li class="mt-1"><a href="" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="cpc-circulo" style="border-color: #815D22;"><img class="text-center" src="img/icon-circle6.svg"></div><div class="text-center">Pacs</div></a></li>
            <li class="mt-1"><a href="#popupNested" onmouseup="showMain('info','listapopup','listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true" class="nav-link"><div class="cpc-circulo" style="border-color: #815D22;"><img class="text-center" src="img/icon-circle7.svg"></div><div class="text-center">Info</div></a></li>
            <? }  else if (1===2){ ?>
            <li class="mt-1"><a href="" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i style="color:var(--cpc-verde-claro)" class="fa-solid fa-bars fa-2xl"></i></div><div class="text-center">Menu</div></a></li>
            <li class="mt-1"><a href="#popupNested" onmouseup="showMain('favorito','listapopup','listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true" class="nav-link"><div  class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i style="color:var(--cpc-verde-claro)" class="bg-cpc-cinzaclaro fa-regular fa-star fa-2xl"></i></div><div class="text-center">Fav</div></a></li>
            <li class="mt-1"><a href="#popupNested" onmouseup="showMain('info','listapopup','listapopup_get.php?indice=');" data-rel="popup" data-transition="pop" aria-haspopup="true" aria-owns="popupNested" aria-expanded="true" class="nav-link"><div class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i  style="color:var(--cpc-verde-claro)" class="bg-cpc-cinzaclaro fa-solid fa-gear fa-2xl"></i></div><div class="text-center">Info</div></a></li>
            <? }  else { ?>
            <li class="mt-1" style="cursor: pointer"><a id="offcanvaspadrao" onmousedown="showMain('','listaoffcanvas','menusistema.php');" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCPC" aria-controls="offcanvasCPC" class="nav-link"><div class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i style="color:var(--cpc-verde-claro);" class="fa-solid fa-bars fa-2xl"></i></div><div class="text-center"><strong><u>M</u></strong>enu</div></a></li>
            <li class="mt-1" style="cursor: pointer"><a onclick="showMain('favorito','listapopupcpc','listapopup_get.php?indice=');" class="nav-link favorito"><div  class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i style="color:var(--cpc-verde-claro)" class="bg-cpc-cinzaclaro fa-regular fa-star fa-2xl"></i></div><div class="text-center"><strong><u>R</u></strong>ecente</div></a></li>
            <li class="mt-1" style="cursor: pointer"><a onclick="showMain('info','listapopupcpc','listapopup_get.php?indice=');" class="nav-link info"><div class="border border-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i  style="color:var(--cpc-verde-claro)" class="bg-cpc-cinzaclaro fa-solid fa-gear fa-2xl"></i></div><div class="text-center"><strong><u>C</u></strong>onfig</div></a></li>
            <? } ?>  
                      
          </ul>
        </div>
      </div>
    </nav> 
    <hr class="hr1 cpcnoprint">
    <main id="cpcMain">
    <? include "favorito.php" ?>
    </main>
    <div id="overlay" class="card shadow" style="display:none"><button id="closeBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Fechar" onclick="$('#overlay').hide()"><i class="fa-regular fa-circle-xmark fa-lg" style="color: #e5576d;"></i></button><div id="telapopup"></div></div>
    <section id="tab1">
    </section>
    <section id="tab2">
    </section>
    <section id="tab3">
    </section>
    <section id="tab4">
    </section>
    <? include "scriptfooter.php" ?>
    <footer>
    </footer>
            </div>
            <script>
                $(document).ready(function () {
                  <?php if ($_SESSION["SISTEMA"] =='10'){ ?>
                      $('#spt_lista').click();  
                  <?php } ?>
                }); 
                // setTimeout(() => {
                //   $('#laudoview').on('page.dt', function () {
                //   var pageInfo = $('#laudoview').DataTable().page.info();
                //   localStorage.setItem('paginaAtual', pageInfo.page);
                //   alert(paginaSalva);

                //   });

                //   var paginaSalva = localStorage.getItem('paginaAtual');
                // if (paginaSalva !== null) {
                //     $('#laudoview').DataTable().page(parseInt(paginaSalva)).draw(false);
                // }
                  
                // }, 4000);
                
              </script>
  </body>
</html>