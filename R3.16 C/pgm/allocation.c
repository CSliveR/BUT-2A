#include "allocation.h"
#include <pgmio.h>

pgm_t_image *pgm_malloc(size_t width, size_t height){
    pgm_t_image *pixels = malloc(width*height*sizeof(pgm_t_image));
    return pixels;
}

void pgm_free(pgm_t_image *pgm){
    free(pgm->pixels);
    free(pgm);
}
