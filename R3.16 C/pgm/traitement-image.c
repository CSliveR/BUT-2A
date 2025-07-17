#include <stdlib.h>
#include <stdio.h>
//#include <naivepgmio.h>
#include <pgmio.h>
#include <string.h>

void pgm_show(char *filename){
    size_t command_length = strlen("eog ") + strlen(filename) + 1; // +1 pour le caractère nul '\0'
    char *command = malloc(command_length * sizeof(char));

    snprintf(command, command_length,"eog %s", filename);
    system(command);
    free(command);
}

/*
pgm_t_pixel *pgm_malloc(int width, int height){
    pgm_t_pixel *pixels = malloc(width*height*sizeof(pgm_t_pixel));
    return pixels;
}
*/

pgm_t_image *pgm_malloc(size_t width, size_t height){
    pgm_t_image *pixels = malloc(width*height*sizeof(pgm_t_image));
    return pixels;
}

void pgm_free(pgm_t_image *pgm){
    free(pgm->pixels);
    free(pgm);
}

/*
void pgm_solid(pgm_t_pixel *pixels, int width, int height, pgm_t_pixel color){
    for(int i=0; i < width*height; i++){
        pixels[i] = color;
    }
}
*/

void pgm_solid(pgm_t_image *pgm, pgm_t_pixel color){
    for(int i=0; i < pgm->width*pgm->height; i++){
        pgm->pixels[i] = color;
    }
}

/*
void pgm_negative(pgm_t_pixel *pixels, int width, int height){
    for(int i=0; i < width*height; i++){
        pixels[i] = 255 - pixels[i]; 
    }
}
*/

void pgm_negative(pgm_t_image *pgm){
    for(int i=0; i < pgm->width*pgm->height; i++){
        pgm->pixels[i] = 255 - pgm->pixels[i]; 
    }
}

/*
void pgm_threshold(pgm_t_pixel *pixels, int width, int height, pgm_t_pixel threshold){
    int thres = threshold;
    for(int i=0; i < width*height; i++){
        if(pixels[i] < thres){
            pixels[i] = 0;
        }else{
            pixels[i] = 255;
        }
    }
}
*/

void pgm_threshold(pgm_t_image *pgm, pgm_t_pixel threshold){
    int thres = threshold;
    for(int i=0; i < pgm->width*pgm->height; i++){
        if(pgm->pixels[i] < thres){
            pgm->pixels[i] = 0;
        }else{
            pgm->pixels[i] = 255;
        }
    }
}



void pgm_gradient(pgm_t_pixel *pixels, int width, int height){
    
}


int main(void){
    size_t width;
    size_t height;

    /*
    pgm_t_pixel *pixels;
    pixels = pgm_naiveread("./guadalest.pgm", &width, &height); //Cette fonction fait un malloc !
    pgm_show("./guadalest.pgm");
    pgm_naivewrite("./guadalest_copie.pgm", pixels, width, height);
    pgm_show("./guadalest_copie.pgm");

    pgm_t_pixel *pixelsCrees = pgm_malloc(width, height);
    pgm_solid(pixelsCrees, width, height, 0);
    pgm_naivewrite("./ImageNoire.pgm", pixelsCrees, width, height);
    pgm_show("./ImageNoire.pgm");

    pgm_negative(pixels, width, height);
    pgm_naivewrite("./ImageNegative.pgm", pixels, width, height);
    pgm_show("./ImageNegative.pgm");

    pgm_threshold(pixels, width, height, 123);
    pgm_naivewrite("./ImageSeuil.pgm", pixels, width, height);
    pgm_show("./ImageSeuil.pgm");

    free(pixels);
    free(pixelsCrees);
    */

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






