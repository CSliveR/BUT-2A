/* à compléter: entêtes */
#include <stdlib.h>
#include <stdio.h>

int main(int argc, char *argv[])
{
	/* à compléter: corps de main */
	for(int i = 1; i < argc; i++){
		printf("%s ", argv[i]);
	}
	printf("\n");
	return EXIT_SUCCESS;
}
