#include "EntierContraint.h"
#include <iostream>

using namespace std;

// A COMPLETER
EntierContraint::EntierContraint(): m_min(MIN_DEF), m_max(MAX_DEF), m_val(0) {
    cout << "Un entier contraint par défaut a été crée" << endl;
}

EntierContraint::EntierContraint(int valeur, int min, int max) : m_min(min), m_max(max), m_val(valeur) {
    if(m_val < m_min || m_val > m_max) {
        throw "Entier contraint hors limite";
    }
    cout << "Un entier entre " << min << " et " << max << " a été crée" << endl;
}

int EntierContraint::getMin() const {
    return this->m_min;
}

int EntierContraint::getMax() const {
    return this->m_max;
}

int EntierContraint::getVal() const {
    return this->m_val;
}

void EntierContraint::setVal(int valeur) {
    if(valeur < getMin() || valeur > getMax()) {
        throw "Entier contraint hors limite";
    }
    this->m_val = valeur;
}

void EntierContraint::saisir(istream &entree) {
    int valeur;
    cout << "Entrez une valeur entre " << getMin() << " et " << getMax() << endl;
    entree >> valeur;
    setVal(valeur);
}

void EntierContraint::afficher(ostream &sortie) const{
    sortie << this->getVal() << " est contraint sur l'intervalle [" << this->getMin() << "," << this->getMax() << "]" << endl;
}



