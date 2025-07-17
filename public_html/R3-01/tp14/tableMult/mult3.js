let nombre;
do{
    nombre = prompt("Veuillez saisir un nombre entier");
}while(isNaN(nombre) || nombre === "");

nombre = parseInt(nombre, 10);
document.getElementsByTagName("p")[0].textContent += "Voici la table du " + nombre + " : ";
const calcul = document.getElementsByTagName("pre")[0];

for(let i=1; i<=10; i++){
    calcul.textContent += nombre + " x " + i + " = " + (nombre * i) + "\n";
}
