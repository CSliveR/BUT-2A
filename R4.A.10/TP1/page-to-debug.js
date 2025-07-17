// ### Script à débugger ###

// ### Section 1 ###
document.querySelector("#section1 button")?.addEventListener("click", () => {
    let textS2 = document.querySelector("#section1 p").textContent;
    // On remplace "PHP" par "Node.js" (affiché en gras)
    textS2 = textS2.replace("PHP", "<b>Node.js</b>");
    document.querySelector("#section1 p").innerHTML = textS2;
  });
  
  // Section1-Q1 : Est-ce que l'évènement se déclenche bien au clic ?
  /*document.querySelector("#section1 buton")?.addEventListener remplacé en document.querySelector("#section1 button").addEventListener
  // Section1-Q2 : Pourquoi ce code ne fonctionne pas ?
  la méthode replace renvoie une string et textContent n'interprète pas le html
  // => Corriger ce code pour que ça fonctionne comme attendu
    textS2 = textS2.replace("PHP", "<b>Node.js</b>");
    document.querySelector("#section1 p").innerHTML = textS2;
  
  // ### Section 2 ###
  /**
   * Convertit les degrès Celsius en degrès Fahrenheit.
   * (En tout cas, c'est ce qu'elle devrait faire...)
   * @param {numeric} celsius : Degrès Celsius
   * @returns {numeric} Degrès Fahrenheit
   */
  let celsiusToFahrenheit = (celsius) => {
    return (celsius * 9) / 5 + 32;
  };
  
  document.querySelector("#section2 button")?.addEventListener("click", () => {
    let degC = document.querySelector("#section2 input[type='number']").value;
    let degF = celsiusToFahrenheit(parseFloat(degC));
  
    document.querySelector("#section2 strong").textContent = degF;
  });
  
  // Section2-Q1 : Est-ce que l'évènement se déclenche bien au clic ?
  /*Non, il manquait un #avant section2 dans le querySelector
  // Section2-Q2 : Pourquoi ce code ne fonctionne pas ?
    let degC = document.querySelector("#section2 input[type='number']").value;
    au lieu de let degC = document.querySelector("#section2 input[type='number']").textContent;
  // => Corriger ce code pour que ça fonctionne comme attendu
  
  /* Pour information :
      - 0Â°C = 32Â°F
      - 2Â°C = 35.6Â°F
      - 15Â°C = 59Â°F
      - 21Â°C = 69.8Â°F
  */
  