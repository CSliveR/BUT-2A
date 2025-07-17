// A COMPLETER

#include "gtest/gtest.h"
#include "EvaluationSimple_ACOMPLETER.h"
#include "EvaluationComplexe_ACOMPLETER.h"
using namespace std;

TEST(EvaluationComplexeTest, Constructeur) {
    // Ecrivez ici vos assertions pour tester le constructeur

}

TEST(EvaluationComplexeTest, GetCoefficient) {
    // Ecrivez ici vos assertions pour tester getCoefficient
    for(const EvaluationComplexe *evaluation_complexe :{nullptr}) {
        EXPECT_THROW(evaluation_complexe->getCoefficient(),range_error);
    }
}

TEST(EvaluationComplexeTest, GetNote) {
    // Ecrivez ici vos assertions pour tester getNote
}

TEST(EvaluationComplexeTest, AddEvaluation) {
    // Ecrivez ici vos assertions pour tester addEvaluation
}
