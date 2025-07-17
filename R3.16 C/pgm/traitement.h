#ifndef TRAITEMENT_H_
#define TRAITEMENT_H_
#include <pgmio.h>

/*Initialise tous les pixels d'une image existante à la couleur passée en paramètre*/
void pgm_solid(pgm_t_image *pgm, pgm_t_pixel color);

/*Transforme une image en son négatif*/
void pgm_negative(pgm_t_image *pgm);

/*Tous les pixels de l'image inférieurs à threshold sont blancs et tous les pixels supérieurs à threshold sont noirs*/
void pgm_threshold(pgm_t_image *pgm, pgm_t_pixel threshold);

#endif
