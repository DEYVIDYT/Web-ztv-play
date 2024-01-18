<?php
$usersAndPasswords = [
    [
        "username" => "suspected-TR1-4fUzoS1YHS",
        "password" => "FwUbaVzI6l",
        "url" => "main.xplus2-main.xyz",
        "port" => "2095"
    ],
    [
        "username" => "xplus-2-5m2LRWhwWQ",
        "password" => "TbrPf7Hoh7",
        "url" => "main.xplus2-main.xyz",
        "port" => "2095"
    ],
];


$selectedPairIndex = array_rand($usersAndPasswords);
$selectedPair = $usersAndPasswords[$selectedPairIndex];

$response = [
    "user_info" => [
        "username" => $selectedPair["username"],
        "password" => $selectedPair["password"],
        "message" => "Welcome to Xtream Codes Reborn",
        "auth" => 1,
        "status" => "Active",
        "exp_date" => "1989088881",
        "is_trial" => "0",
        "active_cons" => "2",
        "created_at" => "1668297669",
        "max_connections" => "4",
        "allowed_output_formats" => ["m3u8", "ts", "rtmp"]
    ],
    "server_info" => [
        "url" => $selectedPair["url"],
        "port" => $selectedPair["port"],
        "https_port" => "41002",
        "server_protocol" => "http",
        "rtmp_port" => "41003",
        "timezone" => "Africa\/Cairo",
        "timestamp_now" => time(),
        "time_now" => date("Y-m-d H:i:s")
    ]
];

echo json_encode($response);
?>
