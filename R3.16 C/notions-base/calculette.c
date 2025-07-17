#include <stdlib.h>
#include <stdio.h>

int calcul(int *lhs, char operateur, int *rhs){
    switch(operateur){
        case '+':
            return *lhs + *rhs;
        break;
        case '-':
            return *lhs - *rhs;
        break;
        case 'x':
            return (*lhs) * (*rhs);
        break;
        case '/':
            return *lhs / *rhs;
        break;
    }
}

int main(int argc, char *argv[]){
    int lhs = atoi(argv[1]); 
    char operateur = argv[2][0];
    int rhs = atoi(argv[3]);

    printf("%d %c %d %c %d\n", lhs, operateur, rhs, '=' , calcul(&lhs, operateur, &rhs));

    return EXIT_SUCCESS;
}