#include <iostream>
#include <string>
#include <stdexcept>
#include "Conteneur.h"
#include "Trajet.h"
#include "Tarif.h"
#include "Promotion.h"
#include "Billet.h"
#include "BilletReduit.h"

using namespace std;

void testBillet() {
    const Trajet trajet("Grenoble", "Lyon", 100);
    const Tarif tarif("tarifNormal", 1.0);
    const Billet billet(trajet, tarif);
    cout << billet << endl;
}

void testBilletReduit() {
    const Trajet trajet("Grenoble", "Lyon", 100);
    const Tarif tarif("tarifNormal", 1.0);
    const Promotion promo("Noel", 0.5);
    const BilletReduit billetReduit (trajet,tarif,promo);
    cout << billetReduit << endl;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Billet *newBillet(Conteneur<Trajet> &trajets, Conteneur<Tarif> &tarifs, Conteneur<Promotion> &promotions) {
// A COMPLETER
    cout << "\n-- Liste des Trajets" << endl;
    trajets.afficher();
    cout << "Quel trajet ? ";
    const Trajet *trajet = &trajets.choisir();
    cout << endl;
    cout << "-- Liste des Tarifs" << endl;
    tarifs.afficher();
    cout << "Quel tarif ? ";
    const Tarif *tarif = &tarifs.choisir();
    Billet* billetCree;

    char addPromotion;
    cout << "\nAjouter une promotion O/[N] ? ";
    cin >> addPromotion;
    if(addPromotion != 'N') {
        cout << "\n-- Liste des Promotions" << endl;
        promotions.afficher();
        cout << "Quelle promotion ? ";
        const Promotion *promotion = &promotions.choisir();
        billetCree = new BilletReduit(*trajet,*tarif,*promotion);
        return billetCree;
    }
    billetCree = new Billet(*trajet,*tarif);
    return billetCree;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

int main(int argc, char **argv) {
    // Création des conteneurs de Trajets, TArifs, Promotions
    Conteneur<Trajet> trajets;
    trajets.ajouter(new Trajet("Grenoble", "Lyon", 100));
    trajets.ajouter(new Trajet("Grenoble", "Paris", 600));
    trajets.ajouter(new Trajet("Grenoble", "Marseille", 300));
    Conteneur<Tarif> tarifs;
    tarifs.ajouter(new Tarif("Normal", 2.00));
    tarifs.ajouter(new Tarif("Jeune", 1.00));
    tarifs.ajouter(new Tarif("Vermeil", 3.00));
    Conteneur<Promotion> promotions;
    promotions.ajouter(new Promotion("Noël", 0.5));
    promotions.ajouter(new Promotion("Anniversaire", 0.2));
    // A COMPLETER
    //testBillet();
    //testBilletReduit();
    char addBillet;
    vector<Billet*> billets;
    do {

        cout << "\nAjouter un billet [O]/N ? ";
        cin >> addBillet;

        // Vérification : si l'utilisateur entre 'N', on arrête la boucle
        if (addBillet == 'N' || addBillet == 'n') {
            break; // Sortie de la boucle
        }
        // Si c'est 'O', on ajoute un billet
        if (addBillet == 'O' || addBillet == 'o') {
            cout << "\n----Création d'un billet----";
            cout << endl;
            billets.push_back(newBillet(trajets, tarifs, promotions));
        }
        // Si l'utilisateur entre autre chose que 'O' ou 'N', on affiche un message d'erreur
        else {
            cout << "Entrée invalide. Veuillez entrer 'O' pour ajouter ou 'N' pour arrêter." << endl;
        }
    } while (true);

    cout << "\n----Liste des billets créés----";
    cout << endl;
    int index = 1;
    for(const Billet* billet : billets) {
        cout << index << " - Billet : " << endl;
        cout << *billet << endl;
        delete billet;
        index++;
    }

    return 0;
}

