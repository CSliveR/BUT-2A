#include <stdlib.h>
#include <stdio.h>

void permuter(int *adr_a, int *adr_b){
    int temp = *adr_a;
    *adr_a = *adr_b;
    *adr_b = temp;
}

int main(void){
    int a = 5;
    int b = 33;
    printf("-----------------------\n");
    printf("Avant la permutation\n");
    printf("a = %d\n", a);
    printf("b = %d\n", b);
    permuter(&a, &b);
    printf("-----------------------\n");
    printf("Après la permutation\n");
    printf("a = %d\n", a);
    printf("b = %d\n", b);

    return EXIT_SUCCESS;
}