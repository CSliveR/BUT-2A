//////////////// Partie Vue  ///////////////////////
// Les éléments DOM 
const throwDe = document.getElementsByTagName("button")[0];
const numberOut = document.getElementsByTagName("output")[0];

let view = {
  addEventListener: function (callback) {throwDe.addEventListener("click", callback) }, 

  update: function (value) { numberOut.textContent = value.toString() }
}

export {view}