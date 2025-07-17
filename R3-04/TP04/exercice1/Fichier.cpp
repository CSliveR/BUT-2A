#include "Fichier.h"
#include <iostream>
#include <stdexcept>
using namespace std;

// à compléter
Fichier::Fichier(const string &nom, unsigned int taille, const string &dateModification, const Usager &proprietaire):
Element(nom, proprietaire, dateModification), m_taille(taille){
}

unsigned int Fichier::getTaille() const {
    return this->m_taille;
}

void Fichier::afficher() const {
    cout << "Nom : " << this->getNom() << " - Propriétaire : " << this->getPropretaire().getLogin() << "(" <<
    this->getPropretaire().getGroupe() << ")" << " - Taille : " << this->getTaille() << " Ko - Date : " <<
    this->getDateModification() << endl;
}

void Fichier::ajouter(Element *element) {
    throw logic_error("Impossible d'ajouter un élément à un fichier.");
}

