// Module de la vue 
// Les éléments DOM 
const button = document.getElementsByTagName("button")[0];  // le bouton du formulaire
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////
const input = document.getElementsByTagName("input")[0];
const output = document.getElementsByTagName("output")[0];

const view = {
    // Lire le contenu de la vue
    read: function () {
        // A COMPLETER
        return input.value;
    },
    // Met à jour la vue
    update: function (out) {
        // A COMPLETER
        output.textContent = out;
    },
    // Accrocher une fonction callback à un événement click du bouton de la vue
    addEventListener: function (callback) { button.addEventListener("click", callback) }
}

export default view;