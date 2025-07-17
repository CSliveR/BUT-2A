#include "Parametres.h"

int main() {
    // Afficher les paramètres initiaux
    // à compléter
    const Parametres &params = Parametres::getInstance();
    params.afficher();
    // // Instancier un thème intitulé "Urbain" et l'associer aux paramètres
    // à compléter
    const Theme urbainTheme("Urbain");
    Parametres::getInstance().setTheme(urbainTheme);
    // Instancier un joueur nommé "Yoloutre" et l'associer aux paramètres
    // à compléter
    const Joueur* player = new Joueur("Yoloutre");
    Parametres::getInstance().setJoueur(player);
    // Afficher les nouveaux paramètres
    // à compléter
    params.afficher();
    delete player;
    return 0;
}

/////// TRACE ATTENDUE //////////////////////////////////
//
// Paramètres { Theme: 'Par Défaut', Joueur: 'Anonyme' }
// Paramètres { Theme: 'Urbain', Joueur: 'Yoloutre' }
//
/////////////////////////////////////////////////////////