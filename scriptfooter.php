<!-- Scripts CPC -->

<script type="text/javascript" src="assets/js/cpc.js"></script>
<!-- <script type="text/javascript" src="assets/jquery/jquery-1.11.3.min.js"></script> -->
<script type="text/javascript" src="assets/jquery/jquery-3.7.1.min.js"></script>
<!-- <script type="text/javascript" src="assets/biblioteca/jquery-1.12.4.min.js"></script>  -->

<script type="text/javascript" src="assets/bootstrap/js5/bootstrap.bundle.min.js"></script>
<!-- <script type="text/javascript" src="assets/bootstrap/js5/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="assets/jquery.mobile/jquery.mobile-1.4.5.min.js"></script> -->

<!-- <script type="text/javascript" src="assets/DataTables/dataTables.min.js"></script>
<script type="text/javascript" src="assets/DataTables/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="assets/DataTables/Buttons-2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="assets/DataTables/Buttons-2.4.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="assets/DataTables/JSZip-3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="assets/DataTables/pdfmake-0.2.7/pdfmake.min.js"></script>
<script type="text/javascript" src="assets/DataTables/pdfmake-0.2.7/vfs_fonts.js"></script> -->

<script type="text/javascript" src="assets/js/html2pdf.bundle.js"></script>

<script type="text/javascript" src="assets/jquery.inputmask.min.js" charset="iso-8859-1"></script>
<script>


  function filtraTabela (valorbusca,tabelaid,campo) {
    var valor = valorbusca.toLowerCase();
    $("#"+tabelaid+" tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1)
    });
  }


  //Adicionar eevntos de impressão
  window.addEventListener("beforeprint", antesDeImprimir);
  window.addEventListener("afterprint", depoisDeImprimir);

  function antesDeImprimir() {
    $('.tabelareport').attr('data-style',$('.tabelareport').attr('style'));
    $('.tabelareport').attr('style','width:100% !important');
    ajustaAltura('S');
    // Coloque aqui o código que você quer executar antes da impressão
  }

  function depoisDeImprimir() {
    $('.tabelareport').attr('style',$('.tabelareport').attr('data-style'));
    ajustaAltura('N');
    // Coloque aqui o código que você quer executar depois da impressão
  }

  document.addEventListener('keydown', function(event) {
     //console.log('Código da tecla:', event.which);
    if (event.altKey && (event.key.toLowerCase() === 'i'))  $(".incluir:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'e'))  $(".editar:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 's'))  $(".salvar:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'b'))  $(".pesquisar:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'c'))  $(".info:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'r'))  $(".favorito:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'm'))  {$('#offcanvaspadrao').mousedown(); $("#offcanvasCPC").offcanvas('show')}
    else if (event.altKey && (event.key.toLowerCase() === 'l'))  $("#sair").click();
    else if (event.altKey && (event.which === 38))  $(".navfirst:visible").first().click();
    else if (event.altKey && (event.which === 37))  $(".navprior:visible").first().click();
    else if (event.altKey && (event.which === 39))  $(".navnext:visible").first().click();
    else if (event.altKey && (event.which === 40))  $(".navlast:visible").first().click();
    else if (event.altKey && (event.key.toLowerCase() === 'a'))  {$(".select-cpc-abas").attr('size','3'); $(".select-cpc-abas").first().focus();}
    else if ((event.which === 40) && (!$('#listapopupcpc:visible a').is(':focus'))) { console.log('foco frist'); $('#listapopupcpc:visible a:first').focus();}
  });

  $('#listapopupcpc').keydown(function(e) {
    var $current = $(this).find('a:focus'),
        $next, $prev;

    // Seta para baixo pressionada
    if (e.which === 40) {
        if ($current.length === 0) {
            $next = $(this).find('a').first();
        } else {
            $next = $current.next('a');
        }
        if ($next.length) {
            $current.blur();
            $next.focus();
        }
        e.preventDefault(); // Evita rolagem da página
    }

    // Seta para cima pressionada
    else if (e.which === 38) {
        if ($current.length === 0) {
            $prev = $(this).find('a').last();
        } else {
            $prev = $current.prev('a');
        }
        if ($prev.length) {
            $current.blur();
            $prev.focus();
        }
        e.preventDefault(); // Evita rolagem da página
    }
  });

  $(window).click(function(event) {
      if (!$(event.target).closest('.listasuspensacpc').length) 
      {
        $('.listasuspensacpc').text('');
        $('.listasuspensacpc').hide();
      }
  });



let mouseX = 0;
let mouseY = 0;

document.addEventListener('mousemove', function(e) {
    mouseX = e.pageX;
    mouseY = e.pageY;
});

function mensagemdeerro(texto){
  if ((texto.indexOf('Undefined array key "ID_CPC"') >= 0) ||
    (texto.indexOf('Undefined array key "USUARIONOME"') >= 0)){
      window.location.href = 'login.php';
      exit();
    }

  // Mensagem de erro de exception do banco de dados
  var parteEspecifica = "SQLSTATE[HY000]: General error: -836 exception";
  if (texto.indexOf(parteEspecifica) >= 0) {
  inicio = texto.indexOf(parteEspecifica);
  inicio += parteEspecifica.length + 1;
  texto = texto.substring(inicio,texto.length);
  //Buscar Primeiro Espaço
  if (texto.indexOf(" ") >= 0) {
    inicio = texto.indexOf(" ");
  texto = texto.substring(inicio+1,texto.length);
  }
  //Buscar Segundo Espaço
  if (texto.indexOf(" ") >= 0) {
    inicio = texto.indexOf(" ");
  texto = texto.substring(inicio+1,texto.length);
  }
  //Determinar final da string
  if (texto.indexOf(" At ") >= 0) {
    final = texto.indexOf(" At ");
  texto = texto.substring(0,final);
  }
  }
  //Mensagem de erro direto do banco de dados. TRADUZIR
  if (texto.indexOf("PDOException") >= 0) {
    if (texto.indexOf("[335544721]") >= 0)      texto = "O sistema nao conseguiu conectar ao servidor. Aguarde alguns segundos e tente novamente... Se o erro persistir procure apoio técnico";
    else if (texto.indexOf("[35544653]") >= 0) texto = "O sistema não consegiu ler o Banco de Dados.Possivelmente ele está corrompido. Se o erro persistir procure apoio técnico";
    else if (texto.indexOf("[335544744]") >= 0) texto = "Limite máximo de usuários execedido do Banco de Dados. Se o erro persistir procure apoio técnico";
    else if (texto.indexOf("[335544336]") >= 0) texto = "Outro usuário ou processo está tentando alterar o mesmo registro. Precisa aguardar até a outra tarefa ser concluída";
    else if (texto.indexOf("[336331022]") >= 0) texto = "Erro critíco. Servidor sem espaço em disco. Procure apoio técnico";
    else "Erro nao controlado. Favor anotar o codigo do erro e procurar apoio técnico";
  }
  return texto;
}

