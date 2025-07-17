// Définition des paramètres de la vue 
// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////
const button = document.getElementsByTagName("button")[0];
const inputHour = document.getElementsByTagName("input")[0];
const outputHour = document.getElementsByTagName("output")[0];
// 

const view = {
    // Lecture de l'entrée
    read: function () {
        ///////////////////////////////////////////////////////
        // A COMPLETER
        ///////////////////////////////////////////////////////
        return inputHour.value;
    },

    // Fonction qui affiche une date dans la balise output
    update: function (time) {
        ///////////////////////////////////////////////////////
        // A COMPLETER
        ///////////////////////////////////////////////////////
        outputHour.textContent = "Fuseau Horaire : " + time.timeZone + " Date et heure : " +  time.date;
    },
    // Accrocher une fonction callback à un événement click du bouton de la vue
    addEventListener: function (callback) {
        ///////////////////////////////////////////////////////
        // A COMPLETER
        ///////////////////////////////////////////////////////

        button.addEventListener("click", callback);
    }
}

export default view;
