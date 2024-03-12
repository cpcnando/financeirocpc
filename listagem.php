<?php
include __DIR__ . "/headermain.php";
// $_SESSION['listagem'] = 'json_pais';
if (isset($_SESSION['listagem'])) {
    $sgbd = null; // Inicialize a variável $sgbd

    if (strpos($_SESSION['listagem'], 'etq') !== false) {
        include __DIR__ . "/sgbd/almoxa.php";
        $sgbd = $almoxa;
        if ($_SESSION['listagem'] == 'etq_cadastro')
            $sql = "SELECT FORNECEDOR AS INDICE, NOME AS DESCRICAO FROM CADASTRO WHERE ATIVO = 'S' ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_fornecedor')
            $sql = "SELECT FORNECEDOR AS INDICE, NOME AS DESCRICAO FROM CADASTRO WHERE ATIVO = 'S' and tipo in ('Fornecedor','Ambos') ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_grupofornec')
            $sql = "SELECT indice AS INDICE, descricao AS DESCRICAO FROM grupofornec ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_cliente')
            $sql = "SELECT FORNECEDOR AS INDICE, NOME AS DESCRICAO FROM CADASTRO WHERE ATIVO = 'S' and tipo in ('Cliente','Ambos') ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_estoque')
            $sql = "SELECT ESTOQUE AS INDICE, A_NOME AS DESCRICAO FROM ESTOQUE WHERE ATIVO = 'S' ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_ccusto')
            $sql = "SELECT CCUSTO AS INDICE, A_NOME AS DESCRICAO FROM CCUSTO WHERE ATIVO = 'S' ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_produto')
            $sql = "SELECT NUMERO AS INDICE, A_NOME AS DESCRICAO FROM PRODUTOS WHERE ATIVO = 'S' ORDER BY 2";
        else if ($_SESSION['listagem'] == 'etq_depto')
            $sql = "SELECT DEPTO AS INDICE, NOME AS DESCRICAO FROM DEPTO ORDER BY 2";

    } else if (strpos($_SESSION['listagem'], 'fin') !== false) {
        include __DIR__ . "/sgbd/financeiro.php";
        $sgbd = $financeiro;
        if ($_SESSION['listagem'] == 'fin_conta') {
            $sql = "SELECT CONTA AS INDICE, A_NOME AS DESCRICAO FROM CONTAS WHERE ATIVO = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fin_departamento') {
            $sql = "SELECT DEPTO AS INDICE, A_NOME AS DESCRICAO FROM DEPARTAMENTO WHERE ATIVO = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fin_custos') {
            $sql = "SELECT CUSTOS AS INDICE, A_NOME AS DESCRICAO FROM CUSTOS WHERE ATIVO = 'S' ORDER BY 2";
        }
    } else if (strpos($_SESSION['listagem'], 'spt') !== false) {
        include __DIR__ . "/sgbd/suporte.php";
        $sgbd = $suporte;

        if ($_SESSION['listagem'] == 'spt_consultor') {
            $sql = "SELECT CODIGO AS INDICE, A_NOME AS DESCRICAO FROM USUARIOS WHERE ATIVO = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'spt_empresa_matrix') {
            $sql = "select EMPRESA_CNPJ AS INDICE, EMPRESA_RAZAOSOCIAL AS DESCRICAO from empresa where empresa_cnpj in ('08216471000143','15178551000621','15178551001512','15178551001198','15178551000117','13927801000572', '03376345000132') ORDER BY 2";
        }    
    
    }else if (strpos($_SESSION['listagem'], 'contabil') !== false) {
        include __DIR__ . "/sgbd/contabil.php";
        $sgbd = $contabil;

        if ($_SESSION['listagem'] == 'contabil_pcr') {
            $sql = "SELECT CODIGO AS INDICE, NOME AS DESCRICAO FROM sped_pcr  ORDER BY 1";
        }    
    
    }else if (strpos($_SESSION['listagem'], 'fat') !== false) {
        include __DIR__ . "/sgbd/fatura.php";
        $sgbd = $fatura;
        if ($_SESSION['listagem'] == 'fat_depto') {
            $sql = "SELECT DEPTO AS INDICE, NOME AS DESCRICAO FROM DEPTO ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_convenio') {
            $sql = "SELECT CONVENIO AS INDICE, A_NOME AS DESCRICAO FROM CONVENIO WHERE LIBERADO = 'N' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_paciente') {
            $sql = "SELECT first 20 CODIGOPAC AS INDICE, A_NOME AS DESCRICAO FROM PACIENTE ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_codigopla') {
            $sql = "SELECT first 20 TIPO AS INDICE, DESCRICAO AS DESCRICAO FROM TIPO ORDER BY 1";
        } else if ($_SESSION['listagem'] == 'fat_tipo') {
            $sql = "SELECT TIPO AS INDICE, DESCRICAO AS DESCRICAO FROM TIPO WHERE ATIVO = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tabhon') {
            $sql = "SELECT NUMERO AS INDICE, DESCRICAO AS DESCRICAO FROM TABELAHON WHERE TIPO = 'H' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tabcbhpm') {
            $sql = "SELECT NUMERO AS INDICE, DESCRICAO AS DESCRICAO FROM TABELAHON WHERE (TIPO = 'H') AND PADRAO in ('5','6','9','T') ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tabtaxa') {
            $sql = "SELECT NUMERO AS INDICE, DESCRICAO AS DESCRICAO FROM TABELAHON WHERE TIPO = 'T' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_moedastab') {
            $sql = "select moedas as indice, a_nome descricao from MOEDASTAB ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tabela') {
            $sql = "SELECT NUMERO AS INDICE, DESCRICAO AS DESCRICAO FROM TABELAHON ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tiss11') {
            $sql = "SELECT CODIGO AS INDICE, DESCRICAO AS DESCRICAO FROM TISS11 ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tiss12') {
            $sql = "SELECT CODIGO AS INDICE, DESCRICAO AS DESCRICAO FROM TISS12 ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_tiss15') {
            $sql = "SELECT CODIGO AS INDICE, DESCRICAO AS DESCRICAO FROM TISS15 ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_profagenda') {
            $sql = "SELECT a_medicos AS INDICE, A_NOME AS DESCRICAO FROM medicos WHERE ativo = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_etnia') {
            $sql = "SELECT ETNIA_CODIGO AS INDICE, ETNIA_DESCRICAO AS DESCRICAO FROM TB_ETNIA ORDER BY 2";                     
        }  else if ($_SESSION['listagem'] == 'fat_profserv') {
            $sql = "SELECT a_medicos AS INDICE, A_NOME AS DESCRICAO FROM medicos WHERE ativo = 'S' ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_grupomed') {
            $sql = "SELECT a_grupom AS INDICE, A_NOMEgrupo AS DESCRICAO FROM GRUPOMED ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_especialidade') {
            $sql = "SELECT codesp AS INDICE, nome AS DESCRICAO FROM especialidade where ativo = 'S' or ativo is null ORDER BY 2";
        } else if ($_SESSION['listagem'] == 'fat_marcaclasse') {
            $sql = "SELECT indice AS INDICE, descricao AS DESCRICAO FROM marcaclasse where ativo = 'S' ORDER BY 2";         
        } else if ($_SESSION['listagem'] == 'fat_empresas') {
            $sql = "SELECT CNPJ AS INDICE, RAZAOSOCIAL AS DESCRICAO FROM EMPRESAS ORDER BY 2";         
        } else if ($_SESSION['listagem'] == 'fat_alas') {
            $sql = "SELECT A_ALA AS INDICE, A_NOME AS DESCRICAO FROM ALAS where a_ativo = 'S' ORDER BY 2";
         }
    }
    if (strpos($_SESSION['listagem'], 'json') !== false) {
        //$configjson = json_decode(file_get_contents('C:\\cpc\\json\\'.$_SESSION['listagem'].'.json'), true);
        $jsonConteudoIso = file_get_contents('C:\\cpc\\json\\'.$_SESSION['listagem'].'.json');
        // Converte a string para UTF-8
        //$jsonConteudoUtf8 = utf8_encode($jsonConteudoIso);
        $jsonConteudoUtf8 = mb_convert_encoding($jsonConteudoIso, 'UTF-8', 'ISO-8859-1');
        // Decodifica o JSON
        $configjson = json_decode($jsonConteudoUtf8, true);
        // $configjson = utf8_encode($configjson2);       
        if ($configjson === null) {
            die('O arquivo de configuração não pode ser lido ou não é um JSON válido.');
        }
        
         if ($configjson !== null)
        foreach ($configjson['lista'] as $lista) {
            echo '<option value="' . iconv("UTF-8",  "ISO-8859-1",$lista['codigo']) . '">' . iconv("UTF-8",  "ISO-8859-1",$lista['nome']) . '</option>';
        }
    }
    else if ($sgbd && $sql) {
        foreach ($sgbd->query($sql) as $rowlistaimpresso) {
            echo '<option value="' . $rowlistaimpresso['INDICE'] . '">' . $rowlistaimpresso['DESCRICAO'] . '</option>';
        }
    }

}
?>