//Funcao para mostrar caixas de dialogo
function messagedlg(texto,botao,tipo)
{
  texto = mensagemdeerro(texto);
  tempo = 0;
  if (tipo !== undefined){
    if (tipo.indexOf('10') >= 0) tempo = 10;
    else if (tipo.indexOf('1') >= 0) tempo = 1;
    else if (tipo.indexOf('2') >= 0) tempo = 2;
    else if (tipo.indexOf('3') >= 0) tempo = 3;
    else if (tipo.indexOf('4') >= 0) tempo = 4;
    else if (tipo.indexOf('5') >= 0) tempo = 5;
  }
  if (tempo > 0 ){


    $('#liveToast').removeClass('bg-success');
    $('#liveToast').removeClass('bg-danger');
    $('#liveToast').removeClass('bg-warning');
    if (tipo.indexOf('alert') >= 0) 
    $('#liveToast').addClass('bg-danger');    
    else if (tipo.indexOf('aviso') >= 0) 
    $('#liveToast').addClass('bg-warning');    
    else $('#liveToast').addClass('bg-success');    
    mostrarToast(texto,tempo);
  }
  else {
    

    
  $('.myModalBotao').hide();
  $('#messagedialog').removeClass();
  $('#mensagemtitulo').html('Mensagem');
  $("#myModalCancelar").off("click");
  $("#myModalFechar").off("click");
  $("#myModalOK").off("click");
  $("#myModalOK").attr("data-bs-dismiss","modal");
  // $("#popupNested").popup("close");
  if (tipo === undefined) tipo = 'aviso';
  if (botao === undefined) botao = 'ok';
  if (tipo.indexOf('info') >= 0) {$('#messagedialog').addClass('fa-regular fa-circle-check');}
  if (tipo.indexOf('erro') >= 0) $('#messagedialog').addClass('fa-solid fa-xmark');
  if (tipo.indexOf('aviso') >= 0) $('#messagedialog').addClass('fa-solid fa-exclamation');
  if (tipo.indexOf('alerta') >= 0) $('#messagedialog').addClass('fa-solid fa-exclamation');
  if (tipo.indexOf('inputpassword') >= 0) $('#messagedialog').addClass('fa-solid fa-lock');
  if (tipo.indexOf('input_') >= 0) { texto += '<input type="text" class="form-control" name="inputcampo" id="inputcampo" value="" autocomplete="off" compcodigo="inputcampo" maxlength="100" style="text-align:right;" size="100" required onkeyup="buscaCampo(event,$(this),\'' + tipo.substring(6) + '\')">';

  }
  if (tipo === 'inputnumber') texto += '<input type="number" class="form-control" name="inputcampo" id="inputcampo" value="" autocomplete="off"  maxlength="100" style="text-align:right;" size="100" required onkeyup="if (event.keyCode == 13) $(\'#myModalOK\').click();">';
  else if (tipo === 'inputpassword') texto += '<input type="password" class="form-control" name="inputcampo" id="inputcampo" autocomplete="off" value="" maxlength="100" style="text-align:right;" size="100" required onkeyup="if (event.keyCode == 13) $(\'#myModalOK\').click();">';
  else if (tipo === 'inputdate') texto += '<input type="date" class="form-control" name="inputcampo" id="inputcampo" autocomplete="off" value="" maxlength="100" style="text-align:right;" size="100" required onkeyup="if (event.keyCode == 13) $(\'#myModalOK\').click();">';
  else if (tipo === 'input') texto += '<input type="text" class="form-control" name="inputcampo" id="inputcampo" autocomplete="off" value="" maxlength="100" style="text-align:right;" size="100" required onkeyup="if (event.keyCode == 13) $(\'#myModalOK\').click();">';
  else if (tipo === 'cfm') {
    texto += '<div class="row g-1 mt-3"><div class="col-6"><label class="form-label">UF</label><select class="form-select" name="ufcfm" id="ufcfm" value="BA">'+
             '<option></option><? $_SESSION['listagem'] = 'json_uf'; include __DIR__."\listagem.php" ?></select></div>'+
             '<div class="col-6"><label class="form-label">N° Conselho</label><input type="text" class="form-control" name="crmcfm" id="crmcfm" autocomplete="off" value="" maxlength="100" style="text-align:right;" size="100" required onkeyup="if (event.keyCode == 13) $(\'#myModalOK\').click();" onblur="cfmConsulta('+botao+',$(\'#ufcfm\').val(),$(\'#crmcfm\').val())"></div>'+
             '<div class="col-6"><label class="form-label">CPF</label><input type="text" class="form-control" name="cpfcfm" id="cpfcfm"  maxlength="11" onblur="validarCPF($(this));"></div>'+
             '<div class="col-6"><label class="form-label">Nascimento</label><input type="date" class="form-control" name="nasccfm" id="nasccfm" onblur="cfmConsulta('+botao+',$(\'#ufcfm\').val(),$(\'#crmcfm\').val(),$(\'#cpfcfm\').val(),$(\'#nasccfm\').val())"></div>';
  }
  
  if (tipo === 'inputpassword') {
    $("#myModalOK").attr("data-bs-dismiss","");
    $('#mensagemtitulo').html('Tela de Bloqueio');
    $("#myModalCancelar").click(function(){
            window.location.href = 'login.php';
        });
        $("#myModalFechar").click(function(){
            window.location.href = 'login.php';
        });
        $("#myModalOK").click(function(){
          atualizaCampo('senhalock',$('#inputcampo').val(),'0','texto');
        });

        
  }
  if (texto != '') $('#myModalTexto').html(texto);
  if (botao.indexOf("sim") >= 0) $('#myModalSim').addClass('btn btn-success').show();
  if (botao.indexOf("nao") >= 0) $('#myModalNao').show();
  if (botao.indexOf("ok") >= 0) $('#myModalOK').show();
  if (tipo === 'cfm') {$('#myModalOK').text('OK'); $('#myModalOK').show();}
  if (botao.indexOf("cancelar") >= 0) $('#myModalCancelar').show();
  $('#myDialog').modal('show');
  if (botao.indexOf("sim") >= 0) $('#myModalSim').focus();
  if (botao.indexOf("ok") >= 0) $('#myModalOK').focus();
  if (tipo.indexOf("input") >= 0) $('#inputcampo').focus();
  $('.myModalBotao').on('mousedown',function(){botaoacao = $(this).attr('value');});

  if (tipo.indexOf('10') >= 0) tempo = 10;
  else if (tipo.indexOf('1') >= 0) tempo = 1;
  else if (tipo.indexOf('2') >= 0) tempo = 2;
  else if (tipo.indexOf('3') >= 0) tempo = 3;
  else if (tipo.indexOf('4') >= 0) tempo = 4;
  else if (tipo.indexOf('5') >= 0) tempo = 5;

  if (tipo.indexOf("inputpassword") >= 0)
  {
    setTimeout(function () {   
    $('#inputcampo').focus(); }, 2000);
  }
  if (tempo >0) setTimeout(function () {
$('#myDialog').modal('hide')}, tempo*1000);
  }
}

function Imprimir(pagina, botao) {    
    $('#'+botao).click( function(){
        const win = window.open(pagina, '_blank', 'height=600,width=700');
        win.onload = function () {
            setTimeout(function () {
                win.print();
            }, 200);
            win.onafterprint = function () {
                win.close();
            }
        };
    });
}

function GerarPDF(NomeListagem, div) {
    const conteudo = document.getElementById(div);
    var opt = {
        margin:       0.5,
        filename:     'Rel_'+NomeListagem+'.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' },     
        footer: {
            height: '10mm',
            contents: {
                default: '<span style="color: #444; font-size: 10px; text-align: center;">Seu Rodapé Aqui</span>'
            }
        }   
    };

    html2pdf().from(conteudo).set(opt).save();
}



