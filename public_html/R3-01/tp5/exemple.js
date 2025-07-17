console.log("Hello");  

let nombre = 0;

do{
    nombre = prompt("Veuillez saisir un nombre entier");
}while(isNaN(nombre));
    
console.log("Voici la table de " + nombre);

for(let i=1; i < 11; i++){
    console.log(i + " x " + nombre + " = " + i*nombre);
}

