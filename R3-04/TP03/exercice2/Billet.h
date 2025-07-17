#ifndef BILLET_H
#define BILLET_H

#include <iostream>
#include <iomanip>

#include "Trajet.h"
#include "Tarif.h"

class Billet {
// A COMPLETER
public:
    Billet(const Trajet &unTrajet, const Tarif &unTarif);
    virtual ~Billet() = default;
    Trajet getTrajet() const;
    Tarif getTarif() const;
    virtual float getPrix() const;

private:
    const Trajet &m_trajet;
    const Tarif &m_tarif;
};
std::ostream &operator<<(std::ostream &sortie, const Billet &billet);
#endif