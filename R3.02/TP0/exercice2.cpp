#include <cmath>
#include <iostream>
#include <iomanip>

using namespace std;

double puissance(float x, int n) {
// {n >= 0} => {résultat = x élevé à la puissance n}
    /*
    * À COMPLETER
    */
    if(n == 0) {
        return 1.0;
    }else {
        return x * puissance(x, n - 1);
    }
}

double puissanceNbMult(float x, int n, int &nbmult) {
    // {n >= 0} => {résultat = x élevé à la puissance n ;
    //             nbmult est le nombre de multiplications nécessaires à la production du résultat}
    /*
    * À COMPLETER
    */
    if(n == 0) {
        return 1.0;
    }else {
        nbmult++;
        return x * puissanceNbMult(x, n - 1, nbmult);
    }
}

double puissanceDrNbMult(float x, int n, int &nbmult) {
    // {n > 0} => {résultat = x élevé à la puissance n ;
    //             nbmults est le nombre de multiplications nécessaires à la production du résultat}
    /*
    * À COMPLETER
    */
    if(n == 0) {
        return 1.0;
    }else if(n == 1) {
        return x;
    }else if(n > 1 && n % 2 == 0) {
        nbmult++;
        return pow(puissanceDrNbMult(x, n / 2,nbmult),2);
    }else if(n > 1 && n % 2 != 0) {
        nbmult++;
        return x * pow(puissanceNbMult(x, n / 2,nbmult),2);
    }
    /*Plus il y a d'appels récursifs, plus il y a d'opérations (multiplications ici) qui sont effectuées.*/
}

int main(int argc, char **argv) {
    cout << "***************************" << endl;
    cout << "*        puissance        *" << endl;
    cout << "***************************" << endl;
    int x, n;
    x = 2;
    n = 0;
    cout << " – " << x << " puissance " << n << " = " << puissance(x, n) << endl;
    x = 2;
    n = 1;
    cout << " – " << x << " puissance " << n << " = " << puissance(x, n) << endl;
    x = 2;
    n = 16;
    cout << " – " << x << " puissance " << n << " = " << puissance(x, n) << endl;
    x = 2;
    n = 128;
    cout << " – " << x << " puissance " << n << " = " << puissance(x, n) << endl;

    cout << "***************************" << endl;
    cout << "*    puissance nbmult     *" << endl;
    cout << "***************************" << endl;
    int compteur;
    double val;
    compteur = 0;
    x = 2;
    n = 0;
    val = puissanceNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 1;
    val = puissanceNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 16;
    val = puissanceNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 128;
    val = puissanceNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;


    cout << "***************************" << endl;
    cout << "*   puissance DR nbmult   *" << endl;
    cout << "***************************" << endl;
    compteur = 0;
    x = 2;
    n = 0;
    val = puissanceDrNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 1;
    val = puissanceDrNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 16;
    val = puissanceDrNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;
    compteur = 0;
    x = 2;
    n = 128;
    val = puissanceDrNbMult(x, n, compteur);
    cout << " – " << x << " puissance " << n << " = " << val << " -> nb multiplications : " << compteur << endl;


    return 0;
}