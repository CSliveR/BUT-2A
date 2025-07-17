#include <cstdlib>
#include <iostream>
#include "EntierContraint.h"
using namespace std;

int main(int argc, char** argv) {
    // A Compléter
    // Il faut tester operator int, operator << et operator >> sur la classe EntierContraint
    EntierContraint defaultEc;
    EntierContraint ec(5, 0, 100);

    int i;
    i = (int) ec;
    cout << "Valeur de l'entier contraint: ";
    cout << ec << endl;
    cout << "Valeur d'un entier convertit en entier contraint par conversion explicite: ";
    cout << i << endl;

    i = int (ec);
    cout << "Valeur de l'entier contraint: ";
    cout << ec << endl;
    cout << "Valeur d'un entier convertit en entier contraint par conversion explicite (autre syntaxe de code): ";
    cout << i << endl;

    cout << "Valeur de l'entier contraint: ";
    cout << ec << endl;
    cout << "opérateur de cast appelé implicitement :";
    i=ec;
    cout << i << endl;
    i=1+ec;
    cout << "Entier contraint + 1 = ";
    cout << i << endl;

    cout << "Entrez une valeur pour un entier contraint: ";
    cin >> ec;
    cout << "La valeur que vous avez saisie est : ";
    cout << ec << endl;

    return 0;
}

