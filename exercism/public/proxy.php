<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://viacep.com.br/ws/06823-240/json/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false, // Desabilita a verificação do certificado SSL
));

$response = curl_exec($curl);
curl_close($curl);

if ($response === false) {
    // Tratar erros de requisição cURL
    $error = curl_error($curl);
    echo "cURL error: " . $error;
} else {
    // Processar a resposta da requisição
    echo $response;
}
?>
