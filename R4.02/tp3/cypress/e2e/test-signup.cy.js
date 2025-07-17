// Les variables ci-dessous peuvent être utilisées pour vous aider
// dans l'écriture de vos tests
const tomato = 'rgb(255, 99, 71)',
  green = 'rgb(0, 128, 0)';

describe('test-signup', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8090/');
  });

  it('TF1 : "John Doe" is a valid name', () => {
    // À compléter
    it('TF1 : "John Doe" is a valid name', () => {
      // Simuler la saisie du prénom "John"
      cy.get('#first-name-field').type('John');
      // Simuler la saisie du nom de famille "Doe"
      cy.get('#last-name-field').type('Doe');
      
      // Vérifier que les champs sont valides
      cy.get('#first-name-field').should('have.class', 'valid');
      cy.get('#last-name-field').should('have.class', 'valid');

      //Vérifier que le message est un message de succès ;
      cy.get('#validation-name').should('have.class', 'validation')

      // Vérifier que le message de succès est affiché
      cy.get('#validation-name').should('be.visible')
        .and('contain.text', 'Welcome John Doe!');
    });    
  });

  it('TF2 : "00ab" is an invalid first name', () => {
    // À compléter
    // Simuler la saisie du prénom "00ab"
    cy.get('#first-name-field').type('00ab');

    // Vérifier que le champ est bien invalide
    cy.get('#first-name-field').should('have.class', 'invalid');

    //Vérifier que le message est un message d'erreur
    cy.get('#validation-name').should('have.class', 'validation invalid');

    //Vérifier que le message contient le texte "At least two characters needed, only letters, spaces, and dashes"
    cy.get('#validation-name').should('be.visible')
      .and('contain.text', 'At least two characters needed, only letters, spaces, and dashes');
  });

  it('TF3: "abc@provider." is an invalid e-mail address', () => {
    // À compléter
    //Simuler la saisie clavier de l'adresse e-mail "abc@provider." dans le champ de texte e-mail 
    cy.get('#email-field').type('abc@provider.');

    //Vérifier que le champs est invalide 
    cy.get('#email-field').should('have.class', 'invalid');

    //Vérifier que le message est un message d'erreur
    cy.get('#validation-email').should('have.class', 'validation invalid');

    //Vérifier que le message contient le texte "Wrong email format"
    cy.get('#validation-email').should('be.visible')
      .and('contain.text', 'Wrong email format');
  });

  it('TF4: a valid field has a green border color and the validation message is green', () => {
    // À compléter
    //Simuler la saisie clavier d'une donnée valide dans un champ de texte (à vous de trouver lequel pour simuler ce scénario)
    cy.get('input[type="text"]').type("John");

    //Vérifier que le champ est valide
    cy.get('input[type="text"]').should('have.class', 'valid');

    //Vérifier que la couleur de la bordure est verte
    cy.get('input[type="text"]').should('have.css', 'border-color', green); 

    //Vérifier que le message de validation associé est de couleur verte.
    cy.get('.validation').should('have.css', 'color', green);
  });

  it('TF5: an invalid field has a tomato border color and the validation message is tomato', () => {
    // À compléter
    //Simuler la saisie clavier d'une donnée invalide dans un champ de texte 
    cy.get('input[type="text"]').type("00ab");

    //Vérifier que le champ est invalide 
    cy.get('input[type="text"]').should('have.class', 'invalid');

    //Vérifier que la couleur de la bordure est tomato
    cy.get('input[type="text"]').should('have.css', 'border-color', tomato); 

    //Vérifier que le message de validation associé est de couleur tomato.
    cy.get('.validation invalid').should('have.css', 'color', tomato);
  });

  it('TF6 : an email that has not already been used displays a success message', () => {
    // À compléter
    cy.intercept('GET', '/email?email=*', {
      statusCode: 200,
      body: {
        presentInDatabase: false,
        msg: 'This email has not already been used'
      }
    }).as('emailCheck');

    //Simuler la saisie clavier de l'adresse e-mail "abc@provider.com" dans le champ de texte e-mail 
    cy.get('#email-field').type('abc@provider.com');

    //Simuler la perte de focus du champ de texte 
    cy.get("#email-field").focused().should("be.focused").blur();

    //Vérifier que le champ est valide 
    cy.get('#email-field').should('have.class', 'valid');

    //Vérifier que le message est un message de succès
    cy.get('#validation-email').should('have.class', 'validation valid');

    //Vérifier que le message contient le texte "This email has not already been used".
    cy.get('#validation-email').should('contain.text',"This email has not already been used");
  });

  it('TF7 : an email that has already been used displays an error message', () => {
    // À compléter
    //Intercepter toute requête GET émanant du formulaire vers une URL "/email?email=*" où le caractère * (wildcard) représente n'importe quel caractère entré par 
    //l'utilisateur
    cy.intercept('GET', '/email?email=*', {
      statusCode: 200,
      body: {
        presentInDatabase: true,
        msg: 'This email has already been used'
      }
    }).as('emailCheck');

    //Simuler la saisie clavier de l'adresse e-mail "abc@provider.com" dans le champ de texte e-mail 
    cy.get('#email-field').type('abc@provider.com');

    //Simuler la perte de focus du champ de texte 
    cy.get("#email-field").focused().should("be.focused").blur();

    //Vérifier que le champ est invalide 
    cy.get('#email-field').should('have.class', 'invalid');

    //Vérifier que le message est un message d'erreur
    cy.get('#validation-email').should('have.class', 'validation invalid');
    
    //Vérifier que le message contient le texte "This email has already been used".
    cy.get('#validation-email').should('contain.text',"This email has already been used");
  });

  it('TF8 : entering a wrong Capcha displays an error message', () => {
    // À compléter
    cy.intercept('GET', '/capcha', {
      statusCode: 200,
    });






  });

  it('TF9 : entering a correct Capcha displays a success message', () => {
    // À compléter
    cy.intercept('GET', '/capcha', {
      statusCode: 200,
      body: {
        op1: cy.get("#op1"),
        op2: cy.get("#op2") //je sais pas sah
      }
    });




  });

  it('TF10 : adding a programming language creates a new badge', () => {
    // À compléter
  });

  it('TF11 : entering less than three programming languages displays an error message', () => {
    // À compléter
  });

  it('TF12 : entering three or more programming languages is valid', () => {
    // À compléter
  });

  it('TF13 : the signup form can be validated upon completing all fields', () => {
    // À compléter
  });
});
