#include "Visage.h"
#include <iostream>
using namespace std;

// A COMPLETER : IMPLEMENTER LES METHODES DE LA CLASSE VISAGE (ET L'OPERATEUR <<)
//Constructeur par défaut
Visage::Visage(int longueurNez, const Ethnie &ethnie) :
m_nez(longueurNez), m_ethnie(ethnie), m_moustache(nullptr), m_chapeau(nullptr) {
/*les attributs m_boutons et m_bijoux n'ont pas besoin d'être initailisés par défaut car ce sont des vecteurs et que le
  constructeur par défaut de la classe vecteur instancie lui-même tous les attributs de type vector*/
}

//Constructeur par recopie
Visage::Visage(const Visage &unVisage) :
m_nez(unVisage.m_nez), m_ethnie(unVisage.m_ethnie), m_boutons(unVisage.m_boutons)
{
    if(unVisage.m_moustache) {
        m_moustache = new Moustache(*unVisage.m_moustache);
    }else {
        m_moustache = nullptr;
    }

    if(unVisage.m_chapeau) {
        m_chapeau = new Chapeau(*unVisage.m_chapeau);
    }else {
        m_chapeau = nullptr;
    }

    for(Bijou* bijou : unVisage.m_bijoux) {
        if(bijou) {
            m_bijoux.push_back(new Bijou(*bijou));
        }
    }
}
//Opérateur d'affectation
Visage& Visage::operator=(const Visage &unVisage) {
    if (this != &unVisage) { // Éviter l'auto-affectation
        // Libérer les ressources existantes
        delete m_moustache;
        delete m_chapeau;
        for (Bijou* bijou : m_bijoux) {
            delete bijou;
        }
        m_bijoux.clear();

        // Copier les nouvelles ressources
        m_nez = unVisage.m_nez;
        m_boutons = unVisage.m_boutons;

        if (unVisage.m_moustache) {
            m_moustache = new Moustache(*unVisage.m_moustache);
        } else {
            m_moustache = nullptr;
        }

        if (unVisage.m_chapeau) {
            m_chapeau = new Chapeau(*unVisage.m_chapeau);
        } else {
            m_chapeau = nullptr;
        }

        for (Bijou* bijou : unVisage.m_bijoux) {
            if (bijou) {
                m_bijoux.push_back(new Bijou(*bijou));
            }
        }
    }
    return *this;
}

//Destructeur
Visage::~Visage() {
    delete m_moustache;
    delete m_chapeau;
    for (Bijou* bijou : m_bijoux) {
        delete bijou;
    }
}

void Visage::setMoustache(int largeur) {
    // Si m_moustache pointe déjà vers un objet, on le supprime pour éviter une fuite de mémoire
    // Cas d'utilisation d'un smart pointer.
    if(m_moustache) {
        delete m_moustache;
    }
    m_moustache = new Moustache(largeur);
}

void Visage::addBouton(int diametre) {
    m_boutons.push_back(Bouton(diametre));
}

void Visage::setChapeau(const Chapeau &unChapeau) {
    // Si m_chapeau pointe déjà vers un objet, on le supprime pour éviter une fuite de mémoire
    // Cas d'utilisation d'un smart pointer.
    if(m_chapeau) {
        delete m_chapeau;
    }
    m_chapeau = new Chapeau(unChapeau);
}

void Visage::addBijou(const Bijou &unBijou) {
    m_bijoux.push_back(new Bijou(unBijou));
}

ostream &operator<<(ostream &sortie, const Visage &visage) {
    sortie << "Attributs du Visage:" << endl;
    sortie << "-" << visage.m_ethnie << endl;
    sortie << "-" << visage.m_nez << endl;
    if(visage.m_moustache != nullptr) {
        sortie << "-" << *visage.m_moustache << endl;
    }else {
        sortie << "-pas de moustache" << endl;
    }
    sortie << "-" << *visage.m_chapeau << endl;
    for (Bouton bouton : visage.m_boutons) {
        sortie << "-" << bouton << endl;
    }
    for (Bijou* bijou : visage.m_bijoux) {
        sortie << "-" << *bijou << endl;
    }
    return sortie;
}