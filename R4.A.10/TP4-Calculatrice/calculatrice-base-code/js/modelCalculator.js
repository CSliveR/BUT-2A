// Import des boutons éditables
import { EditableButton } from "./modelEditableButton.js";

/**
 * Classe Calculator.
 * (Modèle représentant la calculatrice)
 */
export class Calculator {
  /**
   * Expression actuelle de la calculatrice.
   * @type {string}
   */
  _input;

  /**
   * Mémoire de la calculatrice.
   * @type {{string|null}}
   */
  _memory;

  /**
   * Objet littéral contenant les boutons éditables de la calculatrice.
   * (Clé = ID du bouton, Valeur = Objet EditableButton associé)
   * @type {Object}
   */
  _editableButtons;

  /**
   * Constructeur de la classe Calculator.
   * @param {Object} editableBtns : Informations sur les boutons éditables.
   */
  constructor(editableBtns) {
    this._input = "";
    this._memory = null;

    // Initialisation des boutons éditables
    // (avec un ID qui commence par "libre" suivi d'un chiffre)
    this._editableButtons = {};
    for (let key in editableBtns) {
      let btn = new EditableButton(key, editableBtns[key]);
      this._editableButtons[key] = btn;
    }
  }

  /**
   * Retourne l'expression actuelle de la calculatrice.
   * @returns {string}
   */
  getInput() {
    return this._input;
  }

  /**
   * Met à jour l'expression actuelle de la calculatrice.
   * @param {string} expr : Nouvelle expression
   * @returns {void}
   */
  setInput(expr) {
    this._input = expr;
  }

  /**
   * Vide l'entrée de la calculatrice.
   * @returns {void}
   */
  clearInput() {
    this._input = "";
  }

  /**
   * Efface le dernier caractère de l'expression actuelle de la calculatrice.
   * @returns {void}
   */
  removeLatestInput() {
    this.setInput(this.getInput().substring(0, this.getInput().length - 1));
  }

  /**
    * Concatène l'expression actuelle de la calculatrice à la chaine de caractères passée en paramètre.
    * @param {string} str : chaine de caractères à concaténer avec l'expression
    * @returns {void}
    */
  addToInput(value){
    this._input += value;
  }

  /**
    * Ajoute un signe négatif au tout début de l'expression actuelle de la calculatrice ou l'enlève si le signe négatif était déjà présent.
    *@returns {void}
  */
  reverseTheSign() {
    if (this.getInput().charAt(0) === '-') {
      //this._input.charAt(0) = "";
      this.setInput(this.getInput().slice(1)); // Supprime le signe "-"
    } else {
      this.setInput('-' + this.getInput()); 
    }
  }

  /**
   * Evalue l'opération sur l'écran de la calculatrice en remplaçant le calcul par le résultat sous forme de chaine de caractères
   * @throws {SyntaxError}
   * @returns {void}
   */
  evaluateExpression(){
    try{
      let value = eval(this.getInput()).toString();
      console.log(value +  " is a " + typeof value);
      this.setInput(value);
    }catch(e){
      console.log(e instanceof SyntaxError); console.log(e.message); console.log(e.name); console.log(e.stack);
      alert("L'expression saisie est incorrecte !");
    }
  }

  /**
   * Efface le contenu de la mémoire de la calculatrice.
   * @returns {void}
   */

  clearMemory(){
    this._memory = null;
  }

  /**
   * Ajoute le contenu de la mémoire sur l'écran de la calculatrice.
   * @returns {void}
   */

  recallMemory(){
    this.setInput(this.getInput() + this._memory);
  }

  /**
   * Met à jour le contenu de la mémoire de la calculatrice avec la valeur passée en paramètre.
   * @param {value} : valeur sauvegardée dans la mémoire de la calculatrice
   * @returns {void}
   */

  setMemory(value){
    let nombreValideRegEx = /^-?\d+(\.\d*)?$/; 
    if(this.getInput().trim() === ""){
      throw new Error("Champ vide");
    }else if(!nombreValideRegEx.test(this.getInput())){
      throw new Error("Champ ne contenant pas un nombre valide");
    }else if(this._memory === null){
      this._memory = value;
    }else{
      this.clearMemory();
      this._memory = value;
    }
  }

  /**
   * Affiche la contenu de la mémoire de la calculatrice dans la console.
   * @returns {void}
   */

  printMemory(){
    console.log(this._memory);
  }

  /**
   * Retourne la liste des IDs des boutons éditables.
   * @returns {Array} La liste des IDs des boutons éditables (une liste de chaînes de caractères).
   */
  getIdsEditablesButtons() {
    return Object.keys(this._editableButtons);
  }

  /**
   * Retourne la valeur d'un bouton éditable.
   * @param {string} idBtn : ID du bouton éditable.
   * @returns {string} La valeur du bouton éditable (ou null, si le bouton n'existe pas).
   */
  getValueEditableButton(idBtn) {
    if (this._editableButtons[idBtn]) {
      return this._editableButtons[idBtn].getValue();
    } else {
      return null;
    }
  }

  /**
 * Met à jour l'attribut this._editableButtons si l'utilisateur édite un bouton éditable.
 * @param {string} idBtn : ID du bouton éditable.
 * @param {string} valueBtn :  Objet EditableButton associé
 * @returns {void} 
 */
  setEditableButton(idBtn, valueBtn) {
    if (this._editableButtons[idBtn]) {
      this._editableButtons[idBtn].setValue(valueBtn);
    }
  }

  saveStateToClient(){
    if(this._memory === null){
      localStorage.setItem("memoryContent","");
    }else {
      localStorage.setItem("memoryContent", this._memory);
    }

    let editableButtons = this._editableButtons;
    localStorage.setItem("editableButtonsContent", JSON.stringify(editableButtons));
  }

  retrieveStateFromClient(){
    let memoryContent = localStorage.getItem("memoryContent");
    if(memoryContent != null && memoryContent != ""){
      this._memory = memoryContent;
    }else{
      this._memory = null;
    }

    let editableButtons = localStorage.getItem("editableButtonsContent");
    if(editableButtons != null && editableButtons !== "{}"){
      let parsedButtons = JSON.parse(editableButtons);
      for(let key in parsedButtons){
        this._editableButtons[key] = new EditableButton(key, parsedButtons[key]._value);
      }
    }else{
      let initBtnsInfos = {
        "libre1": "",
        "libre2": "",
        "libre3": "",
        "libre4": "",
        "libre5": "",
        "libre6": "",
      };
      for (let key in initBtnsInfos) {
          this._editableButtons[key] = new EditableButton(key, initBtnsInfos[key]);
      }
      this.saveStateToClient();
    }
  }

  saveStateToServer(){
    let state = JSON.stringify({editableButtons: this._editableButtons, memory: this._memory});

    fetch("api/save-calculator-state.php",{
      method: "POST",
      body: "state=" + state
    }).then()
    .catch((err) => console.log(err));
  }



}
