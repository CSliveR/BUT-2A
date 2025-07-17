#include <stdlib.h>
#include <stdio.h>

float celsius(float *fahrenheit){
    return (5.0/9.0)*(*fahrenheit - 32);
}

int main(void){
    printf("---------------------------\n");
    printf("Fahrenheit");
    printf("        Celsius");
    printf("\n---------------------------\n");
    for(float f=0; f<=200; f+=20){
        printf("%.0f                 %.1f\n", f, celsius(&f));
    }

    return EXIT_SUCCESS;
}