//////////////// Partie Vue  ///////////////////////
let inputTemp = document.getElementsByTagName("input")[0];
let convertedTemp = document.getElementsByTagName("output")[0];
let convertBtn = document.getElementsByTagName("button")[0];

let view = {
    //Lire le contenu de la vue
    read : function(){
        return Number(inputTemp.value);
    },
    
    //Mettre à jour la vue
    update : function(temp){
        convertedTemp.textContent = temp.toString(); 
    },

    // Accrocher une fonction callback à un événement click du bouton de la vue
    addEventListener : function(callback){
        convertBtn.addEventListener("click", callback);
    }
}

export {view}