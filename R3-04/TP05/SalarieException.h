#ifndef SALARIEEXCEPTION_H
#define SALARIEEXCEPTION_H
#include <stdexcept>

#include "ObjetContraint.h"
#include "Salarie.h"

// A Compléter

// Toutes les exceptions de la classe Salarie seront dues à des valeurs non conformes (nom, numéro SS ou salaire)
// On va donc faire dériver SalarieExcemtion de domain_error qui est l'exception prédéfinie dans <stdexcept> pour ce genre de situation

class SalarieException : public std::domain_error {
    public:
    SalarieException() : std::domain_error("SalarieException"){};
    const char* what() const noexcept override {return "SalarieException";}
};

class NomIncorrectException : public SalarieException {
    public:
    NomIncorrectException() = default;
    const char* what() const noexcept override {return "Nom incorrect, recommencez...";}
};

class NumeroIncorrectException : public SalarieException{
    public:
    NumeroIncorrectException() = default;
    const char* what() const noexcept override {return "Numéro SS incorrect, recommencez...";}
};

class SalaireIncorrectException : public SalarieException {
    public:
    SalaireIncorrectException() = default;
    const char* what() const noexcept override {return "Salaire mensuel incorrect, recommencez...";}
};

#endif /* SALARIEEXCEPTION_H */

