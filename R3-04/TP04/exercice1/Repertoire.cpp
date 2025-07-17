#include "Repertoire.h"
#include <iostream>
using namespace std;

const string Repertoire::DATE_DEFAUT = "1970-01-01";
// à compléter
Repertoire::Repertoire(const std::string &nom, const Usager &proprietaire):
Element(nom, proprietaire, DATE_DEFAUT){
}

unsigned int Repertoire::getTaille() const {
    unsigned int contentSize = 0;
    for(const Element *element : this->m_contenu) {
        contentSize += element->getTaille();
    }
    return 4 + contentSize;
}

const string& Repertoire::getDateModification() const {
    const string *mostRecentDate = &DATE_DEFAUT;
    for(const Element *element : this->m_contenu) {
        if(element->getDateModification() > *mostRecentDate) {
            mostRecentDate = &element->getDateModification();
        }
    }
    return *mostRecentDate;
}

void Repertoire::afficher() const {
    cout << "Nom : " << this->getNom() << " - Propriétaire : " << this->getPropretaire().getLogin() << "(" <<
    this->getPropretaire().getGroupe() << ")" << " - Taille : " << this->getTaille() << " Ko - Date : " <<
    this->getDateModification() << endl;
    for(const Element *element : this->m_contenu) {
        element->afficher();
    }
}


void Repertoire::ajouter(Element *element) {
    this->m_contenu.push_back(element);
}




