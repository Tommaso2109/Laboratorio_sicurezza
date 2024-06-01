// Seleziona il popup e il suo testo
var popup = document.getElementById('popup');
var popupText = document.getElementById('popup-text');

// Seleziona il bottone per chiudere il popup
var popupClose = document.getElementById('popup-close');

// Seleziona l'elemento delle scelte
var choicesElement = document.getElementById('scelte');

// Aggiungi un event listener per chiudere il popup
popupClose.addEventListener('click', function() {
    popup.style.display = 'none';
});

// Inizializza i contatori di piloti e scuderie


var counters = {
    piloti: 0,
    scuderie: 0
};

function handleClick(button, counterName, maxCount) {
    var price = Number(button.getAttribute('data-price'));
    var totalElement = document.getElementById('total');
    var totalText = totalElement.textContent;
    var total = Number(totalText.replace(/[^0-9.-]+/g,""));
    var parentDiv = button.parentElement;

    if (parentDiv.classList.contains('disabled')) {
        total += price;
        parentDiv.classList.remove('disabled');
        parentDiv.classList.remove('clicked');
        counters[counterName]--;
    } else {
        if (price > total) {
            popupText.textContent = "Non hai abbastanza budget per questo acquisto!";
            popup.style.display = 'block';
            return false;
        }
        if (counters[counterName] >= maxCount) {
            popupText.textContent = "Non puoi scegliere più di " + maxCount + " " + counterName + "!";
            popup.style.display = 'block';
            return false;
        }
        total -= price;
        parentDiv.classList.add('disabled');
        parentDiv.classList.add('clicked');
        counters[counterName]++;
    }

    totalElement.textContent = "Budget disponibile: " + total + " $";
    choicesElement.textContent = "Piloti: " + counters.piloti + "/2, Scuderie: " + counters.scuderie + "/1";
    return true;
}


var scuderia = null;
var pilota1 = null;
var pilota2 = null;

document.querySelectorAll('.botton_costo_scuderia').forEach(function(button) {
    button.addEventListener('click', function() {
        handleClick(button, 'scuderie', 1);
        scuderia = this.value; // Salva il valore del pulsante
        console.log(scuderia); // Stampa il valore del pulsante per verificare che sia corretto
    });
});

document.querySelectorAll('.botton_costo_pilota').forEach(function(button) {
    button.addEventListener('click', function() {
        var success = handleClick(button, 'piloti', 2);
        if (success) {
            var value = this.value;

            if (pilota1 === value) {
                pilota1 = null;
            } else if (pilota2 === value) {
                pilota2 = null;
            } else if (pilota1 === null) {
                pilota1 = value;
            } else if (pilota2 === null) {
                pilota2 = value;
            }
        }
    });
});



$('.button-squad').on('click', function(e) {
    e.preventDefault();

    //ALLERT DA LEVARE QUANDO FINITO
    //alert('Scuderia: ' + scuderia + '\nPilota 1: ' + pilota1 + '\nPilota 2: ' + pilota2);

    // Controlla se uno qualsiasi dei dati è null o vuoto
    if (!scuderia || !pilota1 || !pilota2) {
        var popup = document.getElementById('popup');
        var popupText = document.getElementById('popup-text');
        popupText.textContent = 'Per favore, completa tutti i campi.';
        popup.style.display = 'block';
        return;
    }
    else if (counters.scuderie != 1 || counters.piloti != 2) {
        var popup = document.getElementById('popup');
        var popupText = document.getElementById('popup-text');
        popupText.textContent = 'Per favore, completa tutti i campi.';
        popup.style.display = 'block';
        return;
    }
    //! Controllo partita gia iniziata
    var targetDate;
    // Funzione per ottenere la prossima gara dal database
    function getNextRace() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "getNextRace.php", false); // Imposta il terzo parametro su false per rendere la chiamata sincrona
        xhr.send();

        if (xhr.status == 200) {
            targetDate = xhr.responseText;
        }
    }
    getNextRace();
    
        var now = new Date().getTime();
        var targetDateTimestamp = new Date(targetDate).getTime();
        var timeLeft = targetDateTimestamp - now;
        var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        
        if (timeLeft < 0) {
            // Controlla se sono passati tre giorni dalla gara
            var threeDaysAfter = new Date(targetDate);
            threeDaysAfter.setDate(threeDaysAfter.getDate() + 3);
            console.log("Now: " + now + "Tempo Rimanente: " + timeLeft + "Tre giorni rimanenti: "+ threeDaysAfter);
            if (now < threeDaysAfter) {
                var popup = document.getElementById('popup1');
                var popupText = document.getElementById('popup1-text');
                popupText.textContent = 'Non puoi cambiare la squadra se la partita è iniziata.';
                popup.style.display = 'block';
                return;
            }
        }
    

    // Invia i dati al server utilizzando AJAX
    $.ajax({
        type: 'POST',
        url: 'salva.php',
        data: { 
            scuderia: scuderia,
            pilota1: pilota1,
            pilota2: pilota2
        },
        success: function(response) {
            //response = JSON.parse(response.replaceAll(/\s*<.*/gs,""));
            
            // Pulisci la risposta rimuovendo tutto dopo il primo carattere di chiusura graffa
            var cleanResponse = response.substring(0, response.indexOf('}') + 1);

            console.log('Clean server response:', cleanResponse);

            try {
                // Prova a fare il parse della risposta pulita
                response = JSON.parse(cleanResponse);
            } catch (error) {
                // Se c'è un errore nel fare il parse, stampa l'errore
                console.error('Error parsing JSON:', error);
                return;
            }
            if (response.error) {
                var popup = document.getElementById('popup1');
                var popupText = document.getElementById('popup1-text');
                //alert('PopUpText: ' + popupText);
                popupText.textContent = response.error;
                popup.style.display = 'block';
            } else {
                // Gestisci il caso di successo qui
                window.location.href = "pagina_personale.php";
            }
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Questo blocco di codice viene eseguito quando la richiesta AJAX fallisce
            console.log('AJAX error:', textStatus, errorThrown);
        }
    });
});

//NON CAMBIARE ^
/*
function saveTeam(scuderia, pilota1, pilota2) {
    $.ajax({
        type: "POST",
        url: "salva.php",
        data: { scuderia: scuderia, pilota1: pilota1, pilota2: pilota2 },
        dataType: "json", 
        success: function(response) {
            if (response.error) {
                var popup = document.getElementById('popup1');
                var popupText = document.getElementById('popup1-text');
                //alert('PopUpText: ' + popupText);
                popupText.textContent = response.error;
                popup.style.display = 'block';
            } else {
                // Gestisci il caso di successo qui
                window.location.href = "index.php";
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Gestisci gli errori di rete o di server qui
        }
    });
}*/
module.exports = handleClick;