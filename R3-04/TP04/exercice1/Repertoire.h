#ifndef REPERTOIRE_H
#define REPERTOIRE_H
#include<vector>
#include "Element.h"
#include "Fichier.h"

class Repertoire : public Element {
    // à compléter
    static const std::string DATE_DEFAUT;
public:
    Repertoire(const std::string &nom, const Usager &proprietaire);
    unsigned int getTaille() const override;
    const std::string& getDateModification() const override;
    void afficher() const override;
    void ajouter(Element *element) override;
private:
    std::vector<Element*> m_contenu; //Contenu du Répertoire courant (peut contenir des fichiers ou d'autres répertoires enfants).
};



#endif /* REPERTOIRE_H */

