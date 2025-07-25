#ifndef _LISTE_CHAINEE_TRIEE
#define _LISTE_CHAINEE_TRIEE

#include "Shared/ListeTrieeInterface.h"
#include "Shared/Cellule.h"
#include "Shared/PrecondVioleeExcep.h"

using namespace std;

template<class TypeInfo>
class ListeTrieeChainee : public ListeTrieeInterface<TypeInfo> {
private:
    Cellule<TypeInfo>* ptrTete; // Pointeur sur la première cellule de la liste
    int nbCellules; // nombre courant de cellules dans la liste

    // Returne un pointeur sur une copie de la listeChaineeOriginale
    Cellule<TypeInfo>* copieListe(const Cellule<TypeInfo>* laListeOriginale);

    /**
     * Worker récursif d'insertion de nouvelleInfo dans ptrCetteListe
     * @pre ptrCetteListe est triée avant insertion
     * @post ptrCetteListe est triée après insertion
     * @param ptrCetteListe : pointeur (donnée-référence) sur la "liste" de cellules dans laquelle insérer
     * @param nouvelleInfo : valeur à insérer
     */
    void insereRecWorker(Cellule<TypeInfo>*& ptrCetteListe, const TypeInfo& nouvelleInfo);

    /**
     * worker récursif de suppression de la première occurrence d'une uneInfo
     * @param ptrCetteListe : pointeur (donnée-résultat) sur la "liste" de Cellules
     * @param uneInfo : information à supprimer
     * @return : true si suppression possible (uneInfo présente) ; False sinon
     */
    bool supprimePremOccInfoRecWorker(Cellule<TypeInfo>*& ptrCetteListe, const TypeInfo& uneInfo);

    void afficheCroissantRecWorker(const Cellule<TypeInfo>* ptrCetteListe) const;

    void supprimeTeteWorker(Cellule<TypeInfo> *&ptrCetteListe);

    void videRecWorker(Cellule<TypeInfo> *ptrCetteListe);


public:
    // Constructeur par défaut
    ListeTrieeChainee();
    // Constructeur à partir d'une liste chaînée exixtante
    ListeTrieeChainee(const ListeTrieeChainee<TypeInfo>& uneListe);
    // Destructeur
    virtual ~ListeTrieeChainee();

    /**
     *     /!\ ATTENTION /!\
     * 
     *  VOIR LA DOCUMENTATION DANS LA CLASSE ListeTrieeInterface 
     *
     */
    void insereRec(const TypeInfo& nouvelleInfo);

    bool supprimePremOccInfoIter(const TypeInfo& uneInfo);
    bool supprimePremOccInfoRec(const TypeInfo& uneInfo);
    int getPositIter(const TypeInfo& uneInfo) const;

    void supprimeToutesDuplications();

    // Méthodes déjà founies dans ListeTrieeInterface :
    bool estVide() const;
    int getLongueur() const;
    void videRec();

    // Méthodes pour l'affichage
    void afficheCroissantRec() const;

    // Méthodes ensemblistes
    /**
     * Vérifie que cette liste est un ensemble : elle est croissante et il n'y a pas de duplication
     * @return true si cette liste est un ensemble
     */
    bool estEnsemble() const;

    /**
     * Intersection de cet ensemble avec ensembleB
     * @pre  cette liste triée est un ensemble, ensembleB est un ensemble
     * @post  le résultat est un ensemble
     * @param ensembleB
     * @return une liste chaînée triée qui est un ensemble intersection de cet ensemble et ensembleB
     */
    ListeTrieeChainee<TypeInfo>* insersectionAvec(const ListeTrieeChainee<TypeInfo>* ensembleB) const;

    /**
     * Union de cet ensemble avec ensembleB
     * @pre  cette liste triée est un ensemble, ensembleB est un ensemble
     * @post  le résultat est un ensemble
     * @param ensembleB
     * @return une liste chaînée triée qui est un ensemble union de cet ensemble et ensembleB
     */
    ListeTrieeChainee<TypeInfo>* unionAvec(const ListeTrieeChainee<TypeInfo>* ensembleB) const;

}; // end ListeChaineeTriee

template<class TypeInfo>
ListeTrieeChainee<TypeInfo>::ListeTrieeChainee() : ptrTete(nullptr), nbCellules(0) {
} // end constructeur par défaut (une liste videRec)

