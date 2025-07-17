#include "Element.h"
#include <iostream>
#include <ostream>
using namespace std;
// à compléter
Element::Element(const string &nom, const Usager &proprietaire, const string& dateModification):
m_nom(nom), m_proprietaire(proprietaire), m_dateModification(dateModification){
}

const string& Element::getNom() const {
    return this->m_nom;
}

void Element::setNom(const string &nom) {
    this->m_nom = nom;
}

const Usager& Element::getPropretaire() const {
    return this->m_proprietaire;
}

void Element::setPropretaire(const Usager &proprietaire){
    this->m_proprietaire = proprietaire;
}

const std::string& Element::getDateModification() const{
    if(this->m_dateModification.empty()) {
        return "1970-01-01";
    }
    return this->m_dateModification;
}

void Element::setDateModification(const std::string &dateModification){
    this->m_dateModification = dateModification;
}