function mostrarToast (texto,tempo,liveToast) {
   if (liveToast === undefined) liveToast = '#liveToast';
   if (tempo === undefined) tempo = 1;
   tempo = tempo*1000;   
    // Selecione o toast
    $('#text-body').html(texto);
    $('#progressBar').attr("style","width:100%;");
    
    var liveToast = $(liveToast);
    // Mostrar o toast
    liveToast.show();   
    // Agendar a ocultação do toast após 1 segundo
    setTimeout(function () {
      liveToast.hide();
    }, tempo);
    var progressBar = document.getElementById('progressBar');
    // Defina a largura inicial da barra de progresso (100%)
    var progressWidth = 100;
    // Defina o intervalo para diminuir a largura a cada segundo
    var interval = setInterval(function () {
      // Diminua a largura da barra de progresso
      progressWidth -= 20;
    
      progressBar.style.width = progressWidth + '%';
      // Verifique se a largura atingiu 0%
      if (progressWidth <= 0) {
        // Limpe o intervalo se atingir 0%
        clearInterval(interval);
      }
    }, 100);
  }

function esperarModalFechado(meumodal) {
  return new Promise((resolve) => {
    const modal = document.getElementById(meumodal);
    function onModalFechado() {
      modal.removeEventListener('hide.bs.modal', onModalFechado);
      resolve();
  }
  modal.addEventListener('hide.bs.modal', onModalFechado);
});
}

function executasql(sql, banco){
  
}

function executasqlcampo(sql, banco, componente) {
  return new Promise(function(resolve, reject) {
    var request = $.ajax({
        url: "sql.php",
        type: "post",
        data: {
            sql: sql,
            banco: banco
        }
    });
    request.done(function(data) {
        resolve(data);
        $('#'+componente).text(data);
        $('#'+componente).val(data);
    });

    request.fail(function(jqXHR, textStatus) {
        messagedlg(textStatus);
    });

    request.always(function() {
        // Pode adicionar código aqui se necessário
    });
  });
}

// function inserir itens no formulario
function insertform(form,compfocus,grid){
  // alert('3');
  
  if (grid === undefined) {
    event?.preventDefault();
  $('#editar').attr('disabled', true);
  $('#deletar').attr('disabled', true);
  $('#incluir').attr('disabled', true);
  }
  // alert('4');
  var $inputs = $(form).find("input, select, textarea");
  $('.tabela_detalhe').remove();
  // alert('5');
  $inputs.each(function(){

    if ($(this).attr('type') != 'hidden')
    $(this).val($(this).attr('default'));

    if ($(this).attr('name') === 'dml'){
      $(this).val('I');
    }

    if ($(this).val().length > 0)
      $(this).change();
  
    if ($(this).attr('type') === 'checkbox')
      $(this).prop('checked', ($(this).attr('default') === $(this).attr('checado')));

      if (!$(this).hasClass('pk') && !$(this).hasClass('travado')){
        $(this).removeAttr('readonly');
        $(this).removeAttr('disabled');
      }
  });
  if (compfocus != '') {
    $('#'+compfocus).focus();
    // alert('2');
    $('#salvar').removeAttr('disabled');
  }
}

// function Editar itens no formulario
function editform(form,compfocus){
  event?.preventDefault();
  var $inputs = $(form).find("input, select, textarea");
  $inputs.each(function(){
    if ($(this).attr('name') === 'dml')
    $(this).val('U');
    
    if (!$(this).hasClass('pk') && !$(this).hasClass('travado')) {
      $(this).removeAttr('readonly');
      $(this).removeAttr('disabled');
     }
  });
  if (compfocus != '')      
    $('#'+compfocus).focus();      
  $('#salvar').removeAttr('disabled');
}

function deleteitem(banco, tabela, campo, pk,compremove, compclick, tipo)
{
  esperarModalFechado('myDialog').then(() => {
  if (botaoacao == 'sim'){
  var request = $.ajax({
    url: "dmlget.php",
    type: "get",
    data: { 
            dml : 'D',
            banco: banco,
            tabela: tabela,
            campo: campo,
            pk : pk,
            tipo : tipo
          }
  });
  request.done(function(data) {
    if (data.indexOf('sucesso') >=0){
      if (compremove != '') $('#'+compremove).remove(); 
      messagedlg('Registro removido com sucesso','ok','alerta1');
      if (compclick != '') $('#'+compclick).click(); 

    }
    else 
      messagedlg(data,'ok','alerta');
  });
  request.fail(function(jqXHR, textStatus) {
    messagedlg(textStatus,'ok','alerta');
  });
  request.always(function() {
  });
  }
  });  
  event?.preventDefault();  
  messagedlg('Tem certeza que deseja deletar o registro?','simnao','aviso');
}
//Funcao para navegar entre registros
function navegador(tipo,paginaupdate,form){
  sgbd = form.find('#tiposgbd').val();
  tabela = form.find('#tipodml').val();
  nomecampo = form.find('.pk').attr('name');
  valorcampo = form.find('.pk').val();
  if ((valorcampo === "") && ((tipo === "N") || (tipo === "P"))) {
    messagedlg('Escolha primeiro um registro','ok','alerta1');
    exit();
  }
  request = $.ajax({
    url: 'geral/navegador.php',
    type: "post",
    data: {
            tipo: tipo,
            sgbd: sgbd,
            tabela: tabela,
            nomecampo: nomecampo,
            valorcampo: valorcampo
          }
  });
  request.done(function(data) {      
  if ((data.indexOf('sucesso') >=0) && (data.indexOf('sucesso') <=6)) {
    // console.log(data);
  data = data.replace(/.*?(sucesso)/, '$1');
  messagedlg('Acessando o registro: '+data.substring(7),'ok','info1');
  
  setTimeout(() => {
    if ((paginaupdate != undefined) && (data.substring(7) != ''))
    {
      <? if ($_SESSION['config']['dev'] == 'S') //echo 'alert(data.substring(7));' ?>    
      showMain(data.substring(7),'cpcMain',paginaupdate+'.php?indice=');
    }
  }, 1000);
  }
  else 
  messagedlg(data,'ok','alerta');
  });  
  
}


function inputbox(texto,tipo,pagina,comp)
{
  event?.preventDefault();
  esperarModalFechado('myDialog').then(() => {
  if (
    ($('#inputcampo').val() != '')){
      if  (pagina != '')
        showMain($('#inputcampo').val().replace(/[^0-9]/g, ''),comp,pagina+'.php?indice=');
  }
  });

  messagedlg(texto,'ok cancelar',tipo);
  

}

//Atualizar campo direto o banco de dados
function atualizaCampo(tipo,valor,pk,campo,mensagemok)
{  
  if (campo == 'texto'){
    request = $.ajax({
    url: 'updatecampo.php',
    type: "post",
    data: {
            tipo: tipo,
            valor: valor,
            pk: pk
        }
    });
    request.done(function(data) {
      if (data.indexOf('sucesso') <0)
      {
        if (tipo != 'senhalock')
        messagedlg(data);
        else
          $('#inputcampo').val('');
      }
      else if (mensagemok) messagedlg('Ação executada com sucesso','ok','info1');
      else if (tipo == 'senhalock') $("#myDialog").modal('hide');
    });
  }
  else
  {
  request = $.ajax({
  url: 'updatecampo.php',
  type: "post",
  data: {
            tipo: tipo,
            valor: valor.checked,
            pk: pk
        }
  });
  request.done(function(data) {
    if (data.indexOf('sucesso') <0)
    {      
      valor.checked = !valor.checked;  
      messagedlg(data);
    }
    else if (mensagemok) messagedlg('Ação executada com sucesso','ok','info1');
  });
  }
  request.fail(function(jqXHR, textStatus) {
  messagedlg(textStatus,'ok','alerta');
  });
  request.always(function() {
  $inputs.prop("disabled", false);
  carregando(false);
  });
}

