// NE PAS MODIFIER

#ifndef OBJETCONTRAINT_H
#define OBJETCONTRAINT_H

#include <stdexcept>
// Classe pour représenter un objet dont la valeur de type T est toujours comprise entre min et max
// Si cette contraint n'est pas respectée, une exception range_error est levée
template<class T>
class ObjetContraint {
public:
    // Construction d'un objet contraint de valeur val comprise entre min et max
    ObjetContraint(const T &val, const T &min, const T &max);
    // Retourne le min
    inline const T &getMin() const {return m_min;}
    // Retourne le max
    inline const T &getMax() const {return m_max;}
    // Retourne la valeur
    inline const T &getVal() const {return m_val;}
    // Modifie la valeur; lève une exception range_error si val non comprise entre min et max
    void setVal(const T &val);
    // Operateur de cast d'un objet contraint en type T, retourne la valeur
    inline operator T() const {return getVal();}
private:
    T m_val; // La valeur de l'objet contraint
    T m_min; // Sa valeur min
    T m_max; // Sa valeur max
};

// Implémentation des autres méthodes du template

template<class T>
ObjetContraint<T>::ObjetContraint(const T &val, const T &min, const T &max)
        : m_min(min), m_max(max) {
    setVal(val);
}

template<class T>
void ObjetContraint<T>::setVal(const T &val) {
    if (getMax() < val || val < getMin()) {
        throw std::range_error("Valeur Hors Intervalle Min..Max");
    }
    this->m_val = val;
}

#endif /* OBJETCONTRAINT_H */

