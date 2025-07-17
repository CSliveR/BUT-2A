#include <iostream>
#include "BilletReduit.h"
using namespace std;

// A COMPLETER
BilletReduit::BilletReduit(const Trajet &unTrajet, const Tarif &unTarif, const Promotion &unePromo):
Billet(unTrajet, unTarif), m_promotion(unePromo)
{
}

Promotion BilletReduit::getPromotion() const {
    return this->m_promotion;
}

float BilletReduit::getPrix() const override{
    return this->getPromotion().calculePrixReduit(Billet::getPrix());
}

ostream& operator<<(ostream &sortie, const BilletReduit &billetReduit){
    sortie << "Trajet: " << billetReduit.getTrajet() << "\n";
    sortie << "Tarif: " << billetReduit.getTarif() << "\n";
    sortie << "Prix: " << billetReduit.getPrix() << " euros\n";
    sortie << "Promo: " << billetReduit.getPromotion() << endl;
    return sortie;
}



