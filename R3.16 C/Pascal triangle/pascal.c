#include <stdlib.h>
#include <stdio.h>

int **pascal_malloc(int profondeur){
    int **triangle = malloc((profondeur+1) * sizeof(int*));

    for(int i=0; i <= profondeur; i++){
        triangle[i] = malloc((i+1) * sizeof(int));
    }

    return triangle;
}

void pascal_free(int **triangle, int profondeur){
    for(int i=0; i <= profondeur; i++){
        free(triangle[i]);
    }

    free(triangle);
}

int main(int argc, char *argv[]){
    int profondeur = atoi(argv[1]);
    int **triangle = pascal_malloc(profondeur);
    pascal_free(triangle, profondeur);



    return EXIT_SUCCESS;
}