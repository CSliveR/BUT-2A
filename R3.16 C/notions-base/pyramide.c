#include <stdlib.h>
#include <stdio.h>

void putchars(unsigned int repeat, char ch){
    for(unsigned int i=0; i < repeat; i++){
        putchar(ch);
    }
}

int main(int argc, char *argv[]){
    unsigned int hauteur = atoi(argv[1]); //conversion ascii to integer
    //printf("hauteur ?");
    //scanf(" %d", &hauteur);
    for(unsigned int ligne=1; ligne <= hauteur; ligne++){
        putchars(hauteur - ligne, ' ');
        putchars(2*ligne - 1, argv[2][0]);
        printf("\n");
    }

   
    return EXIT_SUCCESS;
}