//Atualizar campo direto o banco de dados
function atualizaCampotexto(tipo,valor,pk)
{
  request = $.ajax({
  url: 'updatecampo.php',
  type: "post",
  data: {
            tipo: tipo,
            valor: valor,
            pk: pk
        }
  });
  request.done(function(data) {
    if (data.indexOf('sucesso') <0)
    {
      messagedlg(data);
    }
 
  });
  request.fail(function(jqXHR, textStatus) {
  messagedlg(textStatus,'ok','alerta');
  });
  request.always(function() {
  $inputs.prop("disabled", false);
  carregando(false);
  });
}

function pesquisar(input_busca, tabela_dados) {
      let expressao = input_busca.value.toLowerCase();

      if (expressao.length === 1) {
          return;
      }

      let linhas = tabela_dados.getElementsByTagName('tr');

      for (let posicao in linhas) {
          if (true === isNaN(posicao)) {
              continue;
          }

          let conteudoDaLinha = linhas[posicao].innerHTML.toLowerCase();

          if (true === conteudoDaLinha.includes(expressao)) {
              linhas[posicao].style.display = '';
          } else {
              linhas[posicao].style.display = 'none';
          }
      }
  }
//Enviar dados para um form e depoois clicar num botao
function dmlitem(form,pagina,botao,paginaupdate,divupdate)
{
  formsavevalor(form);
  form.addClass('was-validated');
  if (divupdate === undefined) divupdate = 'cpcMain';
  if (pagina === undefined) pagina = 'dml';
  pagina += '.php';
  
  var camposValidos = true;
  form.find('[required]').each(function() {
  if ($(this).val().trim() === '') {
  camposValidos = false;
  return false; // Encerra o loop
  }
  });


  if (!camposValidos) {
    messagedlg('Campo Obrigatório','ok','alerta1');
  return; // Não envia o formulário se houver campos inválidos
  }
  // else {
  //   form.removeClass('was-validated');
  // }

  formremovemask(form);

  var $inputs = form.find("input, select, button, textarea");
  var formData = new FormData(form[0]);
  if (formData.get("tipodml"))
  {
    form.find('input[type="checkbox"]').each(function() {
    var checkbox = $(this);
    var checkboxValue = checkbox.is(':checked') ? checkbox.attr('checado') : checkbox.attr('nchecado');
    formData.append(checkbox.attr('name'), checkboxValue);
    });
    
  $inputs.prop("disabled", true);
  carregando(true);
  request = $.ajax({
  url: pagina,
  type: "post",
  processData: false,  // No processar os dados
  contentType: false,
  data: formData
  });
  request.done(function(data) {      
  if ((data.indexOf('sucesso') >=0) && (data.indexOf('sucesso') <=6)) {
    // console.log(data);
  data = data.replace(/.*?(sucesso)/, '$1');
  messagedlg('Registrado com sucesso','ok','info1');
  setTimeout(() => {
    if ((paginaupdate != undefined) && (data.substring(7) != ''))
    {
      <? if ($_SESSION['config']['dev'] == 'S') //echo 'alert(data.substring(7));' ?>    
      showMain(data.substring(7),divupdate,paginaupdate+'.php?indice=');
    }
     //{alert(data.substring(7)); showMain(data.substring(7),divupdate,paginaupdate+'.php?indice=');} //verificar erro no grid depois de salvar
     if (botao !== '')
       {$('#'+botao).click();}
  }, 2000);
  }
  else 
    messagedlg(data,'ok','alerta');
  });
  request.fail(function(jqXHR, textStatus) {
  messagedlg(textStatus,'ok','alerta');
  });
  request.always(function() {
  $inputs.prop("disabled", false);
  carregando(false);
  });    
  }
}


function filtroLabel(form){
  var $inputs = $(form).find("input:visible, select:visible");
  $texto = "";
  
  $inputs.each(function(){
    var label = form.find('label[for="' + this.id + '"]').text();
    label = '<strong>'+label+': </strong>';
    valor = $(this).val();
    if ((valor != '') && (valor != 'Todos')) {
      if($(this).is('select')) {
        valor = $(this).find('option:selected').text();
        $texto +=  label + ' ' + valor+ ' ';
      }
      else if ($(this).attr('type') === 'date'){
        $texto +=  label + valor.substring(8,10) + '/' + valor.substring(5,7) + '/' + valor.substring(0,4) + ' ';
      }
      else {
        $texto +=  label + valor + ' ';
      }
    }
  });
  if ($('#filtrolabel').length > 0)
    $('#filtrolabel').val($texto);
}


//Post um form para uma pagina e resultado em um componente
function sqlitem(form,pagina,componente,tabelanome,botao)
{
  // alert(form.attr('name'));
  // alert(pagina);
  // alert(componente);
  // alert(tabelanome);
  // alert(botao);
  formsavevalor(form);
  filtroLabel(form)
  // $('#filtrolabel').val($('#tipo_data option:selected').text());

  if (pagina === undefined) pagina = 'dml';
  pagina += '.php';

  var camposValidos = true;
  form.find('[required]').each(function() {
  if ($(this).val().trim() === '') {
  camposValidos = false;
  return false; // Encerra o loop
  }
  });

  if (!camposValidos) {
  return; // Não envia o formulário se houver campos inválidos
  }

  var $inputs = form.find("input, select, button, textarea");
  var formData = new FormData(form[0]);
  //alert(formData.get("tipodml"));
  if (formData.get("tipodml"))
  {  
    $inputs.prop("disabled", true);
    carregando(true);
    request = $.ajax({
    url: pagina,
    type: "post",
    processData: false,  // Não processar os dados
    contentType: false,           
    data: formData
    });
    request.done(function(data) {
      console.log(data);      
    document.getElementById(componente).innerHTML = data;
    if (tabelanome != '')
      carregando(false, tabelanome);
    if (botao != '')
      $('#'+botao).click(); 
    });
    request.fail(function(jqXHR, textStatus) {
      messagedlg(textStatus,'ok','alerta');
    });
    request.always(function() {
    $inputs.prop("disabled", false);
    carregando(false);
    });
  }
}

function relatorio(tabelanome) {    
$(tabelanome).DataTable({
    dom: '<"top"f>rti<"bottom"plB><"clear">',
    order: [[0, 'desc']],
    autoWidth: false,
    paging: true,
    pageLength:10,
    lengthMenu: [ [5,10,25, 50, 100, 200, -1], [5,10,25, 50, 100, 200, "Todas"] ],
    language: {
        url: 'assets/DataTables/pt_br.json'
    }, 
  buttons: [
  'copy', 'csv',  {
      extend: 'excel',
      messageTop: 'Chamados',
      title: 'Relatório de Chamados CPC',
      messageBottom: 'www.cpcbrasil.com'
  },
  {
      extend: 'pdf',
      messageTop: 'Chamados',
      title: 'Relatório de Chamados CPC',
      messageBottom: 'www.cpcbrasil.com'
  },
  {
      extend: 'print',
      messageTop: 'Chamados',
      title: 'Relatório de Chamados CPC',
      messageBottom: 'www.cpcbrasil.com'
  },
],
columnDefs: [
    { 
        className: 'cell-border',                
    }
]

}).reload;
}
</script>

