// Import des modules nécessaires
import { Game } from './game.js';
import { MESSAGE_TYPES, view } from './view.js';

// Initialisation du modèle
let game = new Game();

// Cache tous les messages au départ
view.hideMessages();

// TODO Compléter en Partie 3 ...

// MàJ de la vue à partir du modèle
/* (À faire à chaque fois pour éviter qu'au rafraichissement
  de la page, le navigateur affiche les informations présentes
  dans son "cache" alors que celles-ci ne sont pas cohérentes
  avec le modèle) */
view.updateFrom(game);

view.new_game_btn.addEventListener('click', () => {
  view.hideMessages();
  try{
    game.launchNewGame();
    view.updateFrom(game);
  }catch(e){
      view.displayMessage(e);
  }
});
