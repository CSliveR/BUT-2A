// Classe du modèle coté client 
import dao from "./dao.js";

class Contact {
  id;     // Identifiant unique. ATTENTION: à laisser gérer par la BD
  nom;    // Nom du contact
  prenom; // Prénom du contact
  mobile; // No de téléphone mobile

  // Constructeur
  // Si le premier paramètre est déjà un objet, on l'utilise à la place de this
  constructor(prenom_obj = '', nom = '', mobile = 0) {
    if (typeof prenom_obj == 'object') {
      Object.assign(this, prenom_obj)
    } else {
      this.id = -1; // Indique que cet objet n'est pas (encore) dans la BD
      this.prenom = prenom;
      this.nom = nom;
      this.mobile = mobile;
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD au travers de l'API
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////


  /////////////////////////// READ /////////////////////////////////////

  // Acces à un Contact connaissant son nom, il peut y en avoir plusieurs, ou aucun
  // Si le contact n'est pas trouvé, le tableau en retour est vide
  // nom : le nom de la personne à trouver
  // onAnswer: la fonction callback qui reçoit une liste de Contacts 
  static read(nom, onAnswser) {
    const params = {
      'action': 'read',
      'nom': nom
    }
    dao.query(params,
      function (answer) {
        // Donne le bon type à tous les contacts
        const list = [];
        // Cas d'erreur 
        if ('error' in answer) {
          alert("Error: " + answer.error);
        } else {
          for (let contact of answer.contacts) {
            list.push(new Contact(contact));
          };
          // Appel de la callback avec la liste des objets
          onAnswser(list);
        }
      }
    );
    // Fin de read
  }

  // Accès à une liste de contacts étant donné une séquence de caractères
  static readLike(pattern, onAnswser) {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    //  Fin de readLike
  }
}

export default Contact;