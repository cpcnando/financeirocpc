<?
include "headermain.php";
session_unset();
include "configjson.php";
include "sgbd/fatura.php";

date_default_timezone_set('America/Bahia');
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <?  include "scriptheaderlogin.php" ?>
<style>
.cpc-login-image {
    float: left;
    width: 683px;
    height: 100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.cpc-login-form {
    float: right;
    width: calc(100% - 683px);
    height: 100vh;
    text-align: center;
    padding: 58.81px 86.81px;
    position: relative;
    background: #F8F8F8;
    display: table;
}    


@media screen and (max-width: 1058px) {
    .cpc-login-image{
       display:none;
    }
    .cpc-login-form{
        width:100%;
        padding: 40px 57px;
        padding-bottom: 99px;
        min-width: inherit;
    } 
}


.titulo {
    color: #138898;
    font-size: 25px;
    line-height: 29px;
    border-bottom: 22px;
    font-family: 'Ubuntu-Bold';
    border-bottom: 1px solid rgb(112 112 112 / 22%);
    padding-bottom: 22px;
    margin-bottom: 31px;
}

</style>
</head>
<body style="overflow: hidden;">
<form method="post" action="." name="login" id="login">
    <div class="cpc-login-image" style="background-image:url(images/bg-login.png);"></div>
    <div class="cpc-login-form d-flex flex-column justify-content-around">
        <div><img src="images/logo.svg" alt="logo empresa CPC"></div>
        <div class="titulo-login">
            <h4 class="titulo">Credenciais de acesso</h4>
        </div>
        <div class="d-flex flex-column justify-content-around" style="min-height:200px">
            <input type="text" name="username" id="username" placeholder="Cód Login" class="form-control" required>
            <input type="password" name="password" placeholder="Digite a senha"  class="form-control" required>
            <div class="form-floating">
                <select name="sistema" id="id_select" class="form-control" onchange="localStorage.setItem('sistemalogin',document.getElementById('id_select').value);">
                    <option value="10">Suporte</option>
                    <? if (($_SESSION['config']['dev'] == 'S') ||
                        isset($_GET['cpcsistemas'])) {
                            $sql = "select * from sistema where sistema_ativo ='S' and sistema_indice > 10";
                            foreach ($fatura->query($sql) as $rowsistema) {
                             echo '<option value="'.$rowsistema['SISTEMA_INDICE'].'">'.$rowsistema['SISTEMA_TITULO'].'</option>';
                            }}
                             ?>
                    <!-- <option value="20">Sapi</option>
                    <option value="90">Atende</option>
                    <option value="40">Financeiro</option>
                    <option value="50">Estoque</option>
                    <option value="60">Laudos</option>
                    <option value="65">Pacs</option>
                    <option value="70">Contabil</option>
                    <option value="80">Patrimonio</option>
                    <option value="30">Agenda/WhatsApp</option> -->
                </select>
                <label for="id_select">Sistema</label>
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <button id="loginsubmit" type="submit" class="btn btn-primary">Acessar</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
        </div>
        <p class="text-end">Versão <? echo $_SESSION['config']['versao']; ?></P>
    </div>
</form>
<script>
    if (localStorage.getItem('sistemalogin') != ''){
      document.getElementById('id_select').value = localStorage.getItem('sistemalogin');
    }
    document.getElementById("username").focus();
document.querySelector('select').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        document.getElementById("loginsubmit").click();
    }
});
    
</script>

</body>
</html>