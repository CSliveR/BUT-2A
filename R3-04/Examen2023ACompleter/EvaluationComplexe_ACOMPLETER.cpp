// A COMPLETER

#include "EvaluationComplexe_ACOMPLETER.h"
#include <stdexcept>
#include <vector>
#include <string>
using namespace std;

EvaluationComplexe::EvaluationComplexe(const std::string &intitule): Evaluation(intitule){
}

unsigned int EvaluationComplexe::getCoefficient() const {
    if(m_evaluations.empty()) {
        throw range_error("No evaluations provided");
    }
    unsigned int coefficient = 0;

    for(unsigned int i = 0; i < m_evaluations.size(); i++) {
        coefficient = coefficient + this->m_evaluations[i]->getCoefficient();
    }

    return coefficient;
}

void EvaluationComplexe::setCoefficient(unsigned int coefficient) {
    throw range_error("Cannot change coefficient");
}

float EvaluationComplexe::getNote() const {
    if(m_evaluations.empty()) {
        throw range_error("No evaluations provided");
    }

    float moy = 0.0f;
    for(unsigned int i = 0; i < this->m_evaluations.size(); i++) {
        moy = moy + this->m_evaluations[i]->getNote()/this->m_evaluations.size();
    }
    return moy;
}

void EvaluationComplexe::setNote(float note) {
    throw range_error("Cannot change note");
}

void EvaluationComplexe::addEvaluation(const Evaluation &evaluation) {
    this->m_evaluations.push_back(&evaluation);
}
