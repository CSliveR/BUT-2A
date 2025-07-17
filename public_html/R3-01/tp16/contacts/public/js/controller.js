// Action de rechercher dans la BD 
import view from "./view.js";
import Contact from "./contact.js"; // Le modèle

function onRechercher() {
    // Récupération de l'entrée
    const pattern = view.read();
    // Si le pattern est vide alors vide le tableau
    if (pattern == '') {
        view.update([]);
    } else {
        // passe le pattern à la vue
        Contact.readLike(pattern, function (contacts) {
            view.update(contacts);
        });
    }
}

// Attache le controleur au bouton
// Lance le controleur pour chaque nouveau caractères tapés
view.addEventListener(onRechercher);