<?php
if (isset($_GET['postal_code'])) {
    $postalCode = urlencode($_GET['postal_code']);
    $url = "https://viacep.com.br/ws/{$postalCode}/json/";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false, // Desabilita a verificação do certificado SSL
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response === false) {
        // Tratar erros de requisição cURL
        $error = curl_error($curl);
        echo json_encode(array('error' => 'cURL error: ' . $error));
    } else {
        // Retornar a resposta da requisição
        echo $response;
    }
} else {
    echo json_encode(array('error' => 'CEP não fornecido'));
}
