#ifndef ALLOCATION_H_
#define ALLOCATION_H_
#include <pgmio.h>

/*Crée dynamiquement une image dont les dimensions sont passées en paramètres. La couleur des pixels n'est pas initialisée. 
La fonction retourne l'adresse de la zone mémoire allouée pour stocker les pixels ou NULL en cas d'échec. */
pgm_t_image *pgm_malloc(size_t width, size_t height);

/*libère le vecteur de pixels et la structure elle même*/
void pgm_free(pgm_t_image *pgm);




#endif
