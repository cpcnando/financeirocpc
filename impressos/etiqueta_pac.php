<?php
include __DIR__."/../headermain.php";
include __DIR__."/../sgbd/fatura.php";
if (!isset($_GET['indice'])) $_GET['indice'] = '';
     $sql = "select * from paciente where codigopac =0".$_GET['indice'];
     foreach ($fatura->query($sql) as $rowpaciente) {}
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
        @media print {
        html, body {
            width: 130mm;
            height: 100mm;        
            }
        }
    </style>
    <title>Etiqueta do Paciente</title>
</head>
<body>
    <div class="container-fluid">
      <div class="row">
        <h4>Cód: <?php echo number_format($rowpaciente['CODIGOPAC'],0,'','') ?> - <?php echo $rowpaciente['A_NOME']; ?></h4>
        <h4>Nasc: <?echo date('d/m/Y', strtotime($rowpaciente['NASC'])) ?></h4>
        <h4>Sexo: <?echo $rowpaciente['SEXO']?></h4>
        <h4>Convênio: <?echo $rowpaciente['CONVENIO']?></h4>
        <hr>
      </div>
    </div>
</body>
</html>
