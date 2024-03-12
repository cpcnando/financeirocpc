
    <meta charset="iso-8859-1"><!-- meta --> 
    <meta http-equiv="CONTENT-LANGUAGE" content="Portuguese" /><!-- Linguagem --> 
    <meta name="copyright" content="CPC Brasil Sistemas" /><!-- Direitos --> 
    <meta name="title" content="CPC Brasil Sistemas" /><!-- titulo --> 
    <meta name="author" content="CPC Brasil Sistemas" /><!-- autor --> 
    <meta name="description" content="CPC Brasil Sistemas" /><!-- descricao--> 
    <meta name="keywords" content="CPC Brasil Sistemas" /><!-- palavra-chave --> 
    <meta name="viewport" content="width=device-width">
    <!-- <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"  type="text/css" /> -->
    <link rel="stylesheet" href="assets/css/cpc.css">
    <link rel="stylesheet" href="assets/bootstrap/css5/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/icons-1.8.1/font/bootstrap-icons.css"> -->
    <!-- <link rel="stylesheet" href="assets/fonts-6/css/all.css" type="text/css" > -->
    <link rel="stylesheet" href="assets/fonts-6/css/all.min.css" type="text/css" >
    <style>
        @font-face {
            font-family: 'Ubuntu';
            src: url('assets/fontes/Ubuntu-Regular.ttf') format('truetype'); /* substitua o caminho conforme necessário */
            font-weight: 400; /* ou 700 para a versão bold, se disponível */
            font-style: normal;
        }
    </style>
    
    <!-- <link rel="stylesheet" href="assets/jquery.mobile/jquery.mobile-1.4.5.min-cpc.css"> -->
    
    <!-- <link rel="stylesheet" href="assets/DataTables/dataTables.min.css"> -->
    
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
    <title>Sistemas - CPC Brasil Sistemas</title>
    <script>


        const pageAccessedByReload = (
        (window.performance.navigation && window.performance.navigation.type === 1) ||
            window.performance
            .getEntriesByType('navigation')
            .map((nav) => nav.type)
            .includes('reload')
        );
        if (pageAccessedByReload) {
            <? if ($_SESSION['config']['dev'] !== 'S') echo "window.location.href = 'login.php';" ?>
            
            // if ($('#mensagemtitulo').html() == 'Tela de Bloqueio')
            //   alert('sdasdas');
            // xxxxalert("Página atualizada manualmente. Tela inicial será carregada");
        }

    </script>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1002">
        <div class="toast align-items-center text-white bg-success border-0" style="max-width: 100%;" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body"  style="min-width: 300px; ">
                <div id="text-body"></div>
                <div class="progress" style="height: 7px;">
                <div id="progressBar" class="progress-bar bg-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" ></div>
                </div>  
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="$('#liveToast').hide();" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="modal" id="myDialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between text-center">
                    <i id="messagedialog" class=" m-3"  aria-hidden="true" style="font-size:48px; color: #008898"></i>
                    <div class="text-center " style="margin-left: 130px">
                        <h4 class="modal-title" id="mensagemtitulo">Mensagem</h4>
                    </div>
                    <button type="button" class="btn-close" id="myModalFechar" data-bs-dismiss="modal" value="close" title="Fechar"></button>
                </div>
                <div id="myModalTexto" class="modal-body text-center" style="overflow: auto; max-height:50vh" >
                </div>
                <div class="modal-footer d-flex justify-content-around">
                    <button type="button" class="btn btn-success myModalBotao" data-bs-dismiss="modal" id="myModalSim" value="sim">Sim</button>
                    <button type="button" class="btn btn-danger myModalBotao" data-bs-dismiss="modal" id="myModalNao" value="nao">Não</button>
                    <button type="button" class="btn btn-success myModalBotao" data-bs-dismiss="modal" id="myModalOK" value="ok">OK</button>
                    <button type="button" class="btn btn-danger myModalBotao" data-bs-dismiss="modal" id="myModalCancelar" value = "cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>    



    <!-- Modal -->
    <div id="myModal" class="modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="result" class="modal-content"></div>
      </div>
    </div>
    <!-- Popup -->

     <!-- <div data-role="popup" id="popupNested">
        <div data-role="main" class="ui-content">
            <div id="listapopup" class="listapopup">
                <a href="#" class="ui-btn-cpc">Inicializando...</a>
            </div>
        </div>      
    </div> -->

    <!-- OffCanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCPC" aria-labelledby="offcanvasCPCLabel">
        <div class="offcanvas-header" style="background-color: #008898; color: #ffffff; font-family: sans-serif">
            <h5 class="offcanvas-title" id="offcanvasCPCLabel">Menu de Opções</h5>
            <button type="button" class="btn-close text-reset btn btn-light" data-bs-dismiss="offcanvas" aria-label="Close" id="offcanvasclose"></button>
        </div>
        <div class="offcanvas-body">
            <div data-role="main" class="ui-content" >
                <div id="listaoffcanvas" >
                    <a href="#" class="ui-btn-cpc"></a>
                </div>
            </div>      
        </div>
    </div>    