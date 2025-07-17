// Définition des paramètres de la vue 
const view = {
    // Toutes les boites td de la classe delete
    deleteButtons: document.querySelectorAll('td.delete'),
    // Methode qui retourne un id de la liste à partir d'une ligne DOM (tr)
    getIdFromRow: function(tr) {
        input = tr.querySelector('input[name="id"]');
        return input.value;
    },
    // Methode qui supprime la ligne du tableau, un objet DOM tr 
    deleteRow: function(tr) {
        // Récupère le parent
        let parent = tr.parentElement;
        // Demande au parent de supprimer cet element
        parent.removeChild(tr);
    }
};
