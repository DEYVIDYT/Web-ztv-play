// script.js (ou o nome que preferir)

function processarListas() {
    var urls = document.getElementById('urls').value.split('\n');
    var newLists = [];

    urls.forEach(function (url) {
        if (/^https?:\/\/[^\?]+\?username=.+&password=.+$/.test(url)) {
            var urlParts = new URL(url);
            var queryParams = new URLSearchParams(urlParts.search);

            var key = urlParts.host + queryParams.get('username') + queryParams.get('password');

            newLists[key] = {
                "url": urlParts.host,
                "username": queryParams.get('username'),
                "password": queryParams.get('password'),
                "porta": urlParts.port || null
            };
        } else {
            showMessage("Essa URL não é suportada. Por favor, coloque uma URL no formato m3u.", "error");
            return;
        }
    });

    // Atualizar a mensagem, armazenar os dados ou fazer outras operações necessárias
    showMessage("Obrigado por apoiar o aplicativo Z-TV Play!", "success");
    // Pode ser necessário enviar os dados para o servidor aqui
    // Exemplo: enviarDadosParaServidor(newLists);
}

function showMessage(message, messageType) {
    var messageContainer = document.getElementById('message-container');
    messageContainer.innerHTML = message;
    messageContainer.style.display = 'block';
    messageContainer.style.backgroundColor = messageType === 'success' ? '#32cd32' : '#ff4500';

    setTimeout(function () {
        messageContainer.style.display = 'none';
    }, 5000); // Oculta a mensagem após 5 segundos
}

function getTotalVisitas() {
    // Lógica para buscar e exibir o total de visitas em JavaScript
    // Similar à sua implementação original
}
