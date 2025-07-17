//////////////// Partie Contrôleur /////////////////
// On a besoin de la vue et du modèle
import {view} from "./view.js";
import {model} from "./model.js";

// Gestionnaire d'évènement
function onRandomNumber() {
    const max = 6;
    // Réalisation du calcul par le modèle
    let output = model.randomNumber(max);
    // Sortie du résultat sur la vue
    view.update(output);
}

// Attache le gestionnaire d'évenement à la vue
view.addEventListener(onRandomNumber);