template<class TypeInfo>
ListeTrieeChainee<TypeInfo>::ListeTrieeChainee(const ListeTrieeChainee<TypeInfo>& uneListe) {
    ptrTete = copieListe(uneListe.ptrTete);
    nbCellules = uneListe.nbCellules;
} // end constructeur par copie

template<class TypeInfo>
Cellule<TypeInfo>* ListeTrieeChainee<TypeInfo>::copieListe(const Cellule<TypeInfo>* laListeOriginale) {
    // création d'une liste videRec pour y ranger la copie
    Cellule<TypeInfo>* laListeCopiee = nullptr;
    if (laListeOriginale != nullptr) { // La liste originale n'est pas videRec
        // construction de la première Cellule de la copie
        // avec l'information portée par la première Cellule de la laListeOriginale
        laListeCopiee = new Cellule<TypeInfo>(laListeOriginale->getInfo());
        // avec comme suivante le résutlat de la copie de la suite de la laListeOriginale
        laListeCopiee->setSuivante(copieListe(laListeOriginale->getSuivante()));
    } // end if
    // rendre la copie
    return laListeCopiee;
} // end copieListe

template<class TypeInfo>
ListeTrieeChainee<TypeInfo>::~ListeTrieeChainee() {
    videRec();
} // end destructeur

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::insereRec(const TypeInfo& nouvelleInfo) {
    insereRecWorker(ptrTete, nouvelleInfo);
}

/**
 * Transforme cette Liste en un ensemble en supprimant toutes les valeurs dupliquées
 * @tparam TypeInfo
 */
template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::supprimeToutesDuplications() {
    /*
     * A COMPLETER
     */
}

/**
 * position occupée si présente, -position si absente
 * @tparam TypeInfo
 * @param uneInfo information dont on cherche la position
 * @return position de uneInfo si présente, -position que uneInfo aurait dû occuper si absente
 */
template<class TypeInfo>
int ListeTrieeChainee<TypeInfo>::getPositIter(const TypeInfo& uneInfo) const {
    /*
     * A COMPLETER
     */
    int pos = 1;
    Cellule<TypeInfo>* celluleCourante = ptrTete;

       /*Cas 1 => l'info de la dernière cellule de la liste est inférieure à l'info cherchée*/
    if(celluleCourante->getSuivante() == nullptr) {
        return -nbCellules-1;
    }

    while(celluleCourante->getSuivante() != nullptr && celluleCourante->getInfo() < uneInfo) {
        pos = pos + 1;
        celluleCourante = celluleCourante->getSuivante();
    }

    if(celluleCourante->getInfo() == uneInfo) {
        return pos;
    }else {
        return -pos;
    }
} // end getPositIter

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::afficheCroissantRec() const {
    afficheCroissantRecWorker(ptrTete);
} // end afficheCroissantRec

template<class TypeInfo>
bool ListeTrieeChainee<TypeInfo>::estVide() const {
    return nbCellules == 0;
} // end estVide

template<class TypeInfo>
int ListeTrieeChainee<TypeInfo>::getLongueur() const {
    return nbCellules;
} // end getLongueur

/*
 * Insertion toujours possible (à moins qu'il n'y ait plus de place dans le tas)
 */
template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::insereRecWorker(Cellule<TypeInfo>*& ptrCetteListe, const TypeInfo& nouvelleInfo) {
    /*
     * A COMPLETER
     */
    Cellule<TypeInfo>* celluleAInserer = new Cellule<TypeInfo>(nouvelleInfo);

    // Cas 1 : Fin de la liste ou position correcte trouvée
    if (ptrCetteListe == nullptr || nouvelleInfo <= ptrCetteListe->getInfo()) {
        celluleAInserer->setSuivante(ptrCetteListe); // Connecte la nouvelle cellule à la liste
        ptrCetteListe = celluleAInserer;            // Pointe `ptrCetteListe` sur la nouvelle cellule
    } else {
        // Cas 2 : Avancer dans la liste pour trouver l'emplacement correct
        insereRecWorker(ptrCetteListe->getRefSuivante(), nouvelleInfo);
    }

    /*if(ptrCetteListe == nullptr) {
        celluleAInserer->setSuivante(ptrCetteListe);
        ptrCetteListe = celluleAInserer;
    }else if(nouvelleInfo <= ptrCetteListe->getInfo()) {
        celluleAInserer->setSuivante(ptrCetteListe);
        ptrCetteListe = celluleAInserer;
    }else if(nouvelleInfo > ptrCetteListe->getInfo()) {
        ptrCetteListe->setSuivante(celluleAInserer);
    }else {
        insereRecWorker(ptrCetteListe->getRefSuivante(), nouvelleInfo);
    }*/
}

