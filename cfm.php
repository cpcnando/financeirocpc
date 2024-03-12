
<?php


$statusMedico = array(
    'A' => 'Regular',
    'B' => 'Suspens�o parcial permanente',
    'C' => 'Cassado',
    'E' => 'Inoperante',
    'F' => 'Falecido',
    'G' => 'Sem o exerc�cio da profiss�o na UF',
    'I' => 'Interdi��o cautelar - total',
    'J' => 'Suspenso por ordem judicial - parcial',
    'L' => 'Cancelado',
    'M' => 'Suspens�o total tempor�ria',
    'N' => 'Interdi��o cautelar - parcial',
    'O' => 'Suspenso por ordem judicial - total',
    'P' => 'Aposentado',
    'R' => 'Suspens�o tempor�ria',
    'S' => 'Suspenso - total',
    'T' => 'Transferido',
    'X' => 'Suspenso - parcial'
);
$tipoInscricao = array(
    'P' => 'Principal',
    'S' => 'Secund�ria',
    'V' => 'Provis�ria',
    'T' => 'Tempor�ria',
    'E' => 'Estudando M�d. Estrangeiro'
);

if (!isset($_POST['cpf']))  { $dados = '
    <Consultar xmlns="http://servico.cfm.org.br/">
        <crm xmlns="">' . $_POST['crm'] . '</crm>
        <uf xmlns="">' . $_POST['uf'] . '</uf>
        <chave xmlns="">TDBJMO6K</chave>
    </Consultar>
';} else {
    $dados = '    
    <Validar xmlns="http://servico.cfm.org.br/">
      <crm xmlns="">' . $_POST['crm'] . '</crm>
      <uf xmlns="">' . $_POST['uf'] . '</uf>
      <cpf xmlns="">' . $_POST['cpf'] . '</cpf>
      <dataNascimento xmlns="">' . date('d/m/Y', strtotime($_POST['nasc'])) . '</dataNascimento>
      <chave xmlns="">TDBJMO6K</chave>
    </Validar>
';
};

// if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ws.cfm.org.br:8080/WebServiceConsultaMedicos/ServicoConsultaMedicos',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            '.$dados.'
          </soap:Body>
        </soap:Envelope>',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml; charset=utf-8'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // Decodificar o XML usando SimpleXMLElement
    $xml = new SimpleXMLElement($response);
    if (!isset($_POST['cpf']))  {
        // Extrair informa��es necess�rias do XML
        $crm = $xml->xpath('//crm');
        $dataAtualizacao = $xml->xpath('//dataAtualizacao');
        $especialidade = $xml->xpath('//especialidade');
        $nome = $xml->xpath('//nome');
        $situacao = $xml->xpath('//situacao');
        $inscricao = $xml->xpath('//tipoInscricao');
        $uf = $xml->xpath('//uf');

        $situacao = !empty($situacao) ? (string) $situacao[0] : '';
        $inscricao = !empty($inscricao) ? (string) $inscricao[0] : '';
        $espec = !empty($especialidade) ? (string) $especialidade[0] : '';

        // Exibir informa��es
        if (!empty($crm)) {
            echo '{';
                echo '"crm": "' . $crm[0] . '",';
                echo '"data": "' . $dataAtualizacao[0] . '",';
                echo '"especialidade": "' . $espec. '",';
                echo '"nome": "' . $nome[0] . '",';
                echo '"situacao": "' . $statusMedico[$situacao] . '",';
                echo '"tipo": "' . $tipoInscricao[$inscricao] . '",';
                echo '"uf": "' . $uf[0] . '"';
            echo '}';
        } else {
            echo "N�o foi poss�vel obter informa��es do m�dico.<br>";
        }
    } else{
        $status = $xml->xpath('//resultadoConsulta');
        if (!empty($status)) {
            echo '{';
                echo '"resultadoConsulta": "' . $status[0]. '"';
            echo '}';
        } else {
            echo "N�o foi poss�vel obter informa��es do m�dico.<br>";
        }
    }   
}
?>
