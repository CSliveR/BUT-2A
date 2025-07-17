// Le Data Access Object 
// Il représente l'acces aux données par l'API
// params : une liste de nom et valeurs de paramètres à rechercher (sous la forme d'un objet)
// onAnswser : callback qui est déclanchée à la réception du JSON et qui passe en paramètre l'objet issu du JSON
const dao =
{
  query: function (params, onAnswer) {
    // Crée une query string
    const queryString = new URLSearchParams();
    // parcours l'objet pour récupérer les nom d'attributs et leur valeur
    for (let param in params) {
      // Transforme le nom=valeur en paramètre de la query string
      queryString.append(param, params[param]);
    }
    // construit l'URL de l'API
    const URL = "public/api/contact.api.php?" + queryString;

    // Lance la demande
    fetch(URL).then(r => {
      if (r.ok && r.status == 200) {
        console.log(r);
        return r.json();
      } else {
        throw new Error('Erreur serveur', { cause: r });
      }
    }).then(obj => {
      console.log(obj);
      onAnswer(obj)}
    );
  }
}

export default dao;