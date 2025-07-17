
/**
 * Objet constant représentant la vue.
 */
export const view = {
  // Champ de la calculatrice
  calcInput: document.getElementById("zone_affichage"),

  // Bouton CE
  ceBtn: document.querySelector("input[value='CE']"),
  backspaceBtn: document.querySelector("#backspace"),
  simpleBtns: document.querySelectorAll(".bouton_classique.bouton_simple"),
  plusMinusBtn: document.querySelector('#plusMinus'),
  equalBtn: document.querySelector("input[value='=']"),

  mcBtn: document.querySelector("input[value='MC']"),
  mrBtn: document.querySelector("input[value='MR']"),
  msBtn: document.querySelector("input[value='MS']"),

  EditableBtns: document.querySelectorAll(".bouton_libre"),

  EditableModeBtn: document.getElementById("editionCheckbox"),






};