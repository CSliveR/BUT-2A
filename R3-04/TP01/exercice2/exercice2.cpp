#include "EntierContraint.h"
using namespace std;

int main(int argc, char** argv) {
    // à compléter
    EntierContraint defaultEc;
    EntierContraint ec(5, 0, 100);
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
    return 0;
}

