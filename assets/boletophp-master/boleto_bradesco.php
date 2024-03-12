<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<meta http-equiv="CONTENT-LANGUAGE" content="Portuguese" /><!-- Linguagem --> 
<meta name="copyright" content="CPC Brasil Sistemas" /><!-- Direitos --> 
<meta name="title" content="CPC Brasil Sistemas" /><!-- titulo --> 
<meta name="author" content="CPC Brasil Sistemas" /><!-- autor --> 
<meta name="description" content="CPC Brasil Sistemas" /><!-- descricao--> 
<meta name="keywords" content="CPC Brasil Sistemas" /><!-- palavra-chave --> 
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../img/favicon.svg" type="image/x-icon">
<style type=text/css>
<!--.cp {  font: bold 10px Arial; color: black}
<!--.ti {  font: 9px Arial, Helvetica, sans-serif}
<!--.ld { font: bold 15px Arial; color: #000000}
<!--.ct { FONT: 9px "Arial Narrow"; COLOR: #000033}
<!--.cn { FONT: 9px Arial; COLOR: black }
<!--.bc { font: bold 20px Arial; color: #000000 }
<!--.ld2 { font: bold 12px Arial; color: #000000 }
--></style> 
<TITLE>Boleto Banc�rio</TITLE>
</head>

<BODY text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0>
<?php
    include __DIR__."/../../headermain.php";
    include __DIR__."/../../sgbd/financeiro.php";
    include __DIR__."/../../sgbd/fatura.php";
    include __DIR__."/../../sgbd/almoxa.php";
    $_SESSION['ACESSO'] = 'Cadastro de Contas a Receber';
    include __DIR__."/../../sgbd/acesso.php";

// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa			       	  |
// | 																	                                    |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Bradesco: Ramon Soares						            |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$sql = "select numerocpr, clifor, valor, vencimento, historico from cpr1 where numerocpr =".$_SESSION['BOLETO']." and tipo = 'R'";
foreach ($financeiro->query($sql) as $rowcpr){}

$sql = "select nome,cgc, endereco, cidade,uf, cep from cadastro where fornecedor =".$rowcpr['CLIFOR'];
foreach ($almoxa->query($sql) as $rowcadastro){}

$sql = "select a_nome1, a_agencia, digitoconta, carteira, codbanco from contas where conta = 6";
foreach ($financeiro->query($sql) as $rowconta){}

$sql = "select first 1 razaosocial,endereco,cidade,cep,uf,email,cnpj from empresas";
foreach ($fatura->query($sql) as $rowempresa){}

$dias_de_prazo_para_pagamento = 0;
$taxa_boleto = 0;
$data_venc = date("d/m/Y", strtotime($rowcpr['VENCIMENTO']) + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
$valor_cobrado = number_format($rowcpr["VALOR"],2,',',''); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $rowcpr['NUMEROCPR'];  // Nosso numero sem o DV - REGRA: M�ximo de 11 caracteres!
$dadosboleto["numero_documento"] = $dadosboleto["nosso_numero"];	// Num do pedido ou do documento = Nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
$dadosboleto["valor_boleto_desc"] = number_format($valor_cobrado+$taxa_boleto, 2, ',', '.'); 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $rowcadastro['NOME'];
$dadosboleto["endereco1"] = $rowcadastro['ENDERECO'];
$dadosboleto["endereco2"] = $rowcadastro['CIDADE']." - ".$rowcadastro['UF']." -  CEP: ".$rowcadastro['CEP'];

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = $rowcpr['HISTORICO'];
$dadosboleto["demonstrativo2"] = "";
$dadosboleto["demonstrativo3"] = "Emitiido por CPC - Financeiro - https://www.cpcbrasil.com";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% ap�s o vencimento + Juros de 0,3% ao dia";
$dadosboleto["instrucoes2"] = "- Receber at� 10 dias ap�s o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de d�vidas entre em contato conosco: financeiro@cpcbrasil.com";
$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema CPC - Financeiro www.cpcbrasil.com";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "001";
$dadosboleto["valor_unitario"] = number_format($valor_cobrado+$taxa_boleto, 2, ',', '.');
$dadosboleto["aceite"] = "";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DS";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - Bradesco
$dadosboleto["agencia"] = $rowconta['A_AGENCIA']; // Num da agencia, sem digito
$dadosboleto["agencia_dv"] = "0"; // Digito do Num da agencia
$dadosboleto["conta"] = $rowconta['A_NOME1']; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = $rowconta['DIGITOCONTA']; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - Bradesco
$dadosboleto["conta_cedente"] = $rowconta['A_NOME1']; // ContaCedente do Cliente, sem digito (Somente N�meros)
$dadosboleto["conta_cedente_dv"] = $rowconta['DIGITOCONTA']; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = $rowconta['CARTEIRA'];  // C�digo da Carteira: pode ser 06 ou 03

// SEUS DADOS
$dadosboleto["identificacao"] = $rowempresa['RAZAOSOCIAL'];
$dadosboleto["cpf_cnpj"] = $rowempresa['CNPJ'];
$dadosboleto["endereco"] = $rowempresa['ENDERECO'];
$dadosboleto["cidade_uf"] = $rowempresa['CIDADE']."/".$rowempresa['UF'];
$dadosboleto["cedente"] = $rowempresa['RAZAOSOCIAL'];

// N�O ALTERAR!
include("include/funcoes_bradesco.php");
include("include/layout_bradesco.php");
?>
