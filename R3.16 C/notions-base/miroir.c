/* à compléter: entêtes */
#include <stdlib.h>
#include <stdio.h>
#include <string.h>

#define BUFFER_LEN 64

void reverseString(char *orig, char *mirror){
	unsigned int i = 0;
	while(i < strlen(orig)){
		mirror[i] = orig[strlen(orig) - 1 - i];	
		i++;
	}
}


int main(void)
{
	char orig[BUFFER_LEN] = "bonjour";
	// = {0}; is the universal zero initializer, C99 Standard 6.7.8.21
	char mirror[BUFFER_LEN] = {0};  // fill buffer with 0 (a.k.a. '\0')

	/* à compléter: corps de main */
	reverseString(orig, mirror);
	printf("%s\n", mirror);


	return EXIT_SUCCESS;
}
