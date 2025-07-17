#include <stdlib.h>
#include <stdio.h>
#include <string.h>

void dec2bin(char dec[], char bin[]){
    int reste = 0;
    while(dec > '1'){
        
    }


}

int main(void){
    printf("donner un nombre en decimal : ");
    char decimalNumber[32];
    scanf("%s", decimalNumber);
    char resultNumber[32];
    dec2bin(decimalNumber, resultNumber);

    printf("%c%s%s%s%s\n", '<', decimalNumber, ">10 = <", resultNumber, ">2");



    return EXIT_SUCCESS;
}