<script>
function tab(pagina) {
  document.getElementById('cpcMain').style.display = "none";
  document.getElementById('tab1').style.display = "none";
  document.getElementById('tab2').style.display = "none";
  document.getElementById('tab3').style.display = "none";
  document.getElementById('tab4').style.display = "none";
  document.getElementById(pagina).style.display = "block";
}

function showMain(str,txtdiv,url, tabelanome, botao) {
  event?.preventDefault();
  $('#cpcaba').val('');
  if ($('.select-cpc-abas').length > 0) $('#cpcaba').val($('.select-cpc-abas').val());

  if (str == "") str = " ";
  if (str != undefined)
  carregando(true);
  if (txtdiv === undefined)
  txtdiv = "cpcMain";
  if ($("#telapopup").is(":visible") && (txtdiv === "cpcMain"))
    txtdiv="telapopup";

  if (url === undefined)
  url = "main.php?tela=";
  if (str.length == 0) { 
    document.getElementById(txtdiv).innerHTML = "";    
    return;
  }
  if ((txtdiv == 'tab1') || (txtdiv == 'tab2') ||
      (txtdiv == 'tab3') || (txtdiv == 'tab4'))
  {
    document.getElementById('cpcMain').style.display = "none";
    document.getElementById('tab1').style.display = "none";
    document.getElementById('tab2').style.display = "none";
    document.getElementById('tab3').style.display = "none";
    document.getElementById('tab4').style.display = "none";
  }


  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    if (this.responseText.indexOf('select-cpc-abas') <= 0) 
      {$('#cpcaba').val(''); }
    if ((this.responseText.indexOf('Undefined array key "ID_CPC"') >= 0) ||
    (this.responseText.indexOf('Undefined array key "USUARIONOME"') >= 0)){
      window.location.href = 'login.php';
      exit();
    }
    document.getElementById(txtdiv).innerHTML = this.responseText;

    if (txtdiv === 'listapopupcpc') {
       $('#'+txtdiv).css('top',+mouseY+'px'); 
       $('#'+txtdiv).css('left',+mouseX+'px'); 
      $('#'+txtdiv).show();
    }    
    if (txtdiv === 'telapopup') {
      topo = parseInt($('#cpcMain').css('top'), 10);
      altura = $(window).height() - topo - 50;
      $('#overlay').css('top',+topo+'px');
      var alturaRestante = $(document).height() - $('#overlay').offset().top -50;
      $('#overlay').height(alturaRestante);
      console.log($('#overlay').offset().top);
      console.log($(window).height());
      console.log(alturaRestante);
      // $('#overlay').css('height',+alturaRestante+'px');
      $('#overlay').show();
      //  $('#'+txtdiv).css('top',+mouseY+'px'); 
      //  $('#'+txtdiv).css('left',+mouseX+'px'); 
      // $('#'+txtdiv).show();
    }    

    if (tabelanome !== '')
    carregando(false, tabelanome, botao);
    
    // document.getElementById(txtdiv).style.display = "block";
  }
  xhttp.open("GET", url+str);
  xhttp.send(); 
  //event?.preventDefault();
  //
  $('#offcanvasclose').click();
  // $('#popupNested').popup('close');
  setTimeout(function() { if (txtdiv === 'cpc-listagem') $('#filtro').focus(); },1000);
  
}

function carregando(flag,tabelanome, botao) {
  if (flag)
  $(document).ready(function(){
  $("#loader").show();
  });   
  else 
  $(document).ready(function(){
  $("#loader").hide();
  formloadvalor();
  });   
  if ((!flag) && (tabelanome != undefined))
  {
  // relatorio(tabelanome);
  }
  $('select').each(function(){ 
    if (!$(this).hasClass('cpcnoupdate'))
    if ($(this).attr('value') != ''){
      $(this).val($(this).attr('value'));
    }
  });
  
  ajustaAltura();


$(document).ready(function(){
    $('th').click(function(){
        var table = $(this).parents('table').eq(0);
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
        this.asc = !this.asc;
        if (!this.asc){rows = rows.reverse();}
        for (var i = 0; i < rows.length; i++){table.append(rows[i]);}
    });
    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
        };
    }
    function getCellValue(row, index){ return $(row).children('td').eq(index).text(); }
});





  if (botao !== '')
       $('#'+botao).click(); 

  // $('.codtexto').change();
  

  // Se showmain chamou uma tela de aba ele configura para ficar na mesma aba anterior selecionada
  if ((!flag) && ($('#cpcaba').val() !== '') && ($('.select-cpc-abas').length > 0)) {
      $('.select-cpc-abas').val($('#cpcaba').val());
      if ($('.select-cpc-abas').val() === '')
        $('.select-cpc-abas option:first').prop('selected', true);

      $('.select-cpc-abas').change();
  }



  
  //Ajustar as mascaras dos tipos selecionados
  var nomaxlength = ['cnpj', 'cpf', 'tel', 'cel','cep','proc8','proc10','moeda','contabil'];
  $('input[tipocpc]').each(function() {
    
    if (nomaxlength.indexOf($(this).attr('tipocpc')) !== -1) {
      $(this).removeAttr('maxlength');
      $(this).attr('type','text');
      $(this).attr('sonumero','S');
    }
    if ($(this).attr('tipocpc') === 'tel')
      $(this).attr("data-inputmask","'mask': '(999)9999-9999'");
    if ($(this).attr('tipocpc') === 'cel')
      $(this).attr("data-inputmask","'mask': '(999)9999[9]-9999'");
      if ($(this).attr('tipocpc') === 'proc8')
      $(this).attr("data-inputmask","'mask': '9.99.99.99-9'");
    if ($(this).attr('tipocpc') === 'proc10')
      $(this).attr("data-inputmask","'mask': '99.99.99.999-9'");
    if ($(this).attr('tipocpc') === 'cep')
      $(this).attr("data-inputmask","'mask': '99.999-999'");
    if ($(this).attr('tipocpc') === 'cnpj')
      $(this).attr("data-inputmask","'mask': '99.999.999/9999-99'");
    if ($(this).attr('tipocpc') === 'contabil')
      $(this).attr("data-inputmask","'mask': '9.9.9.99.999'");
    if ($(this).attr('tipocpc') === 'cpf')
      $(this).attr("data-inputmask","'mask': '999.999.999-99'");
    if ($(this).attr('tipocpc') === 'email')
      $(this).attr("data-inputmask","'alias': 'email'");
    if ($(this).attr('tipocpc') === 'moeda')
      $(this).inputmask('decimal', {radixPoint: ',', groupSeparator: '.', autoGroup: true, digits: 2, allowMinus: false, rightAlign: true });
    
  });
  // $(":input").inputmask({autoUnmask: true}); essa opção dsajusta os inputs quando os textos sao maiores
  $(":input").inputmask();

  $(document).ready(function() {
      // Adiciona um manipulador de evento de tecla pressionada a todos os campos de input
      $('input:visible, select:visible').keydown(function(e) {
        // Verifica se a tecla pressionada é a tecla "Enter" (código 13)
        if (e.which === 13) {
          e.preventDefault();  // Impede o comportamento padrão (enviar o formulário)
          // Foca no próximo campo de input
          
          var index = $('input:visible, select:visible').not('[tabindex="-1"]').index(this) + 1;
          if ($('input:visible, select:visible').not('[tabindex="-1"]').eq(index).length > 0)
            {$('input:visible, select:visible').not('[tabindex="-1"]').eq(index).focus();}
          else
          {$('.salvar').focus();}
        }
      });

    });
    if (!flag) $('.loadcpc').click();
}


