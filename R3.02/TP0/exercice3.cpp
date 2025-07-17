#include <cstdlib>
#include <iostream>
#include <iomanip>
#include <vector>

using namespace std;

template<class T>
void afficheVecteur(const vector<T> v) {
    // {v.size() > 0} => {pretty print de v}
    cout << "[" << v[0];
    int i = 1;
    while (i < v.size()) {
        cout << ", " << v[i];
        i++;
    }
    cout << "]" << endl;
}

template<class T>
void minMaxIter(const vector<T> v, T &min, T &max, int &nbComp) {
    // {v.size()≥ 1} => {min = plus petite valeur de v,
    //                   max = plus grande valeur de v,
    //                   nbcomp = nombre de comparaisons impliquant au moins un élément de v}
    /*
    * À COMPLETER
    */
    if (v.size() == 1) {
        min = v[0];
        max = v[0];
    } else {
        min = v[0];
        max = v[0];
        for (unsigned int i = 1; i < v.size(); i++) {
            nbComp++; //On rajoute une comparaison avant la condition de comparaison.
            if (v[i] < min) {
                min = v[i];
            } else {
                nbComp++; //Comparaison de valeurs entre min et max
                if (v[i] > max) {
                    max = v[i];
                }
            }
        }
    }
}

template<class T>
void minMaxRec(const vector<T> &v, int inf, int sup, T &min, T &max, int &nbComp) {
    // {v.size()≥ 1} => {min = plus petite valeur de v sur l'intervalle [inf..sup],
    //                   max = plus grande valeur de v sur l'intervalle [inf..sup],
    //                   nbcomp = nombre de comparaisons impliquant au moins un élément de v}

    /*
    * À COMPLETER
    */
    if (inf == sup) {
        min = v[inf];
        max = v[inf];
    }else if(sup - inf == 1) {
        nbComp++;
        if(v[inf] < v[sup]){
            min = v[inf];
            max = v[sup];
        }else {
            min = v[sup];
            max = v[inf];
        }
    }else {
        int mid = (inf + sup) / 2;
        nbComp++;
        T minLeft, maxLeft, minRight, maxRight;
        minMaxRec(v, inf, mid, minLeft, maxLeft, nbComp);
        minMaxRec(v, mid+1, sup, minRight, maxRight, nbComp);

        nbComp++;
        min = minLeft < minRight ? minLeft : minRight;
        nbComp++;
        max = maxLeft > maxRight ? maxLeft : maxRight;
    }
}


void testMinMaxIter() {
    cout << "***************************" << endl;
    cout << "*        min max iter     *" << endl;
    cout << "***************************" << endl;

    int min;
    int max;
    int nbComp = 0;

    vector<int> v = {10};
    minMaxIter(v, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> " << " min = " << min << ", max = " << max << ", nbComp = " <<
            nbComp << endl << endl;

    nbComp = 0;
    v = {10, 3, 6, 8, 67, 2, 9, 1};
    minMaxIter(v, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> " << " min = " << min << ", max = " << max << ", nbComp = " <<
            nbComp << endl << endl;

    nbComp = 0;
    v.clear();
    srand((unsigned) time(NULL));
    for (int i = 0; i < 128; i++) {
        int b = rand() % 128 + 1;
        v.push_back(b);
    }
    minMaxIter(v, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> " << " min = " << min << ", max = " << max << ", nbComp = " <<
            nbComp << endl << endl;
}

void testMinMaxDR() {
    cout << "***************************" << endl;
    cout << "*         min max DR      *" << endl;
    cout << "***************************" << endl;

    int min;
    int max;
    int inf;
    int sup;
    int nbComp = 0;

    vector<int> v = {10};
    inf = 0;
    sup = v.size() - 1;
    minMaxRec(v, inf, sup, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> min = " << min << ", max = " << max << ", nbComp = " << nbComp <<
            endl << endl;

    nbComp = 0;
    v = {10, 3, 6, 8, 67, 2, 9, 1};
    inf = 0;
    sup = v.size() - 1;
    minMaxRec(v, inf, sup, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> min = " << min << ", max = " << max << ", nbComp = " << nbComp <<
            endl << endl;

    nbComp = 0;
    v.clear();
    srand((unsigned) time(NULL));
    for (int i = 0; i < 128; i++) {
        int b = rand() % 128 + 1;
        v.push_back(b);
    }
    inf = 0;
    sup = v.size() - 1;
    minMaxRec(v, inf, sup, min, max, nbComp);
    cout << "v : ";
    afficheVecteur(v);
    cout << "Taille du vecteur = " << v.size() << " -> min = " << min << ", max = " << max << ", nbComp = " << nbComp <<
            endl << endl;
}

int main(int argc, char **argv) {
    testMinMaxIter();
    testMinMaxDR();

    return 0;
}
