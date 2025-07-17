/////////////// Partie Modèle //////////////////////
const model = {
    saluer: function (nom,callback) {
        // Crée une query string
        const queryString = new URLSearchParams();
        // Ajoute le parametre nom
        queryString.append('nom', nom);
        // construit l'URL de l'API
        const URL = "public/api/hello.api.php?" + queryString;

        // Lance la demande
        fetch(URL).then(r => {
            if (r.ok && r.status == 200) {
                return r.text();
            } else {
                throw new Error('Erreur serveur', {cause: r});
            }
        }).then(text => callback(text));
    }
};

export default model;