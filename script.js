// script.js

// Configurar o Firebase
firebase.initializeApp({
  apiKey: 'AIzaSyANbr5y-72LfWpMvHEdT9wf_ycmyMmaDvE',
  authDomain: 'z-tv-play.firebaseapp.com',
  databaseURL: 'https://z-tv-play-default-rtdb.firebaseio.com',
  projectId: 'z-tv-play',
  storageBucket: 'z-tv-play.appspot.com',
  appId: '1:517303830208:web:51a3279d8145cafdbd4f25'
});

var db = firebase.database().ref('LiveDB');

function processarListas() {
    var urls = document.getElementById('urls').value.split('\n');
    var newLists = {};

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

    // Adicionar dados ao Realtime Database
    adicionarDadosAoRealtimeDB(newLists);

    showMessage("Obrigado por apoiar o aplicativo Z-TV Play!", "success");
    getTotalVisitas();
}

function adicionarDadosAoRealtimeDB(newLists) {
    db.push().set(newLists);
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

// Restante do código permanece o mesmo
