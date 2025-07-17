#ifndef FICHIER_H
#define FICHIER_H
#include "Element.h"

class Fichier : public Element {
    // à compléter
public:
    Fichier(const std::string &nom, unsigned int taille, const std::string &dateModification, const Usager &proprietaire);
    unsigned int getTaille() const override;
    void afficher() const override;
    void ajouter(Element *element) override;
private:
    unsigned int m_taille; //Taille du fichier en Kilo-octets.
};

#endif /* FICHIER_H */

