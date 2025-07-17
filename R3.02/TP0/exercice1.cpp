#include <cstdlib>
#include <iostream>
#include <iomanip>

using namespace std;

int factorielleRec(const int n) {
    // {n ≥ 0} => {résultat = n! (soit 1 × 2 ×… × (n-1)  × n}
    if (n == 0) {
        return 1;
    } else if (n == 1) {
        return n;
    } else {
        return n * factorielleRec(n - 1);
    }
}

int factorielleRecNbMults(const int n, int &cpt) {
    // {n ≥ 0} => {résultat = n! (soit 1 × 2 ×… × (n-1)  × n}
    if (n == 0) {
        return 1;
    } else if (n == 1) {
        return n;
    } else {
        // ON VA FAIRE UNE MULTIPLICATION
        // il faut modifier la valeur du paramètre passé par référence
        // avant l'appel récursif
        cpt = cpt + 1;
        return n * factorielleRecNbMults(n - 1, cpt);

        // l'instruction suivante
        // return n * factorielleRecNbMults(n-1, cpt+1);
        // ne compilerait pas, car cpt+1 est une valeur immédiate
    }
}

void hanoi(int nbDisques, char depart, char intermediaire, char arrivee) {
    // {n ≥ 1} => {affiche les déplacements à effectuer pour résoudre le pb}
    /*
     * À COMPLETER
     */
    if (nbDisques == 1) {
        /*cas de base avec un seul disque -> on le déplace du départ vers l'arrivée*/
        cout << "Déplacement disque " << nbDisques << " du piquet " << depart << " vers le piquet " << arrivee << endl;
    }else {
        // Étape 1 : Déplacement des n-1 disques plus petits du piquet de départ vers le piquet intermédiaire.
        // On fait arriver ces disques au piquet intermédiaire.
        hanoi(nbDisques-1, depart, arrivee, intermediaire);
        //Etape 2 : Déplacer le disque restant du départ vers l'arrivée.
        cout << "Déplacement disque " << nbDisques << " du piquet " << depart << " vers le piquet " << arrivee << endl;
        //Etape 3 : Déplacement des n-1 disques du piquet intermédiaire vers celui d'arrivée.
        hanoi(nbDisques-1,intermediaire,depart,arrivee);
    }
}

void hanoiNbDeplacements (int nbDisques, char depart, char intermediaire, char arrivee, int& cpt) {
    // {n ≥ 1} => {affiche les déplacements à effectuer pour résoudre le pb ;
    // cpt permet de compter le nombre de déplacements effectués pour résoudre le problème}
    /*
     * À COMPLETER
     */
    if (nbDisques == 1) {
        /*cas de base avec un seul disque -> on le déplace du départ vers l'arrivée*/
        cout << "Déplacement disque " << nbDisques << " du piquet " << depart << " vers le piquet " << arrivee << endl;
        cpt++;
    }else {
        // Étape 1 : Déplacement des n-1 disques plus petits du piquet de départ vers le piquet intermédiaire.
        // On fait arriver ces disques au piquet intermédiaire.
        hanoiNbDeplacements(nbDisques-1, depart, arrivee, intermediaire, cpt);
        //Etape 2 : Déplacer le disque restant du départ vers l'arrivée.
        cout << "Déplacement disque " << nbDisques << " du piquet " << depart << " vers le piquet " << arrivee << endl;
        cpt++;
        //Etape 3 : Déplacement des n-1 disques du piquet intermédiaire vers celui d'arrivée.
        hanoiNbDeplacements(nbDisques-1,intermediaire,depart,arrivee, cpt);
    }
}


int main(int argc, char **argv) {
    cout << "***************************" << endl;
    cout << "*  factorielle récursive  *" << endl;
    cout << "***************************" << endl;
    cout << "12! = " << factorielleRec(12) << endl;
    int compteur = 0;
    int val = factorielleRecNbMults(5, compteur);
    cout << "5! = " << val << " -> nb multiplications = " << compteur << endl;
    compteur = 0;
    val = factorielleRecNbMults(12, compteur);
    cout << "12! = " << val << " -> nb multiplications = " << compteur << endl;

    cout << "***************************" << endl;
    cout << "*   hanoï (déplacements)  *" << endl;
    cout << "***************************" << endl;

    cout << "******* Hanoï avec 1 disque *******" << endl;
    hanoi(1, 'D', 'I', 'A');
    cout << "******* Hanoï avec 2 disques *******" << endl;
    hanoi(2, 'D', 'I', 'A');
    cout << "******* Hanoï avec 3 disques *******" << endl;
    hanoi(3, 'D', 'I', 'A');

    cout << "***********************************" << endl;
    cout << "*   hanoï (avec nb déplacements)  *" << endl;
    cout << "***********************************" << endl;
    int nbDeplacements = 0;
    int nbDisques = 1;
    hanoiNbDeplacements(1, 'D', 'I', 'A', nbDeplacements);
    cout << "Nb déplacements avec " << nbDisques << " disque(s) : " << nbDeplacements << endl;
    nbDeplacements = 0;
    nbDisques = 2;
    hanoiNbDeplacements(2, 'D', 'I', 'A', nbDeplacements);
    cout << "Nb déplacements avec " << nbDisques << " disque(s) : " << nbDeplacements << endl;
    nbDeplacements = 0;
    nbDisques = 3;
    hanoiNbDeplacements(3, 'D', 'I', 'A', nbDeplacements);
    cout << "Nb déplacements avec " << nbDisques << " disque(s) : " << nbDeplacements << endl;
    nbDeplacements = 0;
    nbDisques = 4;
    hanoiNbDeplacements(4, 'D', 'I', 'A', nbDeplacements);
    cout << "Nb déplacements avec " << nbDisques << " disque(s) : " << nbDeplacements << endl;
    nbDeplacements = 0;
    nbDisques = 5;
    hanoiNbDeplacements(5, 'D', 'I', 'A', nbDeplacements);
    cout << "Nb déplacements avec " << nbDisques << " disque(s) : " << nbDeplacements << endl;

    return 0;
}
