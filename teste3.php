<?php
include "sgbd/suporteteste.php";
if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from paciente where codigopac =0".$_GET['indice'];
     foreach ($fatura->query($sql) as $rowpaciente) {}
     $sql2 = "select first 1 * from empresas ";
     foreach ($fatura->query($sql2) as $rowempresa) {}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
#titulo {
  text-align: center;
}

.header img {
  vertical-align: middle;
}

.header h2 {
  display: inline-block;
  vertical-align: top;
  margin-left: 5px;
}

.header p {
  display: block;
  margin-left: 10px;
}

.card {
  border: solid 2px #888;
  border-collapse: collapse;
}

.container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}

.enderecamento {
  grid-column: 1 / span 2; /* Ocupa as duas colunas */
}

.container p,
.enderecamento p {
  border: none;
  padding: 5px;
  margin: 0;
}
</style>
</head>
<body id="conteudo">
    <button onclick="Imprimir('teste4.php','imp')" id="imp">imp</button>
    <!-- <button id="btn_imp" onclick="Imprimir('conteudo', 'btn_imp')">imprimir</button> -->
    <div class="header"><img src="img/logo.svg" alt=""><h2 style="text-align: center;"><?php echo $rowempresa['RAZAOSOCIAL']?></h2><p>Endereco: <?php echo $rowempresa['ENDERECO']?></p><p>Cidade: <?php echo $rowempresa['CIDADE']?></p><p>CNPJ: <?php echo $rowempresa['CNPJ']?></p><hr><h3 id="titulo">Ficha de Identificacao</h3></div>
    <div id="tabela">
        <div class="card " >    
            <!-- Informações Pessoais -->
            <p><strong>Nome:</strong> <?php echo $rowpaciente['A_NOME']; ?></p>
            <p><strong>Convenio:</strong> <?php echo $rowpaciente['CONVENIO']; ?></p>
            <p><strong>Matricula:</strong> <?php echo $rowpaciente['MATRICULA']; ?></p>
            <p><strong>Nome do Pai:</strong> <?php echo $rowpaciente['PAI']; ?></p>
            <p><strong>Nome da Mae:</strong> <?php echo $rowpaciente['MAE']; ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo $rowpaciente['NASC']; ?></p>
            <p><strong>Estado Civil</strong> <?php echo $rowpaciente['SEXO']; ?></p>
            <p><strong>Naturalidade</strong> <?php echo $rowpaciente['NATURALIDADE']; ?></p>
            <p><strong>Responsavel</strong> <?php echo $rowpaciente['RESPONSAVEL']; ?></p>
            <p><strong>RG:</strong> <?php echo $rowpaciente['IDENTIDADE']; ?></p>            
            <p><strong>CPF:</strong> <?php echo $rowpaciente['A_CPF']; ?></p>    
            
            <div class="enderecamento">
            <hr>  
                <p><strong>Bairro</strong> <?php echo $rowpaciente['BAIRRO']; ?></p>
                <p><strong>Endereco:</strong> <?php echo $rowpaciente['CIDADE']; ?></p>
                <p><strong>CEP:</strong> <?php echo $rowpaciente['CEP']; ?></p>
                <p><strong>UF:</strong> <?php echo $rowpaciente['UF']; ?></p>
                <p><strong>Telefone:</strong> <?php echo $rowpaciente['TELEFONE']; ?></p>
            </div>
        </div>
    </div>
</body>
<script>
        


</script>
</html>