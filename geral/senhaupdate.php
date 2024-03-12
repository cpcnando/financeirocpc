<?
    include __DIR__."/../headermain.php";
    include __DIR__."/../sgbd/fatura.php";
    if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from usuarios where codigo =0".$_GET['indice'];
     foreach ($fatura->query($sql) as $rowusuarios) {}
?>
<div class="card my-2 container">
    <div class="card-head h3 text-center">
        Alteração de Senha
    </div>
</div>
<div class="card container">
    <div class="card-body row">
        <div class="col-6">
            <label class="form-label">Senha</label>
            <input id="novasenha" name="senha" type="password" class="form-control" value="<? echo $rowusuarios['SENHA'] ?? '' ?>" size="40" autocomplete="off" onkeyup = "verificarSenha('novasenha','contrasenha','botaosalvar');">
        </div>                    
        <div class="col-6">
            <label class="form-label">Confirmação</label>
            <input id="contrasenha" name="contrasenha" type="password" class="form-control" value="<? echo $rowusuarios['SENHA'] ?? '' ?>" size="40" autocomplete="off" onkeyup = "verificarSenha('novasenha','contrasenha','botaosalvar');">
        </div>
        <div class="progress">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
        <div>
            <h4>A senha precisa ter:</h4>
            <hr>
            Comprimento mínimo 8<br>
            Caracter especial<br>
            Letra Maiuscula<br>
            Letra Minuscula<br>
            Número<br>
            <hr>
        </div>
        <div class="col-12 d-flex justify-content-evenly cpcnoprint">
            <button onclick="atualizaCampo('senhaupdate',$('#novasenha').val(),'0','texto',true);" id="botaosalvar" class="btn btn-outline-success btn-sm cpcnoprint" disabled>
                <i class="fa fa-check"></i> Alterar
            </button>
        </div>
    </div>
</div>