function formulario2(formnome,arquivo){
// Variable to hold request
if (arquivo === undefined)
arquivo = "dml";
arquivo += ".php";

var request;
// Bind to the submit event of our form
$(formnome).submit(function(event){
// Prevent default posting of form - put here to work in case of errors
event?.preventDefault();
// Abort any pending request
if (request) {
request.abort();
}
// setup some local variables
var $form = $(this);
// Let's select and cache all the fields
var $inputs = $form.find("input, select, button, textarea");
var formData = new FormData($form[0]);
// Serialize the data in the form
//var serializedData = $form.serializeArray();
// var serializedData = $form.serialize();
//  if (serializedData.indexOf("tipodml") >=0)
if (formData.get("tipodml"))
{
// Let's disable the inputs for the duration of the Ajax request.
// Note: we disable elements AFTER the form data has been serialized.
// Disabled form elements will not be serialized.
$inputs.prop("disabled", true);
carregando(true);
// Fire off the request to /form.php
request = $.ajax({
  url: arquivo,
  type: "post",
  processData: false,  // NÃ£o processar os dados
contentType: false,           
  //    data: $.param(serializedData)
  data: formData
});
// Callback handler that will be called on success
request.done(function (response, textStatus, jqXHR){
});
// Callback handler that will be called on failure
request.fail(function (jqXHR, textStatus, errorThrown){
  // Log the error to the console
  console.error(
    "The following error occurred: "+
    textStatus, errorThrown
  );
});

// Callback handler that will be called regardless
// if the request failed or succeeded
request.always(function () {
  // Reenable the inputs
  $inputs.prop("disabled", false);
});

// Put the results in a div
request.done(function( data ) {
  
  $( "#result" ).empty().append( data );
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  var span = document.getElementsByClassName("close")[0];
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }   
  carregando(false);
  if (data.indexOf("sucesso") > 1 )
  setTimeout(function() { modal.style.display = 'none'; },2000);
});
}
carregando(false);
}); //formsubmit
}

function enviardados(){

}


function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
// Get the modal
// var modal = document.getElementById("myModal3");

// Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById("myImg");
// var modalImg = document.getElementById("img01");
// var captionText = document.getElementById("caption");
// img.onclick = function(){
// modal.style.display = "block";
// modalImg.src = this.src;
// captionText.innerHTML = this.alt;
// }

// Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
// span.onclick = function() { 
// modal.style.display = "none";
// }
// Função para adicionar/remover a classe 'bg-success' e atualizar o localStorage
function toggleButtonColor() {
    const button = document.getElementById('toggle-button');
    button.classList.toggle('bg-success');
    
    // Verifica se a classe 'bg-success' estÃ¡ presente e armazena o estado no localStorage
    const isBackgroundSuccess = button.classList.contains('bg-success');
    localStorage.setItem('backgroundSuccess', isBackgroundSuccess);
}

// Verifica se hÃ¡ um estado armazenado no localStorage e define a cor de fundo do botÃ£o com base nisso
window.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('toggle-button');
    const isBackgroundSuccess = localStorage.getItem('backgroundSuccess') === 'true';

    if (isBackgroundSuccess) {
        button.classList.add('bg-success');
    }

    // Adiciona um ouvinte de eventos para alternar a cor de fundo quando o botão for clicado
    // button.addEventListener('click', toggleButtonColor);
});

function saveSelectedValue() {
    const selectElement = document.getElementById('tipo_select');
    const selectedValue = selectElement.value;
    localStorage.setItem('selectedValue', selectedValue);
}

// window.addEventListener('DOMContentLoaded', () => {
//     const selectElement = document.getElementById('tipo_select');
//     const savedValue = localStorage.getItem('selectedValue');

//     if (savedValue) {
//         selectElement.value = savedValue;
//     }

//     selectElement.addEventListener('change', saveSelectedValue);
// });
$(document).ready(function() {
    const selectElement = $('#tipo_select'); // Acessa o elemento select usando jQuery
    const savedValue = localStorage.getItem('selectedValue'); // Obtém o valor salvo

    // Verifica se há algum valor salvo e atualiza o valor do select, se necessário
    if (savedValue) {
        selectElement.val(savedValue);
    }

    // Adiciona um manipulador de eventos 'change' ao select
    selectElement.on('change', function() {
        const selectedValue = $(this).val(); // Obtém o valor selecionado
        localStorage.setItem('selectedValue', selectedValue); // Salva o valor selecionado
    });
});


//Funcao para imprimir relatorio
function relprint(titulo,filtro,tabela,rodape)
{

}

//Funcao armazenar valores dos campos no form
function formsavevalor(form){
  var $inputs = $(form).find("input, select, textarea");
  
  $inputs.each(function(){
    if ($(this).hasClass('cpcsave')){
      if (sessionStorage.getItem(form.attr('name') + $(this).attr('name')) != $(this).val())
       sessionStorage.setItem(form.attr('name') + $(this).attr('name'), $(this).val());
     }
  });
}

function formloadvalor(){
  $('form').each(function() {
    // Armazena a referência atual do formulário
    var forms = $(this);
    var $inputs = forms.find("input, select, textarea");
    $inputs.each(function(){
      if (sessionStorage.getItem(forms.attr('name') + $(this).attr('name')) != '')    
      if (sessionStorage.getItem(forms.attr('name') + $(this).attr('name')) != null)    
      if ($(this).hasClass('cpcsave')){
        $(this).val(sessionStorage.getItem(forms.attr('name') + $(this).attr('name')));
      }
    });
  });
}

