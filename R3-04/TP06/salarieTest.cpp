#include "gtest/gtest.h"
#include "Salarie.h"
#include "SalarieException.h"
using namespace std;

TEST(SalarieTest, Constructeur) {
    // A COMPLETER : tester Salarie::Salarie
}

TEST(SalarieTest, GetNom) {
    // A COMPLETER : test Salarie::getNom
    const vector<string> noms = {"dupont", "DuPoNT"};
    for(const string &nom : noms) {
        Salarie salarieMaj(nom);
        EXPECT_EQ(salarieMaj.getNom(), "DUPONT") << "getNom() renvoie le nom complet en majuscules";
    }
    const Salarie defaultSalarie(Salarie::NOM_DEF);
    EXPECT_EQ(defaultSalarie.getNom(), "MARTIN") << "getNom() renvoie le nom complet en majuscules";
}

TEST(SalarieTest, SetNom) {
    // A COMPLETER : test Salarie::setNom
    const vector<string> InvalidNames = {"dupo*nt", "dupont2", "-jean-Jeff"};

    for (const string &invalidName : InvalidNames) {
        EXPECT_THROW(Salarie salarieInvalidName(invalidName), NomIncorrectException) << "setNom() renvoie une exception si le nom est invalide";
    }

    const string validName = "Banroques-Mathian";
    Salarie salarieValid(validName);

    EXPECT_NO_THROW(salarieValid.setNom(validName));
    EXPECT_EQ(salarieValid.getNom(), "BANROQUES-MATHIAN");
}

TEST(SalarieTest, SetNumeroSS) {
    // A COMPLETER : test Salarie::setNumeroSS
    const vector<string> invalidNumsSS = {"1234", "123456789101112134523687", "3286485910152"};
    for (const string &invalidNumSS : invalidNumsSS) {
        EXPECT_THROW(Salarie salarieInvalidNum(Salarie::NOM_DEF, invalidNumSS), NumeroIncorrectException);
    }

    const string validNumSS = "1589452012591";
    Salarie salarieValid(Salarie::NOM_DEF, validNumSS);

    EXPECT_NO_THROW(salarieValid.setNumeroSS(validNumSS)) << "Pas d'exception pour un numéro valide.";
    EXPECT_EQ(salarieValid.getNumeroSS(), validNumSS);
}


TEST(SalarieTest, SetSalaire) {
    // A COMPLETER : test Salarie::setSalaire
    const vector<float> InvalidSalaires = {1200.0f, 630000.0f};
    for(const float invalidSalaire : InvalidSalaires) {
        EXPECT_THROW(Salarie salarieInvalidSalaire(Salarie::NOM_DEF, Salarie::NUMERO_SS_DEF, invalidSalaire),SalaireIncorrectException);
    }

    const vector<float> validSalaires = {Salarie::SMIC, Salarie::SMIC*Salarie::COEFF_SMIC};
    for(const float validSalaire : validSalaires) {
        EXPECT_NO_THROW(Salarie salarieValidSalaire(Salarie::NOM_DEF, Salarie::NUMERO_SS_DEF, validSalaire));
    }
}

TEST(SalarieTest, GetImpot) {
// A COMPLETER : tester Salarie::getImpot
    for(float trancheSalaire : Salarie::TRANCHES_IMPOT.begin) {
        Salarie salarie(Salarie::NOM_DEF, Salarie::NUMERO_SS_DEF, trancheSalaire);
        EXPECT_EQ(salarie.getImpot(), salarie.getSalaireMensuel()*12.0f*trancheSalaire);
    }

}

