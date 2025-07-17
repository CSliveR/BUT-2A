#include <stdlib.h>
#include <stdio.h>

int main(void){
    int nb;
    printf("vous voulez la table de combien ? ");
    scanf("%d", &nb);

    for(unsigned int i = 0; i < 11; i++){
        printf("%d x %d = %d\n", i,nb,i*nb);
    }

    return EXIT_SUCCESS;
}