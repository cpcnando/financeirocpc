  <?
    include "sgbd/fatura.php";
    if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
    if (isset($_GET['codigocps']))
      $_SESSION['codigocps'] = $_GET['codigocps'];
      if (isset($_GET['leito']))
      $_SESSION['leito'] = $_GET['leito'];
    if (isset($_SESSION['codigocps']))
    $sql = "select first 1 paciente.a_nome nome, Paciente.nasc, Paciente.sexo, OcupLeitosap.codleito leito, OcupLeitosap.leito leitonome, Leitos.ANDAR, CAST(OcupLeitosap.codigocps AS integer) codigocps, CAST(OcupLeitosap.CODIGOPAC as integer) codigopac, OcupLeitosap.codconvenio, convenio.a_nome convenio, OcupLeitosap.data a_datafat, Medicos.A_Nome Medico, cps1.a_tipo, Ocupleitosap.mensagem01, Ocupleitosap.mensagem02, Ocupleitosap.mensagem03, Ocupleitosap.imagem01, Ocupleitosap.imagem02, Ocupleitosap.imagem03, Ocupleitosap.imagem04, Ocupleitosap.imagem05, Ocupleitosap.imagem06, Ocupleitosap.imagem07, Ocupleitosap.imagem08, Ocupleitosap.imagem09, Ocupleitosap.imagem10, Ocupleitosap.imagem11, Ocupleitosap.imagem12, Ocupleitosap.imagem13, Ocupleitosap.imagem14, Ocupleitosap.imagem15, Ocupleitosap.imagem16, Ocupleitosap.imagem17, Ocupleitosap.imagem18, cps1.codigopla,  cps1.a_hora ".
            "FROM OcupLeitosap( 'today', 'S' ) ".
            "left join leitos on ( leitos.leito = ocupleitosap.codleito ) left join cps1 on (cps1.codigocps = ocupleitosap.codigocps) ".
            "LEFT JOIN convenio ON ( convenio.convenio = ocupleitosap.codconvenio  ) ".
            "left join medicos on (Medicos.A_MEDICOS = OcupLeitosap.CodMedico) left join paciente on (paciente.codigopac = ocupleitosap.codigopac) ".
            "where ocupleitosap.codigocps =0".$_SESSION['codigocps'].
            " and codleito =0".$_SESSION['leito'].
            "ORDER BY 5, cps1.a_datafat, cps1.a_hora ASC nulls last";
    if (isset($_SESSION['codigocps']))
    foreach ($fatura->query($sql) as $rowleitos)
    if ($rowleitos['CODIGOCPS'] > 0)
    { 
      $_SESSION['CODIGOCPS'] = $_SESSION['codigocps'];
      $_SESSION['CODIGOPAC'] = $rowleitos['CODIGOPAC'];
  ?>

    <div class="cpc-leito-pac text-center">
      <div class="bg-cpc-cinzaclaro" style="grid-column: span 4; font-weight: bold;"><? echo $rowleitos['LEITONOME']; ?></div>
      <div class="bg-cpc-cinzaclaro" style="grid-column: span 4; font-weight: bold;">CPS <? echo $rowleitos['CODIGOCPS']; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-column: span 8; font-weight: bold;"><? echo $rowleitos['NOME']; ?>&nbsp;</div>
      <div class="bg-cpc-cinzaclaro" style="grid-column: span 4;">Nasc <? if ($rowleitos['A_DATAFAT']) echo date('d/m/y', strtotime($rowleitos['A_DATAFAT'])); ?></div>
      <div class="bg-cpc-cinzaclaro" style="grid-column: span 4;">Adm <? if ($rowleitos['A_DATAFAT']) echo date('d/m/y', strtotime($rowleitos['A_DATAFAT'])); ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM01']) echo '<img height=16px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM01'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM02']) echo '<img height=16px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM02'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro cpc-hint" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM03']) echo '<img height=16px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM03'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro cpc-hint" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM04']) echo '<img height=16px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM04'] ).'"/>'; else echo "&nbsp;"; ?><span class="cpc-hinttext">Escala de Covid</span></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM05']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM05'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM06']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM06'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM07']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM07'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM08']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM08'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM09']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM09'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM10']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM10'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM11']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM11'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM12']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM12'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM13']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM13'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM14']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM14'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM15']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM15'] ).'"/>'; else echo "&nbsp;"; ?></div>
      <div class="bg-cpc-cinzaescuro" style="grid-row: span 2; height:16px; "><? if ($rowleitos['IMAGEM16']) echo '<img height=14px width=16px src="data:image/bmp;base64,'.base64_encode( $rowleitos['IMAGEM16'] ).'"/>'; else echo "&nbsp;"; ?></div>
    </div>
  <? }
    if (!isset($_SESSION['codigocps']))
      
        echo '<a href="#" class="nav-brand"><img src="img/logo-padrao.svg"></a>';
  ?>
  
  
