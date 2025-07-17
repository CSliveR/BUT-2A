#ifndef VISAGE_H
#define VISAGE_H

#include "AttributsVisage.h"
#include <vector>

// A COMPLETER (spécifiez les attributs)

class Visage {
public:
    /*--------------------------------*/
    /*Forme canonique de Coplien*/
    Visage(int longueurNez, const Ethnie &ethnie); //constructeur par défaut
    Visage(const Visage &unVisage); //constructeur par recopie
    Visage& operator=(const Visage &visage); //opérateur d'affectation
    ~Visage(); //destructeur
    /*--------------------------------*/
    void setMoustache(int largeur);
    void addBouton(int diametre);
    void setChapeau(const Chapeau &unChapeau);
    void addBijou(const Bijou &unBijou);

    // fonction amie : aura accès aux attributs "private" de la classe Visage (pour éviter d'écrire les getters)
    // attention ce n'est pas une méthode !
    friend std::ostream &operator<<(std::ostream &sortie, const Visage &visage);

private:
    // A COMPLETER : CODEZ CORRECTEMENT LES COMPOSITIONS ET AGREGATIONS
    Nez m_nez;
    const Ethnie &m_ethnie;
    Moustache *m_moustache;
    std::vector<Bouton> m_boutons;
    Chapeau *m_chapeau;
    std::vector<Bijou*> m_bijoux;
};

#endif /* VISAGE_H */

