// Import des modules nécessaires
import { Calculator } from './modelCalculator.js';
import { view } from './view.js';

// ### Initialisation du modèle ###
// (à partir du contenu des boutons éditables)
const editableBtnsInfos = {};

let calculator = new Calculator(editableBtnsInfos);
calculator.retrieveStateFromClient();
console.log(calculator);

/* (La vue est un objet importé du module view.js) */

// ### Initialisation de l'affichage des boutons éditables ###
for (let key of calculator.getIdsEditablesButtons()) {
  // La clé de l'objet correspond à un ID de bouton dans la page
  let btnElt = document.getElementById(key);
  // Si le bouton existe bien, on met à jour sa valeur affichée
  if (btnElt) {
    btnElt.value = calculator.getValueEditableButton(key);
  }
}

// ### Initialisation des listeners ###
// - Gestion de la saisie au clavier
view.calcInput.addEventListener("keyup", (evt) => {
  // Informe le modèle du changement
  calculator.setInput(evt.target.value);
  // (La vue n'a pas besoin d'être mis à jour ici)
});

// - Gestion du bouton CE
// (qui vide la champ de la calculatrice)
view.ceBtn.addEventListener("click", function () {
  // Informe le modèle du changement
  calculator.clearInput();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

// - Gestion du bouton retour arrière
// (qui efface le dernier caractère du champ de la calculatrice)
view.backspaceBtn.addEventListener("click", function () {
  // Effacer le dernier caractère
  //calculator.setInput(view.calcInput.substring(0, view.calcInput.length-1));
  calculator.removeLatestInput();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

/* view.simpleBtns.forEach(function (simpleBtn){
  simpleBtn.addEventListener("click", function (){
    console.log(simpleBtn.value);
    calculator.addToInput(simpleBtn.value);
    // Mise à jour de l'affichage
    view.calcInput.value = calculator.getInput();
  })
}); */

//Gestion des boutons simples
let classicClickListener = function (event){
  calculator.addToInput(event.target.value);
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
};

//Gestion des boutons simples
view.simpleBtns.forEach(function (myBtn){
  myBtn.addEventListener('click', classicClickListener);    
});

//Gestion du bouton +/-
view.plusMinusBtn.addEventListener('click', function(){
  calculator.reverseTheSign();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

//Gestion du bouton =
view.equalBtn.addEventListener('click', function(){
  calculator.evaluateExpression();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

//Gestion du bouton MC
view.mcBtn.addEventListener('click', function(){
  calculator.clearMemory();
  calculator.printMemory();
  //Appel de la méthode pour sauver l'état sur le client
  calculator.saveStateToClient();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

//Gestion du bouton MR
view.mrBtn.addEventListener('click', function(){
  calculator.recallMemory();
  calculator.printMemory();
  // Mise à jour de l'affichage
  view.calcInput.value = calculator.getInput();
});

//Gestion du bouton MS
view.msBtn.addEventListener('click', function(){
  try{
    calculator.setMemory(calculator.getInput());
    calculator.printMemory();
    //Appel de la méthode pour sauver l'état sur le client
    calculator.saveStateToClient();
    // Mise à jour de l'affichage
    view.calcInput.value = calculator.getInput();
  }catch(e){
    alert("Impossible d’enregistrer la valeur en mémoire : " + e.message);
  }
});

//Event change
view.EditableModeBtn.addEventListener('change', function(){
  if(view.EditableModeBtn.checked){
    view.EditableBtns.forEach(function(editBtn){
      editBtn.type = "text";
      editBtn.removeEventListener('click', classicClickListener);
    });
  }else {
    view.EditableBtns.forEach(function(editBtn){
      calculator.setEditableButton(editBtn.id, editBtn.value);
      console.log(" value: " + calculator.getValueEditableButton(editBtn.id));
      editBtn.type = "button";
      editBtn.addEventListener('click', classicClickListener);
    });
    //Appel de la méthode pour sauver l'état sur le client
    calculator.saveStateToClient();
    console.table(calculator._editableButtons);
  }
});



