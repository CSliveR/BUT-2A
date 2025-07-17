/**
 * Renvoie un entier alétoire entre min et max.
 * @param {number} [min=0] - Minimum (inclus)
 * @param {number} [max=100] - Maximum (inclus)
 * @returns Une valeur entière entre min et max
 */
let randomIntegerInRange = (min = 0, max = 100) => {
    let randVal = Math.random();
    let tempVal = Math.floor(randVal * (max - min + 1));
    return tempVal + min;
};

let nombreMystere = randomIntegerInRange();
let nombrePropose;
let nbEssais = 0;

do{
    nombrePropose = parseInt(prompt("Devinez le nombre mystère"));
    //console.log(nombrePropose);
    nbEssais++;

    if(nombrePropose < 0 || nombrePropose > 100){
        alert("Attention ! le nombre est entre 0 et 100");
    }else if(nombrePropose < nombreMystere){
        alert('Trop petit');
    }else if(nombrePropose > nombreMystere){
        alert('Trop grand');
    }else if(!Number.isInteger(nombrePropose)){
        alert('Attention ! Il faut saisir un nombre');
    }

}while(nombrePropose != nombreMystere);

alert("Félicitation ! Vous avez trouvé le nombre mystère en " + nbEssais + " essais"); 

