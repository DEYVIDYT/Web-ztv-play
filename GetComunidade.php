<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP to JavaScript</title>
</head>
<body>

<script>
    // URL da API
    const url = "https://z-tv-apps.000webhostapp.com/txt.php";

    // Função para obter dados da URL externa
    async function fetchData() {
        try {
            const response = await fetch(url);
            const jsonData = await response.json();

            // Verificar se o JSON foi obtido com sucesso
            if (!response.ok) {
                console.error("Erro ao obter dados da URL externa.");
                return;
            }

            // Verificar se a array não está vazia
            if (jsonData.length === 0) {
                console.error("A array de usuários e senhas está vazia.");
                return;
            }

            // Selecionar um par de usuário aleatório
            const selectedPairIndex = Math.floor(Math.random() * jsonData.length);
            const selectedPair = jsonData[selectedPairIndex];

            // Adicionar a porta somente se não for null
            const port = selectedPair.porta !== null ? selectedPair.porta : "";

            // Construir a resposta JSON
            const responseJSON = {
                user_info: {
                    username: selectedPair.username,
                    password: selectedPair.password,
                    message: "Bem Vindo a MaisTV",
                    auth: 1,
                    status: "Active",
                    exp_date: "1717470000",
                    is_trial: "0",
                    active_cons: "1",
                    created_at: "1683335323",
                    max_connections: "1",
                    allowed_output_formats: ["m3u8", "ts"]
                },
                server_info: {
                    url: selectedPair.url,
                    port: port,
                    https_port: "",
                    server_protocol: "http",
                    rtmp_port: "",
                    timezone: "America/Sao_Paulo",
                    timestamp_now: Math.floor(Date.now() / 1000),
                    time_now: new Date().toISOString().slice(0, 19).replace("T", " ")
                }
            };

            // Exibir a resposta JSON no console (pode ser removido)
            console.log(responseJSON);
        } catch (error) {
            console.error("Erro na solicitação:", error);
        }
    }

    // Chamar a função ao iniciar a página
    fetchData();
</script>

</body>
</html>
