// Action de dempander l'heure au serveur 
import view from "./view.js";
import Time from "./time.js";

function onTime() {
    ///////////////////////////////////////////////////////
    // A COMPLETER
    ///////////////////////////////////////////////////////
    
    let timeZone = view.read();

    Time.read(timeZone, function(timeObject){
        view.update(timeObject);
    })
}

// Attache le controleur au bouton
view.addEventListener(onTime);