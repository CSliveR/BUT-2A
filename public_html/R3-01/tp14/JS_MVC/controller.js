//////////////// Partie Contrôleur /////////////////
// On a besoin de la vue et du modèle
import {view} from "./view.js";
import {model} from "./model.js";


// Gestionnaire d'évènement
function onCalculer() {
  // Récupération de la valeur en entrée
  let input = view.read();
  // Réalisation du calcul par le modèle
  let output = model.compute(input);
  // Sortie du résultat sur la vue
  view.update(output);
}

// Attache le gestionnaire d'évenement à la vue
view.addEventListener(onCalculer);

// Il n'y a rien à exporter