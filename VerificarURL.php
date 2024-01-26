<?php

function checkListStatus($list) {
    // Constrói a URL com os dados fornecidos
    $url = $list['porta'] ? "http://{$list['url']}:{$list['porta']}" : "http://{$list['url']}";
    $url .= "/player_api.php?username={$list['username']}&password={$list['password']}";

    // Faz um GET na URL
    $raw = @file_get_contents($url);

    // Verifica se houve sucesso na requisição e se o username está no JSON
    return ($raw !== false) && (json_decode($raw)->user_info->username ?? false);
}

// Obtém as listas do conteúdo atual do arquivo txt.php
$currentData = file_get_contents("txt.php");
$lists = json_decode($currentData, true) ?: [];

// Filtra as listas que estão funcionando
$activeLists = array_filter($lists, 'checkListStatus');

// Remove duplicatas baseadas na combinação de URL, username e password
$uniqueLists = array_map('unserialize', array_unique(array_map('serialize', $activeLists)));

// Reindexa o array associativo
$uniqueLists = array_values($uniqueLists);

// Converte o array de listas únicas de volta para JSON
$uniqueListsJson = json_encode($uniqueLists, JSON_PRETTY_PRINT);

// Atualiza o arquivo txt.php apenas com as listas únicas
file_put_contents("txt.php", $uniqueListsJson);

// Exibe mensagem sobre as listas ativas
if (!empty($uniqueLists)) {
    $message = "As seguintes listas únicas estão ativas:\n" . implode("\n", array_column($uniqueLists, 'username'));
} else {
    $message = "Nenhuma lista válida está ativa. Por favor, verifique suas configurações.";
}

header("Location: index.html?message=" . urlencode($message));
?>