/**
 * Suppression de la première occurrence de uneInfo si présente et retour true, si absente retour false
 * @tparam TypeInfo
 * @param ptrCetteListe liste de Cellules à traiter
 * @param uneInfo information à supprimer si présente
 * @return true si uneInfo présente, false sinon
 */
template<class TypeInfo>
bool ListeTrieeChainee<TypeInfo>::supprimePremOccInfoRecWorker(Cellule<TypeInfo>*& ptrCetteListe, const TypeInfo & uneInfo) {
    /*
     * A COMPLETER
     */
    if(ptrCetteListe == nullptr || ptrCetteListe->getInfo() > uneInfo) {
        return false;
    }else if(ptrCetteListe->getInfo() == uneInfo) {
        Cellule<TypeInfo> *celluleASupprimer = ptrCetteListe;
        //ptrCetteListe->setSuivante(celluleASupprimer->getSuivante()); //faute
        ptrCetteListe = ptrCetteListe->getSuivante();
        delete celluleASupprimer;
        return true;
    }else {
        return supprimePremOccInfoRecWorker(ptrCetteListe->getRefSuivante(), uneInfo);
    }
}

template<class TypeInfo>
bool ListeTrieeChainee<TypeInfo>::supprimePremOccInfoRec(const TypeInfo & uneInfo) {
    return supprimePremOccInfoRecWorker(ptrTete, uneInfo);
}

/**
 * Suppression de la première occurrence de uneInfo si présente et retour true, si absente retour false
 * @tparam TypeInfo
 * @param uneInfo information à supprimer
 * @return true si uneInfo présente, false sinon
 */
template<class TypeInfo>
bool ListeTrieeChainee<TypeInfo>::supprimePremOccInfoIter(const TypeInfo& uneInfo) {
    /*
     * A COMPLETER
     */
    Cellule<TypeInfo>* celluleCourante = ptrTete;
    /*Cas où il n'y a rien à supprimer*/
    if(celluleCourante == nullptr || celluleCourante->getInfo() > uneInfo) {
        return false;
    }

    // Cas où l'élément à supprimer est en tête de liste
    if (ptrTete->getInfo() == uneInfo) {
        Cellule<TypeInfo>* celluleASupprimer = ptrTete;
        ptrTete = ptrTete->getSuivante();
        delete celluleASupprimer;
        return true;
    }

    // Parcours pour trouver la cellule juste avant celle à supprimer
    while(celluleCourante->getSuivante() != nullptr && celluleCourante->getSuivante()->getInfo() < uneInfo) {
        celluleCourante = celluleCourante->getSuivante();
    }

    if(celluleCourante->getSuivante() != nullptr && celluleCourante->getSuivante()->getInfo() == uneInfo) {
        Cellule<TypeInfo>* celluleASupprimer = celluleCourante->getSuivante();
        celluleCourante->setSuivante(celluleASupprimer->getSuivante());
        delete celluleASupprimer;
        return true;
    }
    return false;
}

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::supprimeTeteWorker(Cellule<TypeInfo> *&ptrCetteListe) {
    //  pointeur temporaire sur la première cellule
    Cellule<TypeInfo> *ptrCelluleASupprimer = ptrCetteListe;
    // si la liste n'est pas videRec
    if (ptrCetteListe) {
        // la cellule suivante de la première cellule devient la nouvelle première cellule
        // MODIFICATION du paramètre résultat
        ptrCetteListe = ptrCetteListe->getSuivante();
        // rendre au tas la cellule à supprimer
        ptrCelluleASupprimer->setSuivante(nullptr);
        delete ptrCelluleASupprimer;
        ptrCelluleASupprimer = nullptr;
        nbCellules--; // une cellule en moins
    }
    // si la liste est déjà videRec, ne rien faire
} // end supprimeTeteWorker

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::videRecWorker(Cellule<TypeInfo> *ptrCetteListe) {
    // > ptrCetteListe == nullptr => rien {la liste est videRec} *
    // > ptrCetteListe != nullptr => supprimeTete(ptrCetteListe); nbcellules--; videRecWorker(ptrCetteListe);

    if (ptrCetteListe != nullptr) {
        // supprimer en tête
        supprimeTeteWorker(ptrCetteListe);
        nbCellules--;
        // vider la liste qui reste
        videRecWorker(ptrCetteListe);
    } // end if
} // end videRec

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::videRec() {
    videRecWorker(ptrTete);
    ptrTete = nullptr;
} // end videRec

