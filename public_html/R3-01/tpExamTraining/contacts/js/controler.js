// Action de rechercher dans la BD 
function onDelete(e) {
    // Récupération de l'entrée
    let td = e.target;
     // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
}

// Parcourt la table pour attacher le bouton
for (let i = 0; i < view.deleteButtons.length; i++) {
    view.deleteButtons[i].onclick = onDelete;
}