#include <stdlib.h>
#include <stdio.h>
#include <pgmio.h>
#include <string.h>
#include "traitement.h"

#define SEUIL1_PIXEL 123

void pgm_solid(pgm_t_image *pgm, pgm_t_pixel color){
    int surface = pgm->width * pgm->height;
    for(int i=0; i < surface; i++){
        pgm->pixels[i] = color;
    }
}

void pgm_negative(pgm_t_image *pgm){
    int surface = pgm->width * pgm->height;
    for(int i=0; i < surface; i++){
        pgm->pixels[i] = 255 - pgm->pixels[i]; 
    }
}


void pgm_threshold(pgm_t_image *pgm, pgm_t_pixel threshold){
    int surface = pgm->width * pgm->height;
    int thres = threshold;
    for(int i=0; i < surface; i++){
        if(pgm->pixels[i] < thres){
            pgm->pixels[i] = 0;
        }else{
            pgm->pixels[i] = 255;
        }
    }
}


