// Returns true if there is a digit in string t
function hasDigit(t) {
    let regex = /\d/;
    return regex.test(t);
}

// Returns true if there is a uppercase letter in string t
function hasUppercase(t) {
    let regex = /[A-Z]/;
    return regex.test(t);
}

// Returns true if there is a lowercase letter in string t
function hasLowercase(t) {
    let regex = /[a-z]/;
    return regex.test(t);
}

// Returns true if form has valid data
function validateForm() {
    const passwdString = document.getElementById('firstPasswd').value;
    const confirmPasswdString = document.getElementById('confirmPasswd').value;

    if(passwdString !== confirmPasswdString){
        alert("Les deux mots de passe que vous avez saisis ne sont pas identiques, veuillez recommencer");
        return false;
    }else if(!hasLowercase(passwdString) || !hasUppercase(passwdString) || !hasDigit(passwdString)){
        alert("Votre mot de passe ne respecte pas les règles");
        return false;
    }
    
    return true;
}