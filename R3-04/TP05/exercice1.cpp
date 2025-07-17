#include <cstdlib>
#include <iostream>
#include <iomanip>
#include <limits>
using namespace std;
#include "Salarie.h"

int main(int argc, char **argv) {
    // A COMPLETER : saisir et afficher un Salarie*
    Salarie salarie(Salarie::NOM_DEF,Salarie::NUMERO_SS_DEF,
        ObjetContraint<float>(Salarie::SMIC, Salarie::SMIC, Salarie::COEFF_SMIC*Salarie::SMIC));
    salarie.saisir();
    salarie.afficher();
    return 0;
}