// NE PAS MODIFIER

#include <iostream>
#include "EvaluationSimple_ACOMPLETER.h"
#include "EvaluationComplexe_ACOMPLETER.h"
using namespace std;

int main() {
    cout << endl << "-- Création et affichage d'une évaluation simple java de coeff 2 et de note 10"<< endl << endl;
    EvaluationSimple java("Epreuve Java",2);
    java.setNote(10.0f);
    java.affiche();
    cout << endl << "-- Création et affichage d'une évaluation html de coeff 3 et de note 15"<< endl << endl;
    EvaluationSimple html("Epreuve HTML",3);
    html.setNote(15.0f);
    html.affiche();
    cout << endl << "-- Création et affichage d'une évaluation complexe info composée de java et html"<< endl << endl;
    EvaluationComplexe info("Module Info");
    info.addEvaluation(java);
    info.addEvaluation(html);
    info.affiche();
    cout << endl << "-- Création et affichage d'une evaluation generale composée de info" << endl << endl;
    EvaluationComplexe generale("Moyenne Generale");
    generale.addEvaluation(info);
    generale.affiche();
    cout << endl << "-- Creation et affichage d'une évaluation math de coeff 5 et de note 7" << endl << endl;
    EvaluationSimple math("Epreuve Math",5);
    math.setNote(7.0f);
    math.affiche();
    cout << endl<< "-- Ajout de l'évaluation simple math à generale et affichage de celle-ci" << endl<< endl;
    generale.addEvaluation(math);
    generale.affiche();
    cout << endl << "-- Creation et affichage d'une évaluation complexe comm, vide pour l'instant" << endl<< endl;
    // EvaluationComplexe comm("Module Comm");
    // comm.affiche();
    // cout << endl << "-- Ajout de l'évaluation comm à generale et affichage de celle-ci" << endl<< endl;
    // generale.addEvaluation(comm);
    // generale.affiche();
    cout << endl << "-- Création et affichage d'une évaluation simple anglais de coeff 4 et de note 16" << endl<< endl;
    EvaluationSimple anglais("Epreuve anglais", 4);
    anglais.setNote(16.0f);
    anglais.affiche();
    cout << endl << "-- Ajout de anglais à comm et affichage de generale" << endl<< endl;
    //comm.addEvaluation(anglais);
    generale.affiche();
    return 0;
}

/* TRACE ATTENDUE =======================================================================
    -- Création et affichage d'une évaluation simple java de coeff 2 et de note 10
    Evaluation :         Epreuve Java - Coefficient :  2 - Note : 10.00
    -- Création et affichage d'une évaluation html de coeff 3 et de note 15
    Evaluation :         Epreuve HTML - Coefficient :  3 - Note : 15.00
    -- Création et affichage d'une évaluation complexe info composée de java et html
    Evaluation :          Module Info - Coefficient :  5 - Note : 13.00
    -- Création et affichage d'une evaluation complexe generale composée de info
    Evaluation :     Moyenne Generale - Coefficient :  5 - Note : 13.00
    -- Creation et affichage d'une évaluation simple math de coeff 5 et de note 7
    Evaluation :         Epreuve Math - Coefficient :  5 - Note :  7.00
    -- Ajout de l'évaluation math à generale et affichage de celle-ci
    Evaluation :     Moyenne Generale - Coefficient : 10 - Note : 10.00
    -- Creation et affichage d'une évaluation complexe comm, vide pour l'instant
    Evaluation :          Module Comm - Coefficient : ND - Note :    ND
    -- Ajout de l'évaluation comm à generale et affichage de celle-ci
    Evaluation :     Moyenne Generale - Coefficient : ND - Note :    ND
    -- Création et affichage d'une évaluation simple anglais de coeff 4 et de note 16
    Evaluation :      Epreuve anglais - Coefficient :  4 - Note : 16.00
    -- Ajout de anglais à comm et affichage de generale
    Evaluation :     Moyenne Generale - Coefficient : 14 - Note : 11.71
 ========================================================================================*/