function verificarSenha(novasenha,contranovasenha,botao) {  
  let senha = document.getElementById(novasenha).value;
  let contrasenha = document.getElementById(contranovasenha).value;
  let botaosalvar = document.getElementById(botao).value;
  // Atualizar a barra de progresso
  let progresso = 0;
  if (/[A-Z]/.test(senha)) progresso += 20;
  if (/[a-z]/.test(senha)) progresso += 20;
  if (/[0-9]/.test(senha)) progresso += 20;
  if (/[!@#$%^&*(),.?":{}|<>]/.test(senha)) progresso += 20;
  if (senha.length >= 8) {
    progresso += 10;
    if ((senha == contrasenha)) progresso += 10;
  }
  let barraProgresso = document.getElementById("progress-bar");
  barraProgresso.style.width = progresso + "%";
  $('#botaosalvar').attr('disabled', (progresso != 100));

              
}

function campoLista(componente,tipobusca,camposelect,campoextra){
  if  (componente.val() !== '')
  {
    var valorbusca = componente.val();
    if (componente.attr('sonumero') === 'S')
      valorbusca = valorbusca.replace(/\D/g, '');
    request = $.ajax({
    url: 'campolista.php',
    type: "post",
    data: {
            tipo: tipobusca,
            valor: valorbusca,
            campoextra: campoextra
        }
    });
    request.done(function(data) {
      if (data!= '')
        $('#'+camposelect).val(data);
      else
      {
        $('#'+camposelect).val('');
        componente.val('');
        messagedlg('Valor Inválido','OK','alerta1');
        componente.focus();
      }
    });
}
}

// Função para validar um campo do formulário usando AJAX
// Função para validar um campo do formulário via AJAX
function validarCampo(form, campo) {
  // Cria uma cópia do objeto de formulário
  var formaux = form;
  
  // Remove qualquer máscara do campo antes de processar
  formremovemask(formaux);

  // Verifica se o valor do campo não está vazio
  if (campo.val() !== "") {
    // Cria um objeto FormData para enviar dados do formulário via AJAX
    var formData = new FormData(formaux[0]);

    // Adiciona o nome do campo ao FormData
    formData.append('campo', campo.attr('name'));

    // Configuração da requisição AJAX

    var request = $.ajax({
      url: "validarcampo.php",
      type: "post",
      processData: false,
      contentType: false,
      data: formData
    });

    // Aplica máscara a todos os campos de entrada
    $(":input").inputmask();

    // Manipulador de sucesso da requisição AJAX
    request.done(function(data) {
      // Verifica se há dados na resposta
      if (data !== "") {
        try {
          // Tenta analisar a resposta JSON
          const obj = JSON.parse(data);

          // Exibe mensagem se houver uma mensagem definida
          if (obj.mensagem.texto !== "") {
            messagedlg(obj.mensagem.texto, obj.mensagem.botao, obj.mensagem.tipo);
          }

          // Verifica se um campo é necessário e se está vazio
          if ((obj.necessario.campo !== "") && ($('#' + obj.necessario.campo).val() === "")) {
            campo.val('');
            messagedlg("Primeiro tem que preencher o campo " + obj.necessario.texto, 'ok', 'alerta5');
            $('#' + obj.necessario.campo).focus();
          } else if (obj.status !== "S") {
            // Se o status não for "S", foca no campo atual
            campo.focus();
          }

          // Define um campo como obrigatório, se necessário
          if (obj.requerido !== "") {
            $('#' + obj.requerido).prop('required', true);
          }

          // Acessando o array 'campos' dentro do JSON
          var campos = obj.campos;

          // Iterando sobre os elementos do array
          $.each(campos, function(index, campo) {
            // Define valores para campos que são sempre preenchidos ou estão vazios
            if ((campo.sempre === 'S') || (form.find('[name="' + campo.campo + '"]').val() === '')) {
               form.find('[name="' + campo.campo + '"]').val(campo.valor);
               form.find('[name="' + campo.campo + '"]').change();
            }
          });
        } catch (error) {
          // Exibe uma mensagem em caso de erro ao analisar JSON
          console.error('Erro ao analisar JSON:', error);
          messagedlg("Erro ao analisar JSON:" + data, 'ok', 'aviso');
        }
      }
    });

    // Manipulador de falha da requisição AJAX
    request.fail(function(jqXHR, textStatus) {
      // Exibe uma mensagem em caso de falha na requisição AJAX
      console.error('Falha na requisição AJAX:', textStatus);
      messagedlg(textStatus, 'ok', 'alerta');
    });

    // Manipulador sempre executado após a requisição AJAX
    request.always(function() {
      // Pode adicionar lógica adicional aqui, se necessário
    });

    // Atualiza o estado do carregamento para falso
    //carregando(false);
  }
  $(":input").inputmask();
}



function buscaCampo(event, componente,tipobusca,campoextra){
  var componentedd = componente.attr('name')+'_dd';
  var componentedd = 'listapopupcpc';
  if (event.which === 40) {$('#'+componentedd+' a:first').focus(); }
  else if (![13, 9, 16].includes(event.which)) {
    var valorbusca = componente.val();
    if (componente.attr('sonumero') === 'S')
      valorbusca = valorbusca.replace(/\D/g, '');
    var componentecodigo = componente.attr('compcodigo');
    setTimeout(() => {
        var valorbusca2 = componente.val();
          if (componente.attr('sonumero') === 'S')
            valorbusca2 = valorbusca2.replace(/\D/g, '');
        if (valorbusca !== valorbusca2){
          valorbusca = '';
        }
        if (valorbusca !== ''){
          var request = $.ajax({
            url: "listacampo.php",
            type: "post",
            data: {
                tipo: tipobusca,
                valor: valorbusca,
                componente: componentecodigo,
                campoextra: campoextra
            }
        });
        request.done(function(data) {
            $('#'+componentedd).empty();
            $('#'+componentedd).append(data);

            var topo = parseInt(componente.offset().top, 10);
            
            if ((topo/$(window).height()) < 0.7){
              topo = topo + parseInt(componente.css('height'), 10);
              $('#'+componentedd).css('top',topo+'px');
            }  
            else {
              var topo = parseInt(componente.offset().top, 10);        
              topo = $(window).height() - topo;
              $('#'+componentedd).css('bottom',+topo+'px');
            }
            $('#'+componentedd).css('left',+parseInt(componente.offset().left)+'px');
            $('#'+componentedd).show();
        });
        }
        else
        {
          $('#'+componentedd).hide();
        }
        
      }, 700);

  }
}


function buscaCampoItem(componente,campocod,campodesc){
  event?.preventDefault();
  $('#'+componente).val(campocod); 
  $('#'+componente+'select').val(campodesc); 
  $('.listasuspensacpc').text('');
  $('.listasuspensacpc').hide(); 
  $('#'+componente+'select').focus(); 
  $('#'+componente).change();
}

function cepBusca (cep){
  fetch('https://viacep.com.br/ws/'+ cep.val().replace(/\D/g, '')+'/json/')
        .then(response => response.json())
        .then(data => {
          $('#'+cep.attr('uf')).val(data.uf);
          $('#'+cep.attr('cidade')).val(data.localidade);
          $('#'+cep.attr('bairro')).val(data.bairro);
          $('#'+cep.attr('logradouro')).val(data.logradouro);

        })
        .catch(error => {
          console.error('Erro na consulta JSON:', error);
          resultadoDiv.innerHTML = '<p>Ocorreu um erro na consulta.</p>';
        });
}

function cnpjBusca (cnpj){
  var request = $.ajax({
      url: 'https://www.receitaws.com.br/v1/cnpj/'+ cnpj.val().replace(/\D/g, ''),
      type: "get",
      dataType:'jsonp',
      success: function(data){
        $('#'+cnpj.attr('empresa')).val(data.nome);
        $('#'+cnpj.attr('uf')).val(data.uf);
        $('#'+cnpj.attr('cep')).val(data.cep.replace(/[^0-9]/g, ''));
        $('#'+cnpj.attr('cidade')).val(data.municipio);
        $('#'+cnpj.attr('bairro')).val(data.bairro);
        $('#'+cnpj.attr('logradouro')).val(data.logradouro);
        $('#'+cnpj.attr('complemento')).val(data.complemento);
        $('#'+cnpj.attr('email')).val(data.email);
      }
  });
}

 let slideIndex = 1;
// showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function ajustaAltura(imprimir){
  if (imprimir !== 'S') {
    if ($('#cpc-autoheight').length > 0) {
      var alturaRestante = $(window).height() - $('#cpc-autoheight').offset().top;
      $('#cpc-autoheight').height(alturaRestante);
    }
    if ($('#cpc-autoheightgrid').length > 0) {
    var alturaRestante = $(window).height() - $('#cpc-autoheightgrid').offset().top - 35;
    // alert(alturaRestante);
    $('#cpc-autoheightgrid').height(alturaRestante );
    }
  }
  else{
    $('#cpc-autoheight').height('auto');
    $('#cpc-autoheightgrid').height('auto');
  }
}
// *************************************Funcoes Tecnicas***********************************************
function listarNomesCampos(form) {
    // Obtém uma lista de elementos de entrada dentro do formulário usando jQuery
    const elementosDoFormulario = $('#formmedico');

    // Cria um array para armazenar os nomes dos campos
    const nomesDosCampos = [];
    const nomesDosCampos1 = [];
    const nomesDosCampos2 = [];


    var $inputs = $('#'+form).find("input, select, textarea");
  $inputs.each(function(){
    if ($(this).attr('type') != 'hidden')
    {
    nomesDosCampos.push($(this).attr('name'));
    nomesDosCampos1.push("$_POST['"+$(this).attr('name')+"']");
    nomesDosCampos2.push('?');
    }
  });  

    // Exibe os nomes separados por vírgula
    alert(nomesDosCampos.join(', '));
    alert(nomesDosCampos1.join(', '));
    alert('###('+nomesDosCampos2.join(', ')+')###');
    console.log(nomesDosCampos2.join(', '));
    console.log(nomesDosCampos1.join(', '));
}
// *************************************Validação de campos********************************************
function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpfaux = cpf.val();
    cpfaux = cpfaux.replace(/\D/g, '');
    // Verifica se o CPF tem 11 dígitos
    if (cpfaux.length == 0) return true;
    if (cpfaux.length !== 11) {
        cpf.focus();
        messagedlg('CPF Inválido','OK','alerta1');
        return false;
    }

    // Realiza o cálculo dos dígitos verificadores
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpfaux.charAt(i)) * (10 - i);
    }
    let digito1 = 11 - (soma % 11);
    digito1 = digito1 > 9 ? 0 : digito1;

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpfaux.charAt(i)) * (11 - i);
    }
    let digito2 = 11 - (soma % 11);
    digito2 = digito2 > 9 ? 0 : digito2;

    // Verifica se os dígitos verificadores são iguais aos fornecidos
    if  (!((parseInt(cpfaux.charAt(9)) === digito1) && (parseInt(cpfaux.charAt(10)) === digito2)))
    {
      cpf.focus();
      messagedlg('CPF Inválido','OK','alerta1');
    }
     
    return (parseInt(cpfaux.charAt(9)) === digito1) && (parseInt(cpfaux.charAt(10)) === digito2);
}

