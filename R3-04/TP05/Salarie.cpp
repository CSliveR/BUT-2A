#include "Salarie.h"
#include "SalarieException.h"
#include <map>
#include <limits>
#include <string>
#include <iostream>
#include <iomanip>
using namespace std;

// A COMPLETER : Implémenter les méthodes d'instance de la classe Salarie
Salarie::Salarie(const string &nom, const string &numeroSS, const ObjetContraint<float> &salaireMensuel):
m_nom(nom), m_numeroSS(numeroSS), m_salaireMensuel(salaireMensuel){
}

const string& Salarie::getNom() const {
    return this->m_nom;
}

void Salarie::setNom(const string &nom) {
    if(nom.empty()) {
        throw NomIncorrectException();
    }
    this->m_nom = nom;
}

const string& Salarie::getNumeroSS() const {
    return this->m_numeroSS;
}

void Salarie::setNumeroSS(const string &numeroSS) {
    if(numeroSS.size() != 13 || (numeroSS[0] != '1' && numeroSS[0] != '2')) {
        throw NumeroIncorrectException();
    }
    this->m_numeroSS = numeroSS;
}

float Salarie::getSalaireMensuel() const {
    return this->m_salaireMensuel;
}

void Salarie::setSalaireMensuel(float mensuel) {
    try {
        this->m_salaireMensuel = ObjetContraint<float>(mensuel, SMIC, COEFF_SMIC*SMIC);
    }catch(const domain_error&) {
        throw SalaireIncorrectException();
    }
}

float Salarie::getImpot() const {
    const float salaireAnnuel = this->getSalaireMensuel()*12;
    float impot = 0.0f;

    for(const auto &tranche : TRANCHES_IMPOT) {
        if(salaireAnnuel < tranche.first) {
            impot = tranche.second;
            break;
        }
    }
    return impot;
}

void Salarie::saisir(istream &entree) {
    while (true) {
        try {
            string nom;
            cout << "Nom : ";
            entree >> nom;
            this->setNom(nom);
            break;  // Sortie de la boucle si aucune exception n'est levée
        } catch (const NomIncorrectException &ni) {
            cout << ni.what() << endl;;
        }
    }

    while (true) {
        try {
            string numeroSS;
            cout << "Numero SS : ";
            entree >> numeroSS;
            this->setNumeroSS(numeroSS);
            break;  // Sortie de la boucle si aucune exception n'est levée
        } catch (const NumeroIncorrectException &n) {
            cout << n.what() << endl;
        }
    }

    while (true) {
        try {
            float salaireMensuel;
            cout << "Salaire Mensuel : ";
            entree >> salaireMensuel;
            this->setSalaireMensuel(salaireMensuel);
            break;  // Sortie de la boucle si aucune exception n'est levée
        } catch (const SalaireIncorrectException &s) {
            cout << s.what() << endl;
        }
    }
}

void Salarie::afficher(ostream &sortie) const {
    sortie << "Informations Salarié(e) ------------------------------------" << endl;
    sortie << "Nom: " << this->getNom() << endl;
    sortie << "Numero SS: " << this->getNumeroSS() << endl;
    sortie << "Salaire Mensuel: " << this->getSalaireMensuel() << " €" << endl;
    sortie << "Impôt annuel : " << this->getSalaireMensuel()*12*this->getImpot() << " €" << endl;
}

// Constantes de classe
const float                  Salarie::SMIC          = 1257.0f;
const float                  Salarie::COEFF_SMIC    = 500.0f;
const std::string            Salarie::NOM_DEF       = "Martin";
const std::string            Salarie::NUMERO_SS_DEF = "1234567890123";
const std::map<float, float> Salarie::TRANCHES_IMPOT {
    {6000.0f, 0.000f},
    {12000.0f, 0.055f},
    {26600.0f, 0.140f},
    {71400.0f, 0.300f},
    {151200.0f, 0.410f},
    {std::numeric_limits<float>::max(), 0.50f} 
};

