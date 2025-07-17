//////////////// Partie Vue  ///////////////////////
// Les éléments DOM 
let numberIn = document.getElementsByTagName("input")[0];   // Valeur en entrée
let numberOut = document.getElementsByTagName("output")[0]; // Valeur en sortie
let button = document.getElementsByTagName("button")[0];    // l'accroche de la callback

let view = {
  // Lire le contenu de la vue (un nombre)
  read: function () { return Number(numberIn.value) },

  // Mettre à jour la vue
  update: function (value) { numberOut.textContent = value.toString() },
  
  // Accrocher une fonction callback à un événement click du bouton de la vue
  addEventListener: function (callback) { button.addEventListener("click", callback) }
}

// Les variables (numberIn, numberOut,button) non exportées sont invibles hors module
export { view }