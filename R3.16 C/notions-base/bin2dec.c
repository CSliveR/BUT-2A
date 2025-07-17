#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <math.h>

void bin2dec(char bin[], char dec[]){
    int res = 0;
    for(int pos = strlen(bin); pos >= 0; pos--){
        if(bin[pos] == '1'){
            res += pow(2, strlen(bin) - pos - 1);
        }
    }    
    
    sprintf(dec, "%d", res);
}

int main(void){
    printf("donner un nombre en binaire : ");
    char binaryNumber[32];
    scanf("%s", binaryNumber);
    char resultNumber[32];
    bin2dec(binaryNumber, resultNumber);

    printf("%c%s%s%s%s\n", '<', binaryNumber, ">2 = <", resultNumber, ">10");

    return EXIT_SUCCESS;
}
