// Dans le fichier d'implémentation d'une classe, on doit inclure le fichier de spécification de cette classe
#include "Point.h"

// Et on inclura aussi les librairies utilisées ici
#include <iostream>
#include <string>
#include <utility>
using namespace std;
// A COMPLETER - Implémenter les méthodes de la classe Point

const string Point::NOM_DEF = "Point";
const int Point::X_DEF = 0;
const int Point::Y_DEF = 0;

Point::Point() : m_nom(NOM_DEF), m_x(X_DEF), m_y(Y_DEF) {
    cout << "Le point " << m_nom << "a été crée " << endl;
}

Point::Point(string nom, int x, int y) : m_nom(nom), m_x(x), m_y(y) {
    cout << "Le point " << m_nom << " a été crée " << endl;
}

Point::~Point() {
    cout << "Le point " << m_nom << " a été détruit." << endl;
}

string Point::getNom() const {
    return this->m_nom;
}

int Point::getX() const {
    return this->m_x;
}

int Point::getY() const {
    return this->m_y;
}

void Point::setNom(const string &nom) {
    this->m_nom = nom;
}

void Point::setX(const int &x) {
    this->m_x = x;
}

void Point::setY(const int &y) {
    this->m_y = y;
}

void Point::saisir(istream &entree) {
    string nom;
    int x, y;
    cout << "Entrez le nom du point :";
    entree >> nom;
    setNom(nom);
    cout << "Entrez la coordonnée x du point :";
    entree >> x;
    setX(x);
    cout << "Entrez la coordonnée y du point :";
    entree >> y;
    setY(y);
}

void Point::afficher(ostream & sortie) const {
    sortie << "Nom du point : " << this->m_nom << " x= " << this->getX() << " y= " << this->getY() << endl;
}






