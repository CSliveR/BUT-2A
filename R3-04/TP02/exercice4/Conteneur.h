#ifndef CONTENEUR_H
#define CONTENEUR_H

#include <vector>
#include <iostream>
#include <stdexcept>
template<class T>
class Conteneur {
    // A COMPLETER : Spécifiez ici le template Conteneur<T>
public:
    Conteneur();
    Conteneur(const Conteneur<T> &unConteneur);
    Conteneur &operator=(const Conteneur<T> &unConteneur);
    ~Conteneur();
    void ajouter(T* element);
    void afficher(std::ostream &sortie) const;
private:
    std::vector<T*> m_contenu;
};
// A COMPLETER : Implémentez ici les méthodes du template Conteneur<T> (pas de fichier .cpp pour un template)
template<class T>
Conteneur<T>::Conteneur(): m_contenu(){
    //par défaut, m_contenu est un std::vector qui est initialisé de manière vide.
}

template<class T>
Conteneur<T>::Conteneur(const Conteneur<T> &unConteneur):
m_contenu(unConteneur.m_contenu) {
}

template<class T>
Conteneur<T> &Conteneur<T>::operator=(const Conteneur<T> &unConteneur) {
    if(this != &unConteneur) {
        ~Conteneur();
    }

    if(unConteneur.m_contenu) {
        m_contenu = new std::vector<T*>;
    }else {
        m_contenu = nullptr;
    }
    return *this;
}

template<class T>
Conteneur<T>::~Conteneur() {
    for(const T* element : m_contenu) {
        delete element;
    }
    m_contenu.clear();
}

template<class T>
void Conteneur<T>::ajouter(T* element) {
    this->m_contenu.push_back(element);
}

template<class T>
void Conteneur<T>::afficher(std::ostream &sortie) const {
    for(const T* element : m_contenu) {
        sortie << *element << " ";
    }
}

#endif /* CONTENEUR_H */

