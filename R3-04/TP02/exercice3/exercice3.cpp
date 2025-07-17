#include "ObjetContraint.h"
#include "Point.h"
#include <iostream>
using namespace std;

int main(int argc, char** argv) {
    // A COMPLETER : Testez ici le template ObjetContraint<T>
    ObjetContraint<int> defaultEc;
    ObjetContraint<int> ec(5, 0, 100);
    try {
        //instruction(s)_qui_doit(vent)_lever_une_exception;
        defaultEc.saisir(cin);
        ec.saisir(cin);
        cout << "Aucune exception levée" << endl ;
    }
    catch (char const * erreur) {
        cout << "Exception levée : " << erreur << endl ;
    }
    defaultEc.afficher(cout);
    ec.afficher(cout);

    Point p1;
    cout << "Entrez un point P1: ";
    p1.saisir(cin);

    Point p2;
    cout << "Entrez un point P2: ";
    p2.saisir(cin);
    return 0;
}

