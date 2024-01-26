<?php

// Obter o JSON da URL externa
$url = "https://z-tv-apps.000webhostapp.com/txt.php";
$jsonData = file_get_contents($url);
$usersAndPasswords = json_decode($jsonData, true);

// Verificar se o JSON foi decodificado com sucesso
if ($usersAndPasswords === null && json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Erro ao obter dados da URL externa."]);
    exit;
}

// Verificar se a array não está vazia
if (empty($usersAndPasswords)) {
    echo json_encode(["error" => "A array de usuários e senhas está vazia."]);
    exit;
}

// Selecionar um par de usuário aleatório
$selectedPairIndex = array_rand($usersAndPasswords);
$selectedPair = $usersAndPasswords[$selectedPairIndex];

// Verificar se a chave "porta" está definida e não é null
$port = isset($selectedPair["porta"]) && $selectedPair["porta"] !== null ? $selectedPair["porta"] : "";

// Construir a resposta JSON
$response = [
    "user_info" => [
        "username" => $selectedPair["username"],
        "password" => $selectedPair["password"],
        "message" => "Bem Vindo a MaisTV",
        "auth" => 1,
        "status" => "Active",
        "exp_date" => "1717470000",
        "is_trial" => "0",
        "active_cons" => "1",
        "created_at" => "1683335323",
        "max_connections" => "1",
        "allowed_output_formats" => ["m3u8", "ts"]
    ],
    "server_info" => [
        "url" => $selectedPair["url"],
        // Adicionar a porta somente se não for null
        "port" => $port,
        "https_port" => "",
        "server_protocol" => "http",
        "rtmp_port" => "",
        "timezone" => "America/Sao_Paulo",
        "timestamp_now" => time(),
        "time_now" => date("Y-m-d H:i:s")
    ]
];

// Enviar a resposta JSON
echo json_encode($response);
?>
