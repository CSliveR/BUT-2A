#include <stdlib.h>
#include <stdio.h>
#include <pgmio.h>
#include <string.h>
#include "traitement.h"
#include "allocation.h"

void pgm_show(char *filename){
    size_t command_length = strlen("eog ") + strlen(filename) + 1; // +1 pour le caractère nul '\0'
    char *command = malloc(command_length * sizeof(char));

    snprintf(command, command_length,"eog %s", filename);
    system(command);
    free(command);
}


int main(void){
    size_t width;
    size_t height;

    pgm_t_image *pixels;
    pixels = pgm_read("./guadalest.pgm"); //Cette fonction fait un malloc !
    pgm_show("./guadalest.pgm");
    pgm_write("./guadalest_copie.pgm", pixels);
    pgm_show("./guadalest_copie.pgm");

    pgm_t_image *pixelsCrees = pgm_malloc(width, height);
    pgm_solid(pixelsCrees,0);
    pgm_write("./ImageNoire.pgm", pixelsCrees);
    pgm_show("./ImageNoire.pgm");

    pgm_negative(pixels);
    pgm_write("./ImageNegative.pgm", pixels);
    pgm_show("./ImageNegative.pgm");

    pgm_threshold(pixels, 123);
    pgm_write("./ImageSeuil.pgm", pixels);
    pgm_show("./ImageSeuil.pgm");

    pgm_free(pixelsCrees);
    
    return EXIT_SUCCESS;
}

