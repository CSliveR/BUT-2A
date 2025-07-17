/* à compléter: entêtes */
#include <stdlib.h>
#include <stdio.h>

int multiplication(int *nb1, int *nb2){
	return (*nb1) * (*nb2);
}

int main(void)
{
	/* à compléter: corps de main */
	printf("programme qui mulitiplie 2 nombres\n");
	printf("saisir un premier nombre : ");
	int nb1, nb2;
	scanf("%d", &nb1);
	printf("saisir un deuxieme nombre : ");
	scanf("%d", &nb2);
	printf("%d x %d = %d\n", nb1,nb2, nb1*nb2);
	printf("%d x %d = %d\n", nb1,nb2, multiplication(&nb1, &nb2));

	return EXIT_SUCCESS;
}