template<class TypeInfo>
void ListeTrieeChainee<TypeInfo>::afficheCroissantRecWorker(const Cellule<TypeInfo>* ptrCetteListe) const {
    if (ptrCetteListe) {
        cout << ptrCetteListe->getInfo() << " ";
        afficheCroissantRecWorker(ptrCetteListe->getSuivante());
    }
} // end afficheCroissantRec

/**
 * vérifie que cette liste est un ensemble : elle est triée croissante sans duplication (ie triée au sens strict)
 * @tparam TypeInfo
 * @return true si ensemble, false sinon
 */
template<class TypeInfo>
bool ListeTrieeChainee<TypeInfo>::estEnsemble() const {
    /*
     * A COMPLETER
     */
    Cellule<TypeInfo>* celluleCourante = ptrTete;

    /*Une liste avec 0 ou 1 élement est un ensemble*/
    if(celluleCourante == nullptr || celluleCourante->getSuivante() == nullptr) {
        return true;
    }

    /*On avance dans la liste tant que l'on est pas à la fin et que il n'y a pas de 2ème info égale à une précédente*/
    /*Erreur que j'ai réalisée => celluleCourante->getSuivante() ne va pas car je teste l'égalité juste après d'une info qui est nullptr
     *donc NullPointerException. Il faut faire attention à ça*/
    while(celluleCourante->getSuivante() != nullptr && celluleCourante->getInfo() != celluleCourante->getSuivante()->getInfo()) {
        celluleCourante = celluleCourante->getSuivante();
    }

    /*Comme on continue à avancer dans la liste tant qu'il s'agit d'un ensemble, on arrivera à la fin de la liste à un moment donné.
     *et la celluleSuivante de la celluleCourante pointera sur nullptr (la fin de la liste)*/
    return celluleCourante->getSuivante() == nullptr;
}

/**
 * Intersection de cet ensemble avec ensembleB
 * @pre  cette liste triée est un ensemble, ensembleB est un ensemble
 * @post  le résultat est un ensemble
 * @param ensembleB
 * @return une liste chaînée triée qui est un ensemble intersection de cet ensemble et ensembleB
 */
template<class TypeInfo>
ListeTrieeChainee<TypeInfo>* ListeTrieeChainee<TypeInfo>::insersectionAvec(const ListeTrieeChainee<TypeInfo>* ensembleB) const {
    // l'idée est de mettre, si possible une première Cellule dans EnsembleResultat
    // puis on insérera successivment derière la dernière Cellule de EnsembleResultat

    // intitialisation de l'ensemble résultat, il ne contient aucune Cellule son ptrTete == nullptr
    ListeTrieeChainee<TypeInfo>* ptrEnsembleResultat = new ListeTrieeChainee<TypeInfo>();

    //pointeur sur la première Cellule de chacun des deux ensembles
    Cellule<TypeInfo>* ptrListeEnsembleA = this->ptrTete;
    Cellule<TypeInfo>* ptrListeEnsembleB = ensembleB->ptrTete;

    /*
     * A COMPLETER
     */

    return ptrEnsembleResultat;
} // end intersectionAvec

/**
  * Union de cet ensemble avec ensembleB
  * @pre  cette liste triée est un ensemble, ensembleB est un ensemble
  * @post  le résultat est un ensemble
  * @param ensembleB
  * @return une liste chaînée triée qui est un ensemble union de cet ensemble et ensembleB
  */
template<class TypeInfo>
ListeTrieeChainee<TypeInfo>* ListeTrieeChainee<TypeInfo>::unionAvec(const ListeTrieeChainee<TypeInfo>* ensembleB) const {
    // l'idée est de mettre, si possible une première Cellule dans EnsembleResultat
    // puis on insérera successivment derière la dernière Cellule de EnsembleResultat

    // intitialisation de l'ensemble résultat, il ne contient aucune Cellule son ptrTete == nullptr
    ListeTrieeChainee<TypeInfo>* ptrEnsembleResultat = new ListeTrieeChainee<TypeInfo>();

    //pointeur sur la première Cellule de chacun des deux ensembles
    Cellule<TypeInfo>* ptrListeEnsembleA = this->ptrTete;
    Cellule<TypeInfo>* ptrListeEnsembleB = ensembleB->ptrTete;

    /*
     * A COMPLETER
     */

    //on a terminé
    return ptrEnsembleResultat;
} // end unionAvec

//  Fin de l'implémentation.

#endif