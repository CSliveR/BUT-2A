#ifndef OBJETCONTRAINT_H
#define OBJETCONTRAINT_H
#include <iostream>
#include <limits>
#include <ostream>

template <class T>
class ObjetContraint {
    // A COMPLETER : Spécifiez ici le template de classe ObjetContraint<T>
public:
    ObjetContraint();
    ObjetContraint(T valeur, T min, T max);
    T getMin() const;
    T getMax() const;
    T getVal() const;
    void setVal(T valeur);
    void saisir(std::istream &istream);
    void afficher(std::ostream &ostream) const;
private:
    T m_min;
    T m_max;
    T m_val;

    // Constantes de Classe (static) pour définir les valeurs par défaut des attributs d'un objet contraint.
    static constexpr int VAL_DEF = 0;
    static constexpr int MIN_DEF = std::numeric_limits<T>::min(); // le plus petit objet possible
    static constexpr int MAX_DEF = std::numeric_limits<T>::max(); // le plus grand objet possible
};

// A COMPLETER : Implémentez ici les méthodes du template ObjetContraint<T> (pas de fichier .cpp pour un template)
template <class T>
ObjetContraint<T>::ObjetContraint(): m_min(MIN_DEF), m_max(MAX_DEF), m_val(0) {
    std::cout << "Un objet contraint par défaut a été crée" << std::endl;
}

template<class T>
ObjetContraint<T>::ObjetContraint(T valeur, T min, T max): m_min(min), m_max(max), m_val(valeur){
    if(m_val < m_min || m_val > m_max) {
        throw "Objet contraint hors limite";
    }
    std::cout << "Un objet entre " << min << " et " << max << " a été crée" << std::endl;
}

template<class T>
T ObjetContraint<T>::getMin() const {
    return this->m_min;
}

template<class T>
T ObjetContraint<T>::getMax() const {
    return this->m_max;
}

template<class T>
T ObjetContraint<T>::getVal() const {
    return this->m_val;
}

template<class T>
void ObjetContraint<T>::setVal(T valeur) {
    if(valeur < getMin() || valeur > getMax()) {
        throw "Objet contraint hors limite";
    }
    this->m_val = valeur;
}

template<class T>
void ObjetContraint<T>::saisir(std::istream &entree) {
    T valeur;
    std::cout << "Entrez un objet de type " << typeid(T).name() <<  " entre "  << getMin() << " et " << getMax() << std::endl;
    entree >> valeur;
    setVal(valeur);
}

template<class T>
void ObjetContraint<T>::afficher(std::ostream &sortie) const{
    sortie << this->getVal() << " est contraint sur l'intervalle [" << this->getMin() << "," << this->getMax() << "]" << std::endl;
}

#endif /* OBJETCONTRAINT_H */

