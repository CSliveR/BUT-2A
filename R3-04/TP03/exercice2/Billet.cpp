#include <iostream>
#include "Billet.h"
#include "BilletReduit.h"
using namespace std;
// A COMPLETER
Billet::Billet(const Trajet &unTrajet, const Tarif &unTarif) :
m_trajet(unTrajet), m_tarif(unTarif)
{
}

Trajet Billet::getTrajet() const {
    return this->m_trajet;
}

Tarif Billet::getTarif() const {
    return this->m_tarif;
}

float Billet::getPrix() const {
    return this->getTarif().getPrixAuKm()*static_cast<float>(this->getTrajet().getDistance());
}

ostream& operator<<(ostream &sortie, const Billet &billet){
    sortie << "Trajet: " << billet.getTrajet() << "\n";
    sortie << "Tarif: " << billet.getTarif() << "\n";
    sortie << "Prix: " << billet.getPrix() << " euros\n";
    return sortie;
}
