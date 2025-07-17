#include "Conteneur.h"
#include <iostream>
#include <string>
#include <stdexcept>
using namespace std;

int main(int argc, char** argv) {
    // A COMPLETER : tester le template Conteneur<T>
    Conteneur<string> conteneurString;
    conteneurString.ajouter(new string("Chat"));
    conteneurString.ajouter(new string("Chien"));
    conteneurString.ajouter(new string("Cochon d'inde"));
    conteneurString.afficher(cout);
    return 0;
}