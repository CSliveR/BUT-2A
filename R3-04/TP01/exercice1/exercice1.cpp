#include <cstdlib>
#include <iostream>
#include <string>
#include "Point.h"
using namespace std;

void testClassePoint(string nom,  int x, int y) {
    const Point point(nom, x, y);
    cout << "Test de getX()" << endl
    << "Valeur attendue : " << x << endl
    << "Valeur obtenue : " << point.getX() << endl
    << (point.getX()==x ? "Succès" : "Echec") << endl;

    cout << "Test de getY()" << endl
    << "Valeur attendue : " << y << endl
    << "Valeur obtenue : " << point.getY() << endl
    << (point.getY()==y ? "Succès" : "Echec") << endl;

    cout << "Test de getNom()" << endl
    << "Valeur attendue : " << nom << endl
    << "Valeur obtenue : " << point.getNom() << endl
    << (point.getNom()==nom ? "Succès" : "Echec") << endl;
}

void testClassePointDynamique(string nom,  int x, int y) {
    Point *p_point = new Point(nom, x, y);

    cout << "Test de getX()" << endl
    << "Valeur attendue : " << x << endl
    << "Valeur obtenue : " << p_point->getX() << endl
    << (p_point->getX()==x ? "Succès" : "Echec") << endl;

    cout << "Test de getY()" << endl
    << "Valeur attendue : " << y << endl
    << "Valeur obtenue : " << p_point->getY() << endl
    << (p_point->getY()==y ? "Succès" : "Echec") << endl;

    cout << "Test de getNom()" << endl
    << "Valeur attendue : " << nom << endl
    << "Valeur obtenue : " << p_point->getNom() << endl
    << (p_point->getNom()==nom ? "Succès" : "Echec") << endl;
}

int main(int argc, char** argv) {
    // à compléter
    Point p1;
    p1.saisir(cin);
    p1.afficher(cout);
    testClassePoint(p1.getNom(), p1.getX(), p1.getY());
    cout << " ----------------------------------- " << endl;
    Point *p2 = new Point(p1.getNom(), p1.getX(), p1.getY());
    p2->saisir(cin);
    p2->afficher(cout);
    testClassePointDynamique(p2->getNom(), p2->getX(), p2->getY());
    delete p2;
    return 0;
}