function validarCNPJ(cnpj) {
    // Remove caracteres não numéricos
    cnpjaux = cnpj.val();
    cnpjaux = cnpjaux.replace(/\D/g, '');

    // Verifica se o CNPJ tem 14 dígitos
    if (cnpjaux.length == 0) return true;
    if (cnpjaux.length !== 14) {
        cnpj.focus();
        messagedlg('CNPJ Inválido','OK','alerta1');
        return false;
    }

    // Realiza o cálculo dos dígitos verificadores
    let soma = 0;
    let peso = 2;
    for (let i = 11; i >= 0; i--) {
        soma += parseInt(cnpjaux.charAt(i)) * peso;
        peso = (peso === 9) ? 2 : (peso + 1);
    }
    let digito1 = (soma % 11 < 2) ? 0 : (11 - (soma % 11));

    soma = 0;
    peso = 2;
    for (let i = 12; i >= 0; i--) {
        soma += parseInt(cnpjaux.charAt(i)) * peso;
        peso = (peso === 9) ? 2 : (peso + 1);
    }
    let digito2 = (soma % 11 < 2) ? 0 : (11 - (soma % 11));

    // Verifica se os dígitos verificadores são iguais aos fornecidos
    if (!((parseInt(cnpjaux.charAt(12)) === digito1) && (parseInt(cnpjaux.charAt(13)) === digito2)))
    {
      cnpj.focus();
      messagedlg('CNPJ Inválido','OK','alerta1');
    }

    return (parseInt(cnpjaux.charAt(12)) === digito1) && (parseInt(cnpjaux.charAt(13)) === digito2);
}

// *************************************Validação CFM********************************************
function validarCFM(conselho) {
  messagedlg('Validação CFM','tipoconselho','cfm');
}

function cfmConsulta(conselho,uf,crm,cpf,nasc)
{
  request = $.ajax({
    url: 'cfm.php',
    type: "post",
    data: {
            uf: uf,
            crm: crm,
            cpf: cpf,
            nasc: nasc
        }
    });
    request.done(function(data) {
      try {
        const obj = JSON.parse(data);
        
        // Exibe mensagem se houver uma mensagem definida        
        if (cpf === undefined) {
          $('#ufcremeb').val(obj.uf);
          $('#a_cremeb').val(obj.crm);
          $('#a_nome').val(obj.nome);
          messagedlg("Prof. CFM: "+obj.nome, 'ok', 'info3');
        }
        else if ((obj.hasOwnProperty('resultadoConsulta')) && (obj.resultadoConsulta === 'true')){
          if (cpf !== '')
            $('#a_cpf').val(cpf);
          if (nasc !== '')
            $('#nascimento').val(nasc);
          
            messagedlg("Cadastro validado com sucesso", 'ok', 'info');
        }
        if ((obj.hasOwnProperty('resultadoConsulta')) && (obj.resultadoConsulta === 'false')){
          // alert(data);
          $('#a_cpf').val('');
          $('#nascimento').val('');
          messagedlg("Cadastro inválido", 'ok', 'alerta1');

        }
      } catch (error) {
        // Exibe uma mensagem em caso de erro ao analisar JSON
        messagedlg("Erro ao analisar JSON", 'ok', 'aviso');
      }
})
}


function formremovemask(form){
  form.find('input[tipocpc]').each(function() {
    if ($(this).attr('tipocpc') === 'moeda'){
      $(this).inputmask('remove');
      $(this).attr('tipocpc','');
      $(this).val($(this).val().replace(/\./g, ''));
      $(this).val($(this).val().replace(',', '.'));
    }
    else if ($(this).attr('sonumero') === 'S') {
      $(this).inputmask('remove');
      $(this).attr('tipocpc','');
      $(this).val($(this).val().replace(/\D/g, ''));
      }
  });
}

function salvarArquivoTexto(nomeDoArquivo, texto) {
    // Criar um elemento de link
    const elemento = document.createElement('a');
    
    // Configurar o conteúdo do arquivo usando um Blob
    const blob = new Blob([texto], { type: 'text/plain' });
    
    // Configurar o URL do Blob
    elemento.href = URL.createObjectURL(blob);
    
    // Definir o nome do arquivo para download
    elemento.download = nomeDoArquivo;
    
    // Ocultar o elemento (não precisa ser visível)
    elemento.style.display = 'none';
    
    // Adicionar o elemento ao corpo do documento
    document.body.appendChild(elemento);
    
    // Programaticamente clicar no elemento para iniciar o download
    elemento.click();
    
    // Remover o elemento após o download iniciar
    document.body.removeChild(elemento);
}


</script>