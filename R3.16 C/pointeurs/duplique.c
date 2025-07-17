#include <stdlib.h>
#include <stdio.h>
#include <string.h>

char *copier_chaine(char *str){
    char *strCopy;
    strCopy = malloc(strlen(str) + 1);
    strcpy(strCopy, str);
    
    if(strCopy == NULL){
        return NULL;
    }
    return strCopy;
}

int main(void){
    char original[] = "Ma super chaine a copier";
    char *copie;  //copie a allouer dynamiquement 
    copie = copier_chaine(original);

    printf("%s\n", copie);
    free(copie);

    return EXIT_SUCCESS;
}