//////////////// Module contrôleur ///////////////// 
// On a besoin de la vue et du modèle
import view from "./view.js";
import model from "./model.js";

// Callback pour la réaction du modèle
function onAnswser(text) {
    // A COMPLETER
    view.update(text);
}

// Callback pour la réaction au click
function onSaluer() {
    // A COMPLETER
    //Lecture du contenu du formulaire
    let input = view.read();
    //Passage du contenu au model
    model.saluer(input, onAnswser);
}

// Attache le controleur au bouton
view.addEventListener(onSaluer);