//////////////// Partie Contrôleur /////////////////
import {view} from "./view.js";
import {model} from "./model.js";

function onConvert(){
    //Récupération de la valeur de température saisie sur la vue
    //Conversion de la température avec le modèle
    //Affichage de la température convertie sur la vue
    
    let inputTemp = view.read();
    let convertedTemp = model.convert(inputTemp);
    view.update(convertedTemp);
}

view.addEventListener(onConvert);