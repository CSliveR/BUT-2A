////////////////////////////////////////////////////////////////////////////////
// COMPLETEZ CE FICHIER
////////////////////////////////////////////////////////////////////////////////
#include "Parametres.h"
#include <iostream>
using namespace std;

Parametres* Parametres::m_instance = nullptr;

Parametres::Parametres():
m_theme("Par Défaut"), m_joueur(new Joueur("Anomyme")) {
}

Parametres::Parametres(const string &intituleTheme):
m_theme(intituleTheme), m_joueur(new Joueur("Anomyme")) {
}

Parametres& Parametres::getInstance() {
    if(m_instance == nullptr) {
       m_instance = new Parametres("Par Défaut");
    }
    return *m_instance;
}

Theme Parametres::getTheme() const {
    return this->m_theme;
}

void Parametres::setTheme(const Theme &theme) {
    this->m_theme = theme;
}

const Joueur* Parametres::getJoueur() const {
    return this->m_joueur;
}

void Parametres::setJoueur(const Joueur *joueur) {
    this->m_joueur = joueur;
}

void Parametres::afficher() const {
    cout << "Paramètres { Theme: " << this->getTheme().getIntitule() << ", Joueur: " << this->getJoueur()->getPseudo() << " }" << endl;
}

