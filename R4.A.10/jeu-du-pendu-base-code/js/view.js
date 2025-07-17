/**
 * Enumération contenant les IDs des 3 éléments de la page
 * qui correspondent aux 3 types de messages.
 * (À NE PAS MODIFIER !)
 */
export const MESSAGE_TYPES = {
  warning: "message_avertissement",
  lost: "message_perdu",
  win: "message_gagne",
};

/**
 * Objet correspondant à la Vue.
 */
export const view = {
  /**
   * Champ texte contenant les indices sur le mot à deviner (la Zone mot).
   */
  word_input: document.querySelector('#zone_mot'),

  /**
   * Champ texte contenant les lettres déjà utilisées (la Zone essais).
   */
  used_letters_input: document.querySelector('#zone_essais'),

  /**
   * Champ numérique contenant le nombre d'erreurs encore permises.
   */
  allowed_errors_input: document.querySelector('#nb_erreurs_permises'),

  /**
   * Bouton permettant de lancer une partie.
   */
  new_game_btn: document.querySelector('#bouton_nouvelle_partie'),

  /**
   * Collection des boutons représentant le clavier virtuel intégré à la page.
   * (Tous les boutons avec la classe "lettre")
   */
  letters_btns: document.querySelector('.lettre'),

  /**
   * Élément <span> affichant le score actuel du joueur.
   */
  score_span: document.querySelector('.info'),

  /**
   * Met à jour la vue à partir du modèle.
   * @param {Game} game : Modèle du jeu du pendu
   */
  updateFrom(game) {
    // TODO Compléter en Partie 1 ...
    if(game._wordToGuess != null){
      this.word_input.value = game._displayedWord;
      this.used_letters_input.value = game._usedLetters;
      this.allowed_errors_input.value = game._nbErrorsAllowed;

      if(game._nbErrorsAllowed < 3 ){
        this.allowed_errors_input.classList.add('warning');
      }else{
        this.allowed_errors_input.classList.remove('warning');
      }
    }else{
      this.word_input.value = "";
      this.used_letters_input.value = "";
      this.allowed_errors_input.value = "";
    }

    this.score_span.textContent = game._score;
  },

  /**
   * Cache tous les messages de la page.
   * (Fonction fournie. À NE PAS MODIFIER.)
   */
  hideMessages() {
    for (let msgId of Object.values(MESSAGE_TYPES)) {
      document.getElementById(msgId).classList.add("cache");
    }
  },

  /**
   * Affiche un message à l'utilisateur.
   * (Fonction fournie. À NE PAS MODIFIER.)
   * @param {string} msg : Message à afficher.
   * @param {string} type : Type du message à afficher.
   */
  displayMessage(msg, type = MESSAGE_TYPES.warning) {
    let msgElmt = document.getElementById(type);
    if (msgElmt) {
      msgElmt.innerHTML = msg;
      msgElmt.classList.remove("cache");
    }
  },

  /**
   * Demande à l'utilisateur de choisir entre OK (oui) et Annuler (non).
   * (Fonction fournie. À NE PAS MODIFIER.)
   * @param {string} msg : Message à afficher.
   * @returns {boolean} Vrai si l'utilisateur à cliquer sur "OK"
   */
  askIfYesOrNo(msg) {
    return confirm(msg);
  },
};
