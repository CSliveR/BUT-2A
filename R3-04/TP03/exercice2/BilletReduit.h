#ifndef BILLETREDUIT_H
#define BILLETREDUIT_H

#include "Billet.h"
#include "Promotion.h"

class BilletReduit : public Billet {
// A COMPLETER
public:
    BilletReduit(const Trajet &unTrajet, const Tarif &unTarif, const Promotion &unePromo);
    Promotion getPromotion() const;
    float getPrix() const override;
private:
    const Promotion &m_promotion;
};
std::ostream &operator<<(std::ostream &sortie, const BilletReduit &billetReduit);
#endif