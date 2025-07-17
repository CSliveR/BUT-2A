#include <stdlib.h>
#include <stdio.h>

int carre_copie(int n){
    return n*n;
}

void carre_adresse(int *adr_n){
    *adr_n = (*adr_n)*(*adr_n);
}

int main(void){
    int n,res;
    printf("Entrez un entier\n");
    scanf(" %d",&n);
    printf("Valeur de n avant l'appel de la fonction carrée %d\n", n);
    res = carre_copie(n);
    printf("Valeur de n puis res après l'appel de la fonction carrée %d%d\n", n, res);

    printf("Valeur de n avant l'appel de la fonction carrée %d\n", n);
    carre_adresse(&n);
    printf("Valeur de n après l'appel de la fonction carrée %d\n", n);

    return EXIT_SUCCESS;
}