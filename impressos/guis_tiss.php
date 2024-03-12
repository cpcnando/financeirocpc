<?php
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/fatura.php";
$sql2 = "select first 1 * from empresas ";
foreach ($fatura->query($sql2) as $rowempresa) {}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css5/bootstrap.min.css">
    <style>
        /* Adiciona borda a todas as colunas com a classe .borda-coluna */
      
        *{
            font-family: 'Ubuntu', sans-serif;
        }
        body {
            border: 2px solid #000; /* Adicione a cor desejada substituindo #000 */        
        }
        .header img {
            vertical-align: middle;
        }
        .form-control{
            border: 2px solid #000; /* Adicione a cor desejada substituindo #000 */
            border-radius: 1px;
            
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
        #titulo {
            text-align: center;
        }
        .nome-no-meio {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            color: black;    
            background-color:#ffffff;        
            padding: 0 10px; /* Opcional: adicione algum preenchimento para melhor aparência */
        }
        .linha-com-nome {
            position: relative;
            text-align: center;
        }

    </style>
    <title>Guis TISS Consulta</title>
</head>
<body>
    <div class="header">
        <img src="../img/logo.svg" alt=""><h2 style="text-align: center;"><?php echo $rowempresa['RAZAOSOCIAL']?></h2><p>Endereco: <?php echo $rowempresa['ENDERECO']?></p><p>Cidade: <?php echo $rowempresa['CIDADE']?></p><p>CNPJ: <?php echo $rowempresa['CNPJ']?></p><hr><h3 id="titulo">Guia de Consulta</h3>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Registro ANS</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-4">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Data de Emissao</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-5">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Nome do Convênio</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-4">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Numero da Carteira</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-4">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Plano</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-4">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Validade da Carteira</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-9">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Nome</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Cartão Nacional Saúde</label>
            </div>
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados do Contratado</span>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CPF/CNPJ</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-6">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Contratado</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CNES</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-1">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">T. Log</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-2">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Log - Num - Comple.</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Município</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-1">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">UF</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-2">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Cód. IBGE</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CEP</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Prof. Exucutante</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Conselho Prof.</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-2">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Núm. Conselho</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-1">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">UF</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CBOS</label>
            </div>
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Hipótese Diagnóstica</span>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Tipo Doença</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Tempo de Doença</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Indicação de Acidente</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">COD Principal</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CID(2)</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CID(3)</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">CID(4)</label>
            </div>
            <div class="linha-com-nome">
                <hr>
                <span class="nome-no-meio">Dados do Atend/Procedimento Realizado</span>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Data do Atendimento</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Cód. Tabela</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Cód. Procedimento</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">TIpo Consulta</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-3">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Tipo de Saída</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-12">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Observação</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-6">
                <input type="text" class="form-control" value="12">
                <label class="ms-2">Data e Ass. do Médico</label>
            </div>
            <div class="form-floating mb-2 pe-1 col-6" >
                <input type="text"  class="form-control" value="12">
                <label class="ms-2">Data e Ass. do Beneficiario/Responsavel</label>
            </div>

        </div>
    </div>
</body>
</html>
